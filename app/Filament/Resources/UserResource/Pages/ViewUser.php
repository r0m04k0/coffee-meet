<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                 Section::make([
                    Infolists\Components\TextEntry::make('name')->label('Имя'),
                    Infolists\Components\TextEntry::make('surname')->label('Фамилия'),
                     Infolists\Components\TextEntry::make('patronymic')->label('Отчество'),
                    Infolists\Components\TextEntry::make('email')->label('Почта'),
                     Infolists\Components\TextEntry::make('date_birth')->label('Дата рождения'),
                    Infolists\Components\TextEntry::make('position')->label('Должность'),
                     Infolists\Components\TextEntry::make('departament')->label('Отдел'),
                     Infolists\Components\TextEntry::make('about')->label('О себе'),
                     Infolists\Components\TextEntry::make('phone')->label('Телефон'),
                     Infolists\Components\TextEntry::make('telegram')->label('Телеграм'),
                     Infolists\Components\IconEntry::make('is_confirmed')
                         ->boolean()
                         ->label('Верифицирован'),
                     Infolists\Components\IconEntry::make('is_ready')
                         ->boolean()
                         ->label('Готов к встрече'),
                     ])->columns(3)
            ]);
    }
}
