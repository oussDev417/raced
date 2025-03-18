<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'section_id',
        'section_data',
        'order',
        'is_active',
        'custom_class',
        'settings'
    ];

    /**
     * Les attributs à convertir en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'section_data' => 'array',
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * La page à laquelle appartient cette relation.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * La section à laquelle appartient cette relation.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
