<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceIndicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'indicator_name',
        'score',
        'evaluated_at',
        'notes',
    ];

    /**
     * العلاقة مع الموظف
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
