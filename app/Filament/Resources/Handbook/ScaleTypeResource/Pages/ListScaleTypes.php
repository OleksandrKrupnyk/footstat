<?php

namespace App\Filament\Resources\Handbook\ScaleTypeResource\Pages;

use App\Filament\Resources\Handbook\ScaleTypeResource;
use Filament\Resources\Pages\ListRecords;

class ListScaleTypes extends ListRecords
{
    protected static string $resource = ScaleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
