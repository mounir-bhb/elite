<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizMap extends Model
{
    use HasFactory;

    protected $casts = [
        'reponse' => 'array',
    ];
}
