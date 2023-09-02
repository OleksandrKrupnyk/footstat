<?php

namespace App\Filament\Resources\Handbook\ScaleResource\Pages;

use App\Filament\Resources\Handbook\ScaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScales extends ListRecords
{
    protected static string $resource = ScaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
