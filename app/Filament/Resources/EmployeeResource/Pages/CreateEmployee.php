<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected ?string $roleToAssign = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->roleToAssign = $data['role'] ?? null;
        unset($data['role']); // لا نريد حفظه مباشرة ضمن الجدول

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->roleToAssign) {
            $this->record->assignRole($this->roleToAssign);
        }
    }
}
