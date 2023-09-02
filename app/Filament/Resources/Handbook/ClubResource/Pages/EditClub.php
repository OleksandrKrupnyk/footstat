<?php

namespace App\Filament\Resources\Handbook\ClubResource\Pages;

use App\Filament\Resources\Handbook\ClubResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClub extends EditRecord
{
    protected static string $resource = ClubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
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
