<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatFact extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'counter',
        'counter_after',
    ];
}
