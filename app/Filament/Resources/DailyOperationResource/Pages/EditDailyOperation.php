<?php

namespace App\Filament\Resources\DailyOperationResource\Pages;

use App\Filament\Resources\DailyOperationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyOperation extends EditRecord
{
    protected static string $resource = DailyOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
