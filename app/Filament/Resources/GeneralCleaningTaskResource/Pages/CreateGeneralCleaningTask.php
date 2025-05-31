<?php

namespace App\Filament\Resources\GeneralCleaningTaskResource\Pages;

use App\Filament\Resources\GeneralCleaningTaskResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGeneralCleaningTask extends CreateRecord
{
    protected static string $resource = GeneralCleaningTaskResource::class;

    protected function afterCreate(): void
    {
        $employeeIds = $this->form->getState()['employees'] ?? [];

        if (!empty($employeeIds)) {
            $syncData = collect($employeeIds)->mapWithKeys(function ($id) {
                return [$id => ['task_type' => 'general_cleaning']];
            })->toArray();

            $this->record->employees()->sync($syncData);
        }
    }
}
