<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $with=['ccps'];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function ccps(){
        return $this->morphMany(Ccp::class,'ccpable');
    }
}
