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

class MeetResource extends Resource
{
    protected static ?string $model = Meet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_and_time')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_user.name')
                    ->label('Первый сотрудник'),
                Tables\Columns\TextColumn::make('second_user.name')
                    ->label('Второй сотрудник'),
                Tables\Columns\TextColumn::make('final_duration.duration_id')
                    ->placeholder('Пока не выбрано время')
                    ->label('Длительность встречи'),
                Tables\Columns\TextColumn::make('staff.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('priority.name')
                    ->icon(fn (string $state): string => match ($state) {
                        'high_priority' => 'heroicon-o-clock',
                        'medium_priority' => 'heroicon-o-clock',
                        'standard_priority' => 'heroicon-o-clock',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'high_priority' => 'danger',
                        'medium_priority' => 'warning',
                        'standard_priority' => 'success',
                    }),
                Tables\Columns\IconColumn::make('is_done')
                    ->boolean()
                    ->label('Встреча завершилась'),
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
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->modalWidth('2xl')
                    ->label('Изменить'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'create' => Pages\CreateMeet::route('/create'),
            'view' => Pages\ViewMeet::route('/{record}'),
            'edit' => Pages\EditMeet::route('/{record}/edit'),
        ];
    }
}
