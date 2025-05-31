<?php

namespace App\Filament\Resources\MainGoalResource\Pages;

use App\Filament\Resources\MainGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMainGoals extends ListRecords
{
    protected static string $resource = MainGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
