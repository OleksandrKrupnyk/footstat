<?php
declare(strict_types=1);

namespace App\Models\Stats;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mark
 *
 * @property int club_id
 * @property int club_criteria_id
 * @property int user_id
 * @property string scale_type
 * @property int mark_value
 * @property Carbon $created_at
 *
 * @package App\Models\Stats
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class Mark extends Model
{
    use HasFactory;
}
