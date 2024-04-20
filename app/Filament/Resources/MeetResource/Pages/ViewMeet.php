<?php

namespace App\Filament\Resources\MeetResource\Pages;

use App\Filament\Resources\MeetResource;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;

class ViewMeet extends ViewRecord
{
    protected static string $resource = MeetResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                 Infolists\Components\TextEntry::make('first_user.email')->label('#1 Почта'),
                 Infolists\Components\TextEntry::make('first_user.name')->label('#1 Имя'),
                 Infolists\Components\TextEntry::make('first_user.surname')->label('#1 Фамилия'),

                 Infolists\Components\TextEntry::make('second_user.email')->label('#2 Почта'),
                 Infolists\Components\TextEntry::make('second_user.name')->label('#2 Имя'),
                 Infolists\Components\TextEntry::make('second_user.surname')->label('#2 Фамилия'),

                 Infolists\Components\TextEntry::make('date_and_time')->label('Дата и время'),
                 Infolists\Components\TextEntry::make('final_duration.duration')->label('Продолжительность'),
                 Infolists\Components\IconEntry::make('is_done')
                     ->boolean()
                     ->label('Завершена'),
                 Infolists\Components\IconEntry::make('is_online')
                     ->boolean()
                     ->label('Онлайн'),
                 Infolists\Components\IconEntry::make('is_confirmed')
                     ->boolean()
                     ->label('Подтверждена'),
            ]);
    }
}
