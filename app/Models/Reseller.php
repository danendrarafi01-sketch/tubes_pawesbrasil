<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    use HasFactory;

    protected $table = 'reseller';
    public $timestamps = false;
    protected $fillable = [
        'nama_reseller',
        'jenis_toko',
        'wilayah',
        'alamat',
        'no_telepon',
        'status'
    ];
}