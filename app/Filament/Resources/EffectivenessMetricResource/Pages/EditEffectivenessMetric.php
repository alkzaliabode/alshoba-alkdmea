<?php

namespace App\Filament\Resources\EffectivenessMetricResource\Pages;

use App\Filament\Resources\EffectivenessMetricResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEffectivenessMetric extends EditRecord
{
    protected static string $resource = EffectivenessMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
