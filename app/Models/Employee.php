<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'employee';

    protected $fillable = [
        'name',
        'email',
        'password',
        'job_title',
        'department',
        'shift',
        'phone',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function performanceEvaluations()
    {
        return $this->hasMany(PerformanceEvaluation::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'employee_task')->withTimestamps();
    }
}
