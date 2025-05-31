<?php

namespace App\Filament\Resources\DailyOperationResource\Pages;

use App\Filament\Resources\DailyOperationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyOperations extends ListRecords
{
    protected static string $resource = DailyOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'جدول الاعمال اليومية';
        
    }

}

