<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description',
        'assigned_to',
        'amount',
        'freelancer_pay',
        'deadline',
        'status',
    ];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public static function getStatusOptions(): array
    {
        return [
            'pending assignment',
            'in progress',
            'completed',
            'cancelled',
        ];
    }
}
