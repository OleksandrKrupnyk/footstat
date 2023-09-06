<?php

namespace App\Filament\Resources\Handbook;

use App\Filament\Resources\Handbook\CountryResource\Pages;
use App\Filament\Resources\Handbook\CountryResource\RelationManagers;
use App\Models\Handbook\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $modelLabel = 'Країна';
    protected static ?string $pluralModelLabel = 'Країни';
    protected static ?string $navigationGroup = 'Довідники';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Код')
                            ->placeholder('Двозначний код')
                            ->required()
                            ->regex("/[A-Za-z]{2}/")
                            ->autocapitalize()
                            ->maxWidth(2)
                            ->length(2),
                        Forms\Components\TextInput::make('title')
                            ->label('Назва')
                            ->required()
                            ->placeholder("Назва країни")
                            ->maxLength(255)
                        ,
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label("Код")
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('title')->label("Назва країни")
                    ->searchable(isIndividual: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::query()->count();
    }
}
