<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    public function Referrel(){
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referred(){
        return $this->belongsTo(User::class, 'referred_id');
    }
}
