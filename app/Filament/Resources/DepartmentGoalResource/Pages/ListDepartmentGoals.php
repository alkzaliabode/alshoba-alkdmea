<?php

namespace App\Filament\Resources\DepartmentGoalResource\Pages;

use App\Filament\Resources\DepartmentGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDepartmentGoals extends ListRecords
{
    protected static string $resource = DepartmentGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
