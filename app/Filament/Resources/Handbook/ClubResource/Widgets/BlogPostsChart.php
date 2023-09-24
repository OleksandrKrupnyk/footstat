<?php

namespace App\Filament\Resources\Handbook\ClubResource\Widgets;

use App\Models\Stats\Mark;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Назва блоку';
    protected static ?string $pollingInterval = null;

    protected static ?string $maxHeight = '300px';
    protected static bool $isLazy = false;

    public function getDescription(): ?string
    {
        return 'Пояснення до блоку';
    }

    protected function getData(): array
    {

        $activeFilter = $this->filter ?: 'perMonth';
//        $a = Mark::query()->groupBy('club_id')->select(['club_id',DB::raw('COUNT(*) as c1')])->get()
//            ->keyBy('club_id');
//        $l = range(1,count($a));
        $query =Trend::model(Mark::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            );

        if('perMonth'=== $activeFilter) {
            $data = $query
                ->perMonth()
                ->count();
            $data2 = $query
                ->perMonth()
                ->max('mark_value');
        }else{
            $data = $query
                ->perDay()
                ->count();
            $data2 = $query
                ->perDay()
                ->max('mark_value');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Кількість оцінок в місяць',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor'=>'blue'
                ],
                [
                    'label' => 'Максимальна оцінка',
                    'data' => $data2->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor'=>'red'
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'perMonth' => 'За місяць',
            'perDay' => 'За день',
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
