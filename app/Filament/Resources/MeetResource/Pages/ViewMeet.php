<?php

namespace App\Filament\Resources\MeetResource\Pages;

use App\Filament\Resources\MeetResource;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Components\Section;

class ViewMeet extends ViewRecord
{
    protected static string $resource = MeetResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                 Section::make([
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
                       ]),
                     Section::make([
                         Infolists\Components\TextEntry::make('first_user.email')->label('Почта'),
                         Infolists\Components\TextEntry::make('first_user.name')->label('Имя'),
                         Infolists\Components\TextEntry::make('first_user.surname')->label('Фамилия'),
                        Infolists\Components\TextEntry::make('first_user.patronymic')->label('Отчество'),
                     ])->description('Первый сотрудник'),
                     Section::make([
                           Infolists\Components\TextEntry::make('second_user.email')->label('Почта'),
                           Infolists\Components\TextEntry::make('second_user.name')->label('Имя'),
                           Infolists\Components\TextEntry::make('second_user.surname')->label('Фамилия'),
                           Infolists\Components\TextEntry::make('second_user.patronymic')->label('Отчество'),
                       ])->description('Второй сотрудник'),
        ]);
    }
}
