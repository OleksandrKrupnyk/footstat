<?php

namespace App\Filament\Resources\Control;

use App\Filament\Resources\Control\UserResource\Pages;
use App\Filament\Resources\Control\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;


    protected static ?string $modelLabel = 'Користувач';
    protected static ?string $pluralModelLabel = 'Користувачі';
    protected static ?string $navigationGroup = 'Керування';
    protected static ?int $navigationSort = 10;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label("Ім'я")
                    ->placeholder("Ім'я")
                    ->required()
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Ім'я")
                    ->weight(FontWeight::Bold)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('email')
                    ->label('Поштова скринька')
                    ->icon('heroicon-m-envelope')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('userClub.club.title')
                    ->label('Улюблений клуб')
                    ->searchable(isIndividual: true),
                 Tables\Columns\TextColumn::make('marks_count')
                     ->label('Оцінок')
                     ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
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
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::query()->count();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('marks');
    }


}
