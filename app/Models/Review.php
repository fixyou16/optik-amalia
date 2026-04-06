<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    // Relasi: Satu ulasan dimiliki oleh satu user
    public function user() {
        return $this->belongsTo(User::class);
    }
}