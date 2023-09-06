<?php

namespace App\Filament\Resources\Handbook\ScaleTypeResource\Pages;

use App\Filament\Resources\Handbook\ScaleTypeResource;
use Filament\Resources\Pages\EditRecord;

class EditScaleType extends EditRecord
{
    protected static string $resource = ScaleTypeResource::class;

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
//            Actions\DeleteAction::make()
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
