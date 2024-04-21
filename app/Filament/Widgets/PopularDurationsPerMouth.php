<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Meet;
use App\Models\Contact;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PopularDurationsPerMouth extends ChartWidget
{
    protected static ?string $heading = 'Доля выбора продолжительности встреч за месяц';

    protected static ?int $sort = 2;

    protected static string $color = 'info';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $contactPerMouth = self::CountContactsPerMouth(3);

        return [
            'datasets' => [
                [
                    'data' => $contactPerMouth['counts'],
                    'backgroundColor' => [
                        '#FFDD00',
                        '#FFED00',
                        '#ECB300',
                    ],
                ],
            ],
            'labels' => $contactPerMouth['categoryNames']
        ];
    }

    private function CountContactsPerMouth(int $countRecords): array
    {
        $durationMeets = Meet::select('durations.duration as duration_name', DB::raw('COUNT(*) as count'))
            ->join('durations', 'meets.duration_id', '=', 'durations.id')
            ->whereMonth('meets.created_at', now()->month)
            ->groupBy('meets.duration_id', 'durations.duration')
            ->orderByDesc('count')
            ->take(3) 
            ->get();


        $duration = [];
        $counts = [];

        foreach ($durationMeets as $durationMeet) {
            $duration[] = $durationMeet->duration_name;
            $counts[] = $durationMeet->count;
        }

        return [
            'categoryNames' => $duration,
            'counts' => $counts,
        ];
    }
}