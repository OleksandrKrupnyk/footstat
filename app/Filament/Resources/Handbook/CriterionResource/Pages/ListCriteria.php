<?php

namespace App\Filament\Resources\Handbook\CriterionResource\Pages;

use App\Filament\Resources\Handbook\CriterionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCriteria extends ListRecords
{
    protected static string $resource = CriterionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
