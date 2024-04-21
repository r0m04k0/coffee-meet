<?php

namespace App\Filament\Widgets;

use App\Models\Meet;
use Filament\Tables;
use App\Models\Contact;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;

final class LatestMeets extends TableWidget
{
    protected static ?string $heading = 'Последние встречи';

    protected static ?int $sort = 5;

    protected static ?string $model = Meet::class;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn () => Meet::limit(10),
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('date_and_time')
                    ->searchable()
                    ->label('Дата и время'),
                    Tables\Columns\TextColumn::make('first_user.email')
                    ->label('Первый сотрудник'),
                Tables\Columns\TextColumn::make('second_user.email')
                    ->label('Второй сотрудник'),
                Tables\Columns\TextColumn::make('final_duration.duration')
                    ->placeholder('Пока не выбрано время')
                    ->label('Длительность'),
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
                    //
                ])
                ->actions([
                ])
                ->bulkActions([
                   
                ]);
    }
}