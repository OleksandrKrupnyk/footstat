<?php

namespace App\Filament\Resources\Control\UserResource\Pages;

use App\Filament\Resources\Control\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
