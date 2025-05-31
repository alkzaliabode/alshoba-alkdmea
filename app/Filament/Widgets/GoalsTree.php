<?php

namespace App\Filament\Widgets;
use App\Models\MainGoal;
use Filament\Widgets\Widget;

class GoalsTree extends Widget
{
    protected static string $view = 'filament.widgets.goals-tree';

    protected static ?int $sort = 1; // للظهور في الأعلى

    public function getMainGoal()
    {
        return MainGoal::with('departmentGoals.unitGoals')->first();
    }
}