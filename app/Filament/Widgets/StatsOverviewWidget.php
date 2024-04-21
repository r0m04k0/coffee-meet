<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Meet;
use App\Models\Contact;
use Filament\Actions\ViewAction;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Количество встреч за 3 дня', Meet::where('created_at', '>=', Carbon::now()->subDays(3))->count())
            ->chart(self::getCountMeetsPerThreeDaysChart())
            ->color('success'),
            Stat::make('Количество проведенных встреч', self::getPercentageDoneMeet() . "%"),
            Stat::make('Количество проведенных онлайн встреч', self::getPercentageOnlineMeet() . "%"),
        ];  
    }

    private function getPercentageDoneMeet(): float
    {
        $totalContacts = Meet::count();
        $nonEmptyStaffIdContacts = Meet::where('is_done', true)->count();

        if ($totalContacts > 0) {
            $percentage = ($nonEmptyStaffIdContacts / $totalContacts) * 100;
            return round($percentage);
        } else {
            return 0;
        }
    }

    private function getPercentageOnlineMeet(): float
    {
        $totalContacts = Meet::count();
        $nonEmptyStaffIdContacts = Meet::where('is_online', true)
            ->where('is_done', true)
            ->count();

        if ($totalContacts > 0) {
            $percentage = ($nonEmptyStaffIdContacts / $totalContacts) * 100;
            return round($percentage);
        } else {
            return 0;
        }
    }

    private function getCountMeetsPerThreeDaysChart(): array
    {
        $results = [];
        $startTime = Carbon::now()->subDays(3);
    
        for ($i = 0; $i < 72; $i++) { // 72 интервала по 1 часу в течение 3 дней
            $endTime = $startTime->copy()->addHour();
            $count = DB::table('meets')
                ->whereBetween('created_at', [$startTime, $endTime])
                ->count();
            $results[] = $count;
            $startTime = $endTime;
        }
    
        return $results;
    }
}