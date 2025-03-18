<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'type',
        'blade_component',
        'description',
        'default_data',
        'is_active'
    ];

    /**
     * Les attributs à convertir en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'default_data' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Les pages associées à cette section.
     */
    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'page_sections')
                    ->withPivot('section_data', 'order', 'is_active', 'custom_class', 'settings');
    }

    /**
     * Les relations pivot page-section.
     */
    public function pageSections(): HasMany
    {
        return $this->hasMany(PageSection::class);
    }
}
