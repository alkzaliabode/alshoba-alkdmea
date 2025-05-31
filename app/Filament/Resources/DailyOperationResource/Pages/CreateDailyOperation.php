<?php

namespace App\Filament\Resources\DailyOperationResource\Pages;

use App\Filament\Resources\DailyOperationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyOperation extends CreateRecord
{
    protected static string $resource = DailyOperationResource::class;
}
