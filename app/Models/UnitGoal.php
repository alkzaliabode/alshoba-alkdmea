<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitGoal extends Model
{
    protected $fillable = [
        'department_goal_id',
        'unit_name',
        'goal_text',
        'target_value',
        'is_active',
    ];

    public function departmentGoal(): BelongsTo
    {
        return $this->belongsTo(DepartmentGoal::class);
    }

    public function actualResults(): HasMany
    {
    return $this->hasMany(ActualResult::class, 'unit_goal_id');
        
    }

    public function resourceTrackings(): HasMany
    {
        return $this->hasMany(ResourceTracking::class);
    }

    public function calculateEfficiency(): float
    {
        $results = $this->actualResults()->sum('value');
        $resources = $this->resourceTrackings()->sum('cost');
        
        return $resources > 0 ? round(($results / $resources) * 100, 2) : 0;
    }
}