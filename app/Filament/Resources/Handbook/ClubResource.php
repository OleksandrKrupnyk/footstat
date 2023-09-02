<?php

namespace App\Filament\Resources\Handbook;

use App\Filament\Resources\Handbook\ClubResource\Pages;
use App\Filament\Resources\Handbook\ClubResource\RelationManagers;
use App\Filament\Resources\Handbook\ClubResource\Widgets\StatsOverview;
use App\Models\Handbook\Club;
use App\Models\Handbook\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClubResource extends Resource
{
    protected static ?string $model = Club::class;
    protected static ?string $modelLabel = 'Клуб';
    protected static ?string $pluralModelLabel = 'Клуби';
    protected static ?string $navigationGroup = 'Довідники';
    protected static ?int $navigationSort = 60;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Дані клубу')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->label('Назва')
                            ->maxLength(255),
                        Forms\Components\Select::make('country_code')
                            ->options(Country::all()->pluck('title', 'code'))
                            ->label('Країна')
                            ->native(false),
                        Forms\Components\TextInput::make('owners')
                            ->default('')
                            ->label('Власники')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('capitan')
                            ->default('')
                            ->label('Капітан')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('manager')
                            ->default('')
                            ->label('Менеджер')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ceo')
                            ->default('')
                            ->label('CEO')
                            ->maxLength(255),
                    ])->columns(2)
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('owners')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('capitan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('manager')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('seo')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
