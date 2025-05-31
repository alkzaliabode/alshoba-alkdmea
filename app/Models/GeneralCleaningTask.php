<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GeneralCleaningTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'shift',
        'task_type',
        'location',
        'quantity',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'quantity' => 'integer',
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_task', 'task_id', 'employee_id')
            ->withPivot('task_type')
            ->withTimestamps();
    }
}
