<?php

namespace App\Filament\Resources\Handbook\ClubResource\Pages;

use App\Filament\Resources\Handbook\ClubResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClubs extends ListRecords
{
    protected static string $resource = ClubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return ClubResource::getWidgets();
    }

    protected function getFooterWidgets(): array
    {
        return ClubResource::getWidgets();
    }
}
