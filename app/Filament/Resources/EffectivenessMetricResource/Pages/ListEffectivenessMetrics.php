<?php

namespace App\Filament\Resources\EffectivenessMetricResource\Pages;

use App\Filament\Resources\EffectivenessMetricResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEffectivenessMetrics extends ListRecords
{
    protected static string $resource = EffectivenessMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
public function getTitle(): string
    {
        return 'جدول مقياس الفعالية';
        
    }

}

