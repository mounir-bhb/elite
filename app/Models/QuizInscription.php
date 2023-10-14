<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizInscription extends Model
{
    use HasFactory;

    public function price(){
        return $this->belongsTo(Price::class);
    }
    public function ccps(){
        return $this->morphMany(Ccp::class,'ccpable');
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
