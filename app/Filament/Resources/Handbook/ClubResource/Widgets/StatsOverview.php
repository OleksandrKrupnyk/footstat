<?php

namespace App\Filament\Resources\Handbook\ClubResource\Widgets;

use App\Models\Stats\Mark;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $q = Mark::query();
        $marksMax = $q->max('mark_value');
        $marksAvg = $q->avg('mark_value');
        $marksCount = $q->count();
        return [
            Stat::make('Максимальна оцінка', $marksMax)
                ->description('test 1')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Середня оцінка', $marksAvg)
                ->description('test 2')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Всього оцінок', $marksCount)
                ->description('test 3')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
