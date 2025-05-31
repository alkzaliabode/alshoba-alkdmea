<?php

namespace App\Filament\Resources\DailyGoalResource\Pages;

use App\Filament\Resources\DailyGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyGoal extends EditRecord
{
    protected static string $resource = DailyGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
