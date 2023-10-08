<?php

namespace App\Filament\Resources\Control\UserResource\RelationManagers;

use App\Models\Handbook\Club;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Class ClubUserRelationManager
 *
 *
 * @package App\Filament\Resources\Control\UserResource\RelationManagers
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class ClubUserRelationManager extends RelationManager
{
    protected static string $relationship = 'userClub';
    protected static ?string $title = 'Улюблений клуб';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('club_id')
                    ->options(
                        Club::query()->orderBy('title')->pluck('title', 'id')->all()
                    )->label('Улюблений клуб')
                    ->native(false)
                    ->required()
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Назва клубу')
            ->columns([
                Tables\Columns\TextColumn::make('club.title')
                    ->label('Назва клубу'),
                Tables\Columns\TextColumn::make('club.country.title')
                    ->label('Країна'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }
}
