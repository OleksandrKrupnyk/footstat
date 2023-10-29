<?php
declare(strict_types=1);

namespace App\Models\Stats;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MarkStatList
 *
 * @property int min
 * @property int max
 * @property int avg
 * @property int count
 * @property Carbon $created_at
 *
 * @package App\Models\Stats
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class MarkStatList extends Model
{

    public function getTable()
    {
        return 'marks';
    }
}
