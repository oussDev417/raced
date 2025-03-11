<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipe_category_id',
        'name',
        'position',
        'phone',
        'email',
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipeCategory::class, 'equipe_category_id');
    }
}
