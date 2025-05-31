<?php

namespace App\Filament\Resources\EfficiencyMetricResource\Pages;

use App\Filament\Resources\EfficiencyMetricResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEfficiencyMetrics extends ListRecords
{
    protected static string $resource = EfficiencyMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
public function getTitle(): string
    {
        return 'جدول مقياس الكفاءة';
        
    }

}

