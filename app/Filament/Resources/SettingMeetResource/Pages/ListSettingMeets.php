<?php

namespace App\Filament\Resources\SettingMeetResource\Pages;

use App\Filament\Resources\SettingMeetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettingMeets extends ListRecords
{
    protected static string $resource = SettingMeetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
