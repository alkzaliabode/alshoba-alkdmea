<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DailyOperation;
use App\Models\ActualResult;
use App\Models\DailyGoal;
use Carbon\Carbon;

class GenerateDailyActualResults extends Command
{
    protected $signature = 'results:generate-daily';
    protected $description = 'توليد النتائج اليومية تلقائيًا من المهام اليومية';

    public function handle()
    {
        $date = Carbon::yesterday()->toDateString();

        $completed = DailyOperation::where('date', $date)->where('status', 'completed')->count();
        $inProgress = DailyOperation::where('date', $date)->where('status', 'in_progress')->count();
        $cancelled = DailyOperation::where('date', $date)->where('status', 'cancelled')->count();

        $total = $completed + $inProgress + $cancelled;
        $completionPercentage = $total > 0 ? round(($completed / $total) * 100, 2) : 0;

        $goal = DailyGoal::where('date', $date)->first();

        ActualResult::create([
            'date' => $date,
            'goal_id' => $goal?->id,
            'completed_tasks' => $completed,
            'in_progress_tasks' => $inProgress,
            'cancelled_tasks' => $cancelled,
            'completion_percentage' => $completionPercentage,
        ]);

        $this->info("تم توليد نتائج يوم $date بنجاح ✅");
    }
}