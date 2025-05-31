<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyOperation extends Model
{
    use HasFactory;

    // الحقول القابلة للتعبئة الجماعية
    protected $fillable = [
        'date',
        'shift',
        'type',
        'location',
        'status',
        'notes',
        'responsible_persons',
    ];

    // التحويلات (Casts)
    protected $casts = [
        'date' => 'date',
    ];
}
