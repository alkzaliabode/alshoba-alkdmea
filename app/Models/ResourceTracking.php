<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceTracking extends Model
{
    use HasFactory;

    protected $fillable = [
         'date',
    'unit_type', // أضف هذا
    'employees_count', // غيّر من number_of_employees إلى هذا الاسم
    'hours_per_employee', // غيّر من working_hours_per_employee إلى هذا الاسم
    'total_working_hours',
    ];

    protected $casts = [
        'date' => 'date',
        'working_hours_per_employee' => 'decimal:2',
        'total_working_hours' => 'decimal:2',
    ];
}
