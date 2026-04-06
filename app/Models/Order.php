<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Tambahkan baris ini agar semua kolom diizinkan untuk diisi
    protected $guarded =[];
}