<?php

namespace App\Filament\Resources\Handbook\ClubResource\Pages;

use App\Filament\Resources\Handbook\ClubResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClub extends CreateRecord
{
    protected static string $resource = ClubResource::class;

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
