<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualResult extends Model
{
    use HasFactory;

    protected $fillable = [
      'date',
    'unit_type',
    'completed_tasks',
    'in_progress_tasks', // ← تأكد من إضافته
    'cancelled_tasks',
    'completion_percentage',
    'unit_goal_id',
    ];

    // يمكنك هنا إضافة كاستات للحقول إذا أردت
    protected $casts = [
        'date' => 'date',
        'completion_percentage' => 'decimal:2',
    ];
    public function goal()
{
        return $this->belongsTo(UnitGoal::class, 'unit_goal_id');

}
}
