<?php

namespace App\Filament\Resources\Handbook;

use App\Filament\Resources\Handbook\CriterionResource\Pages;
use App\Filament\Resources\Handbook\CriterionResource\RelationManagers;
use App\Models\Handbook\Criterion;
use App\Models\Handbook\Scale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CriterionResource extends Resource
{
    protected static ?string $model = Criterion::class;
    protected static ?string $modelLabel = 'Критерій';
    protected static ?string $pluralModelLabel = 'Критерії';
    protected static ?string $navigationGroup = 'Довідники';
    protected static ?int $navigationSort = 40;
    protected static ?string $navigationIcon = 'heroicon-m-swatch';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Параметри критерію')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('scale_id')
                            ->options(Scale::query()->where('is_enable', 1)->pluck('title', 'id'))
                            ->native(false),
                        Forms\Components\Toggle::make('is_enable')
                            ->default(true)
                            ->required(),
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('scale.title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_enable')
                    ->sortable(),
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
            'index' => Pages\ListCriteria::route('/'),
            'create' => Pages\CreateCriterion::route('/create'),
            'edit' => Pages\EditCriterion::route('/{record}/edit'),
        ];
    }
}
