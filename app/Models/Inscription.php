<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function formation(){
        return $this->belongsTo(Formation::class);
    }
    public function price(){
        return $this->belongsTo(Price::class);
    }
    public function ccps(){
        return $this->morphMany(Ccp::class,'ccpable');
    }
}
