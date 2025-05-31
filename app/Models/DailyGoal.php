<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'cleaning_department_goal',
        'maintenance_department_goal',
        'total_goal',
    ];
    public function actualResult()
{
    return $this->hasOne(ActualResult::class, 'goal_id');
}

}
