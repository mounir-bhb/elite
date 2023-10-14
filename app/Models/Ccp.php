<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ccp extends Model
{
    use HasFactory;

    /* public function inscription(){
        return $this->belongsTo(inscription::class);
    } */
    public function ccpable(){
        return $this->morphTo();
    }
}
