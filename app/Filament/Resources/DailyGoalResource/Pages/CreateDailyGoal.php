<?php

namespace App\Filament\Resources\DailyGoalResource\Pages;

use App\Filament\Resources\DailyGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyGoal extends CreateRecord
{
    protected static string $resource = DailyGoalResource::class;
}
