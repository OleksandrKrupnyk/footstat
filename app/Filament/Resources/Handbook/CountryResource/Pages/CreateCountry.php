<?php

namespace App\Filament\Resources\Handbook\CountryResource\Pages;

use App\Filament\Resources\Handbook\CountryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCancelFormAction()

        ];
    }
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            ...(static::canCreateAnother() ? [$this->getCreateAnotherFormAction()] : []),

        ];
    }
}
