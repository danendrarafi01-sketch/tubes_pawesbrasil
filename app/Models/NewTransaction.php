<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewTransaction extends Model
{
    protected $table = 'new_transactions';
    
    protected $fillable = [
        'user_id', 'order_id', 'gross_amount', 'payment_status',
        'payment_type', 'snap_token', 'payment_details'
    ];

    protected $casts = [
        'payment_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(NewTransactionDetail::class, 'transaction_id');
    }
}