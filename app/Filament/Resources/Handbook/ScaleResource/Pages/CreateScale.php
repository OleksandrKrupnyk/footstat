<?php

namespace App\Filament\Resources\Handbook\ScaleResource\Pages;

use App\Filament\Resources\Handbook\ScaleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateScale extends CreateRecord
{
    protected static string $resource = ScaleResource::class;

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
