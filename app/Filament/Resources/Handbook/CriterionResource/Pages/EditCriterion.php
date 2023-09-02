<?php

namespace App\Filament\Resources\Handbook\CriterionResource\Pages;

use App\Filament\Resources\Handbook\CriterionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCriterion extends EditRecord
{
    protected static string $resource = CriterionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
