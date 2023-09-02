<?php

namespace App\Filament\Resources\Handbook;

use App\Filament\Resources\Handbook\ScaleTypeResource\Pages;
use App\Filament\Resources\Handbook\ScaleTypeResource\RelationManagers;
use App\Models\Handbook\ScaleType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ScaleTypeResource extends Resource
{
    protected static ?string $model = ScaleType::class;

    protected static ?string $modelLabel = 'Тип шкали';
    protected static ?string $pluralModelLabel = 'Типи шкал';
    protected static ?string $navigationGroup = 'Довідники';
    protected static ?int $navigationSort = 10;

    protected static ?string $navigationIcon = 'heroicon-m-adjustments-vertical';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('type')
                            ->required()
                            ->disabled()
                            ->maxLength(8)
                            ->label('Тип шкали'),
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->label('Назва шкали'),
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable()->label('Тип шкали'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()->label('Назва шкали'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//
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
            'index' => Pages\ListScaleTypes::route('/'),
            'create' => Pages\CreateScaleType::route('/create'),
            'edit' => Pages\EditScaleType::route('/{record}/edit'),
        ];
    }
}
