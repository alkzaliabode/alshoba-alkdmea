<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'evaluation_date',
        'tasks_completed',
        'goals_assigned',
        'efficiency',
        'effectiveness',
        'notes',
    ];

    protected $casts = [
        'evaluation_date' => 'date',
        'efficiency' => 'decimal:2',
        'effectiveness' => 'decimal:2',
    ];

    // العلاقة مع الموظف
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
