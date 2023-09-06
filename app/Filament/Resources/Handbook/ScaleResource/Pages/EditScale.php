<?php

namespace App\Filament\Resources\Handbook\ScaleResource\Pages;

use App\Filament\Resources\Handbook\ScaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScale extends EditRecord
{
    protected static string $resource = ScaleResource::class;

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
