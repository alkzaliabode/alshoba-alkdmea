<?php

namespace App\Filament\Resources\SanitationFacilityTaskResource\Pages;

use App\Filament\Resources\SanitationFacilityTaskResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSanitationFacilityTask extends CreateRecord
{
    protected static string $resource = SanitationFacilityTaskResource::class;

    protected function afterCreate(): void
    {
        $employeeIds = $this->form->getState()['employees'] ?? [];

        if (!empty($employeeIds)) {
            $syncData = collect($employeeIds)->mapWithKeys(function ($id) {
                return [$id => ['task_type' => 'sanitation']];
            })->toArray();

            $this->record->employees()->sync($syncData);
        }
    }
}
