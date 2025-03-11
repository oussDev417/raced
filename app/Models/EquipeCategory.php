<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function equipes(): HasMany
    {
        return $this->hasMany(Equipe::class);
    }
}
