<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainGoal extends Model
{
    use HasFactory;

    protected $fillable = ['goal_text'];

    public function departmentGoals()
    {
        return $this->hasMany(DepartmentGoal::class);
    }
}
