<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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
use Filament\Tables\Columns\CheckboxColumn;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\TextInput::make('email')
                     ->required(),
                 Forms\Components\TextInput::make('password')
                     ->password()
                     ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                     ->dehydrated(fn ($state) => filled($state))
                     ->required(fn (string $context): bool => $context === 'create'),
                 Forms\Components\TextInput::make('name')
                     ->required(),
                 Forms\Components\TextInput::make('surname'),
                 Forms\Components\TextInput::make('patronymic'),
                 Forms\Components\TextInput::make('position'),
                 Forms\Components\TextInput::make('departament'),
                 Forms\Components\Textarea::make('about'),
                 Forms\Components\TextInput::make('phone'),
                 Forms\Components\TextInput::make('telegram'),
                 Forms\Components\Checkbox::make('is_confirmed'),
                 Forms\Components\Checkbox::make('is_ready'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Фамилия')
                    ->searchable(),
                Tables\Columns\TextColumn::make('patronymic')
                    ->label('Отчество')
                    ->searchable(),
              Tables\Columns\TextColumn::make('date_birth')
                  ->label('Дата рождения')
                  ->searchable(),
              Tables\Columns\TextColumn::make('email')
                    ->label('Почта')
                    ->searchable(),
              Tables\Columns\TextColumn::make('departament')
                  ->label('Отдел')
                  ->searchable(),
              Tables\Columns\TextColumn::make('position')
                  ->label('Должность')
                  ->searchable(),
              Tables\Columns\TextColumn::make('phone')
                  ->label('Телефон')
                  ->searchable(),
              Tables\Columns\TextColumn::make('telegram')
                    ->label('Телеграм')
                    ->searchable(),
              CheckboxColumn::make('is_confirmed')
                    ->label('Верифицирован'),
              Tables\Columns\IconColumn::make('is_ready')
                  ->boolean()
                  ->label('Готовность'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                ])
            ->actions([
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
