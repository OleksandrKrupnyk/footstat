<?php

namespace App\Filament\Resources\Handbook;

use App\Filament\Resources\Handbook\ScaleResource\Pages;
use App\Filament\Resources\Handbook\ScaleResource\RelationManagers\ValuesRelationManager;
use App\Models\Handbook\Scale;
use App\Models\Handbook\ScaleType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ScaleResource
 *
 *
 * @package App\Filament\Resources\Handbook
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class ScaleResource extends Resource
{
    protected static ?string $model = Scale::class;

    protected static ?string $modelLabel = 'Шкала';
    protected static ?string $pluralModelLabel = 'Шкали';
    protected static ?string $navigationGroup = 'Довідники';
    protected static ?int $navigationSort = 20;
    protected static ?string $navigationIcon = 'heroicon-m-adjustments-vertical';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Параметри шкали')
                    ->schema([
                        Forms\Components\Select::make('scale_type')
                            ->options(ScaleType::all()->pluck('title', 'type'))
                            ->native(false)
                            ->label('Тип')
                            ->columnSpan('full')
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Назва')
                            ->columnSpan('full'),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(255)
                            ->label('Опис')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('max_value')
                            ->required()
                            ->numeric()
                            ->label('Максимальне значення')
                            ->default(100)->columns(3),
                        Forms\Components\TextInput::make('offset')
                            ->required()
                            ->numeric()
                            ->label('Зміщення відносно нуля')
                            ->default(0),
                        Forms\Components\TextInput::make('step')
                            ->required()
                            ->numeric()
                            ->label('Крок')
                            ->disabled()
                            ->helperText('Не задіяно')
                            ->default(1),
                        Forms\Components\Toggle::make('is_enable')
                            ->required()
                            ->default(true)
                            ->label('Шкала доступна?'),
                    ])->columns(3),
//                Forms\Components\Section::make('Значення шкали')
//                    ->description('Значення для шкали визначених значень')
//                    ->schema([
//
//                    ])
//                    ->collapsible()
//                    ->compact()
//                    ->hidden(fn($record): bool => $record->scale_type !== "RANGE")
//                    ->columns(null)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Назва')
                    ->searchable(),
                Tables\Columns\TextColumn::make('scaleType.title')
                    ->label('Тип')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_value')
                    ->numeric()
                    ->label('Максимальне значення')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('offset')
                    ->label('Зміщення відносно нуля')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_enable')
                    ->label('Доступна?')
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
                Filter::make('scale_type_number')->label('Цифрова')
                    ->query(fn(Builder $query): Builder => $query->where('scale_type', "NUMBER")),
                Filter::make('scale_type_range')->label('Визначені')
                    ->query(fn(Builder $query): Builder => $query->where('scale_type', "RANGE"))
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
            ValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScales::route('/'),
            'create' => Pages\CreateScale::route('/create'),
            'edit' => Pages\EditScale::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::$model::query()->count();
    }
}
