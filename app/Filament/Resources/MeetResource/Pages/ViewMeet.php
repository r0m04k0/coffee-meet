<?php

namespace App\Filament\Resources\MeetResource\Pages;

use App\Filament\Resources\MeetResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMeet extends ViewRecord
{
    protected static string $resource = MeetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
