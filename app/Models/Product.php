<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    // TAMBAHKAN INI: Relasi Produk ke Ulasan
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}