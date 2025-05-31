<?php

namespace App\Filament\Resources\EfficiencyMetricResource\Pages;

use App\Filament\Resources\EfficiencyMetricResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEfficiencyMetric extends EditRecord
{
    protected static string $resource = EfficiencyMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
