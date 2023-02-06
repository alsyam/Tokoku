<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['clothes', 'author'];

    public function clothes()
    {
        return $this->belongsTo(Clothes::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_booking_id');
    }
}
