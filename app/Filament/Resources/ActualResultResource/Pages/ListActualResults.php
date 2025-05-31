<?php

namespace App\Filament\Resources\ActualResultResource\Pages;

use App\Filament\Resources\ActualResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\DailyOperation;
use App\Models\ActualResult;
use App\Models\DailyGoal;
use Carbon\Carbon;

class ListActualResults extends ListRecords
{
    protected static string $resource = ActualResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Action::make('generateFromYesterday')
                ->label('تجميع بيانات الأمس')
                ->icon('heroicon-o-folder')
                ->color('success')
                ->action(function () {
                    $date = Carbon::yesterday()->toDateString();

                    $operations = DailyOperation::where('date', $date)->get();

                    if ($operations->isEmpty()) {
                        Notification::make()
                            ->title("❌ لا توجد عمليات ليوم $date")
                            ->danger()
                            ->send();
                        return;
                    }

                    $goal = DailyGoal::where('date', $date)->first();

                    if (ActualResult::where('date', $date)->exists()) {
                        Notification::make()
                            ->title("⚠ نتائج يوم $date موجودة مسبقًا")
                            ->warning()
                            ->send();
                        return;
                    }

                    ActualResult::create([
                        'date' => $date,
                        'goal_id' => $goal?->id,
                        'completed_tasks' => 0,
                        'in_progress_tasks' => 0,
                        'cancelled_tasks' => 0,
                        'completion_percentage' => 0,
                        'details' => json_encode($operations->toArray()),
                    ]);

                    Notification::make()
                        ->title("✅ تم حفظ بيانات يوم $date")
                        ->success()
                        ->send();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'جدول النتائج';
    }
}
