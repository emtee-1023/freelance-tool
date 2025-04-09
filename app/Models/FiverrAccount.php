<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiverrAccount extends Model
{
    protected $fillable = [
        'username',
        'link',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'fiverr_account_id');
    }
}
