<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class WeeklyImprovementChart extends ChartWidget
{
    protected static ?string $heading = 'مؤشر التحسن الأسبوعي';

    // استخدام مخطط أعمدة (Bar chart)
    protected function getType(): string
    {
        return 'bar';
    }

    // البيانات التي سيتم عرضها في المخطط
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'التحسن',
                    'data' => [10, 15, 18, 22, 30, 35, 40], // بيانات الأيام
                    'backgroundColor' => '#10B981', // لون الأعمدة (أخضر)
                ],
            ],
            'labels' => ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
        ];
    }
}
