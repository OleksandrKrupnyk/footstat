<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Handbook\ClubCriterion;
use App\Models\Stats\Mark;
use App\Models\Stats\MarkStatList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class UserClubController
 *
 * Контролер
 * @package App\Http\Controllers
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class UserClubController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $club = $user?->club;
        $opponent = $user?->opponent;

        // Перевірка, що у користувача вказано клуб
        if ($club === null) {
            return redirect(route('profile.edit'));
        }
        /** @var \Illuminate\Database\Eloquent\Collection $criterions */
        $criterions = ClubCriterion::query()
            ->with(['criterion','criterion.scale', 'scale'])
            ->whereClubId($club->id)
            ->get();

        $criteriaIds = $criterions->pluck('id')->all();

        $latestMarks = Mark::query()
            ->select(DB::raw('club_criteria_id as criteria_id'), DB::raw('max(updated_at) as MaxDate'))
            ->where('club_id', $club->id)
            ->where('user_id', $user->id)
            ->whereIn('club_criteria_id', $criteriaIds)
            ->groupBy('club_criteria_id');

        $marks = Mark::query()
            ->joinSub($latestMarks, 'latest_marks', function ($join) {
                $join->on('club_criteria_id', '=', 'latest_marks.criteria_id')->on('updated_at', '=', 'MaxDate');
            })->get();


        $comMarks = MarkStatList::query()
            ->where('club_id', (string)$club->id)
            ->whereIn('club_criteria_id', $criteriaIds)
            ->groupBy('club_criteria_id')
            ->select(
                'club_criteria_id',
                DB::raw('max(mark_value) as hi'),
                DB::raw('min(mark_value) as low'),
                DB::raw('avg(mark_value) as avg'),
                DB::raw('count(mark_value) as count'),
            )
            ->get()->keyBy('club_criteria_id');

        $criterions->pluck(['scale','max_value'],'id');



        $marks = $marks->keyBy('club_criteria_id');
        return view('userclub', [
            'user' => $user,
            'club' => $club,
            'opponent' => $opponent,
            'criterions' => $criterions,
            'marks' => $marks,
            'maxMarks' => $criterions->pluck(['scale','max_value'],'id'),
            'comMarks' => $comMarks,
        ]);
    }
}
