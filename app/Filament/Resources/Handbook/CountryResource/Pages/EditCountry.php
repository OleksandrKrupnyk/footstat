<?php

namespace App\Filament\Resources\Handbook\CountryResource\Pages;

use App\Filament\Resources\Handbook\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
//            $this->getCancelFormAction(),
            Actions\DeleteAction::make()
        ];
    }
}
