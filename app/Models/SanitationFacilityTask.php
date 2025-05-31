<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SanitationFacilityTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'shift',
        'task_type',
        'facility_name',
        'details',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Many-to-Many relationship with Employee via employee_task.
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_task', 'task_id', 'employee_id')
            ->withPivot('task_type')
            ->withTimestamps();
    }
}
