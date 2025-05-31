<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EffectivenessMetric extends Model
{
    use HasFactory;

    // أسماء الأعمدة التي يمكن الحماية من الحماية الجماعية (Mass Assignment)
    protected $fillable = [
        'week',
        'planned_goals',
        'achieved_results',
        'effectiveness_percentage',
    ];

    // تعيين أنواع الأعمدة (Casting)
    protected $casts = [
        'effectiveness_percentage' => 'decimal:2',
    ];
}
