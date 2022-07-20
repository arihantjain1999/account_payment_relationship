<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'subject',
        'account_id',
        'payment_date',
        'payment_pending',
        'payment_recived',
        'pending_amount',
    ];   
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
