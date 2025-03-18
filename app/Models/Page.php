<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'meta_description',
        'meta_keywords',
        'template',
        'status',
        'is_home',
        'show_in_menu',
        'menu_order'
    ];

    /**
     * Les attributs à convertir en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'is_home' => 'boolean',
        'show_in_menu' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Les sections associées à la page.
     */
    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'page_sections')
                    ->withPivot('section_data', 'order', 'is_active', 'custom_class', 'settings')
                    ->orderBy('page_sections.order');
    }

    /**
     * Les relations pivot page-section.
     */
    public function pageSections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }

    /**
     * Les items de menu qui pointent vers cette page.
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
