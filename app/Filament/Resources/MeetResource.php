<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetResource\Pages;
use App\Filament\Resources\MeetResource\RelationManagers;
use App\Models\Meet;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\EditAction;
use Illuminate\Support\Facades\Hash;

class MeetResource extends Resource
{
    protected static ?string $model = Meet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Встречи';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

             ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_and_time')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_user.email')
                    ->label('Первый сотрудник'),
                Tables\Columns\TextColumn::make('second_user.email')
                    ->label('Второй сотрудник'),
                Tables\Columns\TextColumn::make('final_duration.duration')
                    ->placeholder('Пока не выбрано время')
                    ->label('Длительность встречи'),
                Tables\Columns\IconColumn::make('is_done')
                    ->boolean()
                    ->label('Проведена'),
                Tables\Columns\IconColumn::make('is_online')
                    ->boolean()
                    ->label('Онлайн'),
                Tables\Columns\IconColumn::make('is_confirmed')
                    ->boolean()
                    ->label('Подтверждена'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_ticket')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_ticket'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            );
                    })
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeets::route('/'),
            'view' => Pages\ViewMeet::route('/{record}'),
        ];
    }
}
