<?php
declare(strict_types=1);

namespace App\Http\Controllers\Vote;

use App\Http\Controllers\Controller;
use App\Models\Handbook\ClubCriterion;
use App\Models\Handbook\Scale;
use App\Models\Stats\Mark;
use Illuminate\Support\Facades\Auth;

/**
 * Class VoteEmblemController
 *
 * Контролер
 * @package App\Http\Controllers\Vote
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class VoteEmblemController extends Controller
{
    const ONE_WEEK = 7;

    public function __invoke()
    {
        $user = Auth::user();
        $club = $user?->club;
        // Перевірка, що у користувача вказано клуб
        if ($club === null) {
            return redirect(route('profile.edit'));
        }
        $request = request();
        $value = (int)$request->post('mark_value', 0);
        $value = abs($value);
        $criteria_id = (int)$request->post('criteria_id', 0);

        $clubCriteria = ClubCriterion::with('scale')->findOrFail($criteria_id);
        // отримати останню оцінку
        $lastMark = Mark::query()
            ->where('user_id', '=', $user->id)
            ->where('club_id', '=', $club->id)
            ->where('club_criteria_id', '=', $clubCriteria->id)
            ->orderBy('created_at', 'desc')->first();


        if ($lastMark !== null && !$this->checkLastDateMark($lastMark)) {
            // нічого не зберігати
            //Todo: Повідомлення про помилку в журнал
            return redirect(route('userclub.index'));
        }


        if (!$this->checkScaleValue($clubCriteria->scale, $value)) {
            // нічого не зберігати
            //Todo: Повідомлення про помилку в журнал
            return redirect(route('userclub.index'));
        }
        $mark = new Mark();
        $mark->user_id = $user->id;
        $mark->club_id = $club->id;
        $mark->club_criteria_id = $clubCriteria->id;
        $mark->mark_value = $value;
        $mark->scale_type = 'NUMBER';
        $save = $mark->save();
        return redirect(route('userclub.index'));
    }


    /**
     * Повертає true, якщо поточна дата молодша за дату виставляння останньої оцінки на 1 тиждень
     * @param Mark $lastMark
     * @return bool
     */
    protected function checkLastDateMark(Mark $lastMark): bool
    {
        return true; // $lastMark->created_at->diffInDays(now()) >= self::ONE_WEEK;
    }

    /**
     * Повертає true якщо значення оцінки задовольняє межі шкали оцінювання
     * @param Scale $scale
     * @param int $value
     * @return bool
     */
    protected function checkScaleValue(Scale $scale, int $value): bool
    {
        return $value < 2147483647;
    }
}
