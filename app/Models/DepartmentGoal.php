<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentGoal extends Model
{
    use HasFactory;

    protected $fillable = ['main_goal_id', 'goal_text'];

    public function mainGoal()
    {
        return $this->belongsTo(MainGoal::class);
    }

    public function unitGoals()
    {
        return $this->hasMany(UnitGoal::class);
    }
}
