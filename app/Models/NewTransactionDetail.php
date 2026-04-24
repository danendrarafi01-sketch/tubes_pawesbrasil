<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewTransactionDetail extends Model
{
    protected $table = 'new_transaction_details';
    
    protected $fillable = [
        'transaction_id', 'produk_id', 'quantity', 'price'
    ];

    public function transaction()
    {
        return $this->belongsTo(NewTransaction::class, 'transaction_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}