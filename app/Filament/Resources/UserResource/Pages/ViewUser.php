<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

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
                Infolists\Components\TextEntry::make('email'),
                Infolists\Components\TextEntry::make('name'),
                Infolists\Components\TextEntry::make('surname'),
                Infolists\Components\TextEntry::make('patronymic'),
                 Infolists\Components\TextEntry::make('position'),
                 Infolists\Components\TextEntry::make('departament'),
                 Infolists\Components\TextEntry::make('about'),
                 Infolists\Components\TextEntry::make('phone'),
                 Infolists\Components\TextEntry::make('telegram'),
                 Infolists\Components\TextEntry::make('is_confirmed'),
                 Infolists\Components\TextEntry::make('is_ready'),
            ]);
    }
}
