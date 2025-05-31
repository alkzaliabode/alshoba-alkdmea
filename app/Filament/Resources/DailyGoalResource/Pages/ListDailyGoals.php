<?php

namespace App\Filament\Resources\DailyGoalResource\Pages;

use App\Filament\Resources\DailyGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyGoals extends ListRecords
{
    protected static string $resource = DailyGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
public function getTitle(): string
    {
        return 'جدول الأهداف اليومية';
        
    }

}
