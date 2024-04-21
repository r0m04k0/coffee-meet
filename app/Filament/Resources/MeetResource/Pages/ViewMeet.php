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
                       Infolists\Components\IconEntry::make('is_done')
                           ->boolean()
                           ->label('Проведена'),
                       Infolists\Components\IconEntry::make('is_online')
                           ->boolean()
                           ->label('Онлайн'),
                       Infolists\Components\IconEntry::make('is_confirmed')
                           ->boolean()
                           ->label('Подтверждена'),
                       Infolists\Components\TextEntry::make('date_and_time')->label('Дата и время'),
                       Infolists\Components\TextEntry::make('final_duration.duration')->label('Продолжительность'),
                       ])->columns(3),
                     Section::make([
                         Infolists\Components\TextEntry::make('first_user.name')->label('Имя'),
                         Infolists\Components\TextEntry::make('first_user.surname')->label('Фамилия'),
                            Infolists\Components\TextEntry::make('first_user.patronymic')->label('Отчество'),
                           Infolists\Components\TextEntry::make('first_user.email')->label('Почта'),

                           Infolists\Components\TextEntry::make('first_date_and_time')->label('Выбранные дата и время'),
                           Infolists\Components\TextEntry::make('first_duration.duration')->label('Длительность'),
                           Infolists\Components\IconEntry::make('first_is_online')
                               ->boolean()
                               ->label('Онлайн'),
                           Infolists\Components\IconEntry::make('first_is_confirmed')
                               ->boolean()
                               ->label('Подтверждено'),
                           Section::make([
                                 Infolists\Components\TextEntry::make('first_feedback_meet_id.review')
                                     ->label('Отзыв')
                                     ->placeholder('Отсутствует'),
                                 Infolists\Components\TextEntry::make('first_feedback_meet_id.rating')
                                     ->label('Оценка')
                                     ->placeholder('Отсутствует'),
                         ]),
                     ])->columns(3)->description('Первый сотрудник'),
                     Section::make([
                           Infolists\Components\TextEntry::make('second_user.name')->label('Имя'),
                           Infolists\Components\TextEntry::make('second_user.surname')->label('Фамилия'),
                           Infolists\Components\TextEntry::make('second_user.patronymic')->label('Отчество'),
                           Infolists\Components\TextEntry::make('second_user.email')->label('Почта'),

                           Infolists\Components\TextEntry::make('second_date_and_time')->label('Выбранные дата и время'),
                           Infolists\Components\TextEntry::make('second_duration.duration')->label('Длительность'),
                           Infolists\Components\IconEntry::make('second_is_online')
                               ->boolean()
                               ->label('Онлайн'),
                           Infolists\Components\IconEntry::make('second_is_confirmed')
                               ->boolean()
                               ->label('Подтверждено'),
                           Section::make([
                                 Infolists\Components\TextEntry::make('second_feedback_meet_id.review')
                                     ->label('Отзыв')
                                     ->placeholder('Отсутствует'),
                                 Infolists\Components\TextEntry::make('second_feedback_meet_id.rating')
                                     ->label('Оценка')
                                     ->placeholder('Отсутствует'),
                             ]),

               ])->columns(3)->description('Второй сотрудник'),
        ]);
    }
}
