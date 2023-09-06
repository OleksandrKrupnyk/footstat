<?php

namespace App\Filament\Resources\Handbook\ClubResource\RelationManagers;

use App\Models\Handbook\ClubCriterion;
use App\Models\Handbook\Criterion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CriteriaRelationManager extends RelationManager
{
    protected static string $relationship = 'criteria';
    protected static ?string $title = 'Критерії оцінювання' ;


    public function form(Form $form): Form
    {
    $parentID = $this->getOwnerRecord()->id;

        return $form
            ->schema([
                Forms\Components\Select::make('criterion_id')
                    ->options(
                        Criterion::query()
                            ->whereNotIn('id',
                                ClubCriterion::query()
                                    ->select('criterion_id')
                                    ->where('club_id',$parentID))
                            ->whereIsEnable(true)
                            ->pluck('title','id')
                            ->all()
                    )->required()
                ->label('Критерій')
                ->native(false),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('criterion_id')
            ->columns([
                Tables\Columns\TextColumn::make('criterion.title')
                ->label('Критерій')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->createAnother(false)
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
                Tables\Actions\CreateAction::make()->createAnother(false),
            ]);
    }
}
