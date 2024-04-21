<?php

namespace App\Filament\Resources\SettingMeetResource\Pages;

use App\Filament\Resources\SettingMeetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSettingMeet extends EditRecord
{
    protected static string $resource = SettingMeetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
