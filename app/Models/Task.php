<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description',
        'assigned_to',
        'client_id',
        'amount',
        'freelancer_pay',
        'deadline',
        'status',
        'fiverr_account_id',
    ];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function fiverrAccount()
    {
        return $this->belongsTo(FiverrAccount::class, 'fiverr_account_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
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
