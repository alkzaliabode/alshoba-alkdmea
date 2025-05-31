<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EfficiencyMetric extends Model
{
    use HasFactory;

    // تحديد الأعمدة القابلة للإدخال الجماعي
    protected $fillable = [
        'week',
        'used_resources',
        'achieved_results',
        'efficiency_percentage',
    ];

    // تحديد نوع التحويل لبعض الحقول (cast)
    protected $casts = [
        'efficiency_percentage' => 'decimal:2',
    ];
}
