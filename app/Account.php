<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'address',
        'status',
        'payment_pending',
        'payment_recived',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
