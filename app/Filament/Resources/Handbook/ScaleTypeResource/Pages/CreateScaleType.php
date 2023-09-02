<?php

namespace App\Filament\Resources\Handbook\ScaleTypeResource\Pages;

use App\Filament\Resources\Handbook\ScaleTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateScaleType extends CreateRecord
{
    protected static string $resource = ScaleTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
