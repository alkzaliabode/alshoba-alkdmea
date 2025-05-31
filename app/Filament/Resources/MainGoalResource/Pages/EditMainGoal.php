<?php

namespace App\Filament\Resources\MainGoalResource\Pages;

use App\Filament\Resources\MainGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMainGoal extends EditRecord
{
    protected static string $resource = MainGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
