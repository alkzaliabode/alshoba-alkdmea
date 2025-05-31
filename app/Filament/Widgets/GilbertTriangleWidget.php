<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DailyGoal;
use App\Models\ActualResult;
use App\Models\ResourceTracking;
use Carbon\Carbon;

class GilbertTriangleWidget extends ChartWidget
{
    protected static ?string $heading = 'مثلث جلبرت - تحليل الأداء';
    protected static ?string $maxHeight = '500px';
    protected static ?int $sort = 1;
    protected static ?string $pollingInterval = null;

    protected function getType(): string
    {
        return 'radar';
    }

    protected function getData(): array
    {
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        return [
            'datasets' => [
                [
                    'label' => 'اليوم',
                    'data' => $this->prepareTriangleData($today),
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'pointBackgroundColor' => 'rgba(59, 130, 246, 1)',
                    'pointBorderColor' => '#fff',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgba(59, 130, 246, 1)',
                ],
                [
                    'label' => 'الأمس',
                    'data' => $this->prepareTriangleData($yesterday),
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'borderColor' => 'rgba(239, 68, 68, 1)',
                    'pointBackgroundColor' => 'rgba(239, 68, 68, 1)',
                    'pointBorderColor' => '#fff',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgba(239, 68, 68, 1)',
                ],
            ],
            'labels' => ['النتائج', 'الأهداف', 'الموارد'], // الترتيب المعدل
        ];
    }

    private function prepareTriangleData(string $date): array
    {
        $goal = DailyGoal::where('date', $date)->first();
        $result = ActualResult::where('date', $date)->first();
        $resource = ResourceTracking::where('date', $date)->first();

        $goalValue = $goal?->total_goal ?: 1;
        $resultValue = $result?->completed_tasks ?: 0;
        $resourceValue = $resource?->total_working_hours ?: 1;

        // الترتيب المعدل حسب المطلوب: النتائج أولاً، ثم الأهداف، ثم الموارد
        return [
            $resultValue > 0 ? 100 : 0, // النتائج (أعلى القمة)
            min(100, round(($resultValue / $goalValue) * 100, 2)), // الأهداف (القاعدة اليمنى)
            min(100, round(($resultValue / $resourceValue) * 100, 2)), // الموارد (القاعدة اليسرى)
        ];
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => true,
            'scales' => [
                'r' => [
                    'angleLines' => [
                        'display' => true,
                        'color' => 'rgba(0, 0, 0, 0.1)'
                    ],
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                    'ticks' => [
                        'stepSize' => 20,
                        'backdropColor' => 'transparent',
                        'showLabelBackdrop' => false
                    ],
                    'pointLabels' => [
                        'font' => [
                            'family' => 'Tajawal, sans-serif',
                            'size' => 14,
                            'weight' => 'bold'
                        ]
                    ]
                ]
            ],
            'elements' => [
                'line' => [
                    'tension' => 0,
                    'borderWidth' => 3
                ],
                'point' => [
                    'radius' => 5,
                    'hoverRadius' => 8,
                    'borderWidth' => 2
                ]
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                    'rtl' => true,
                    'labels' => [
                        'font' => [
                            'family' => 'Tajawal, sans-serif',
                            'size' => 14
                        ],
                        'usePointStyle' => true
                    ]
                ],
                'tooltip' => [
                    'rtl' => true,
                    'bodyFont' => [
                        'family' => 'Tajawal, sans-serif',
                        'size' => 14
                    ],
                    'titleFont' => [
                        'family' => 'Tajawal, sans-serif',
                        'size' => 16,
                        'weight' => 'bold'
                    ],
                    'callbacks' => [
                        'label' => 'function(context) {
                            return " " + context.dataset.label + ": " + context.raw + "%";
                        }'
                    ]
                ]
            ]
        ];
    }
}