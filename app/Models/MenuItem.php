<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'url',
        'page_id',
        'order',
        'target',
        'icon',
        'is_active'
    ];

    /**
     * Les attributs à convertir en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Le menu auquel appartient cet item.
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * L'item parent de cet item (pour les sous-menus).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Les items enfants de cet item (pour les sous-menus).
     */
    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    /**
     * La page liée à cet item de menu (si applicable).
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Détermine si cet item a des enfants.
     */
    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    /**
     * Obtient l'URL complète pour cet item (selon qu'il pointe vers une page ou une URL directe).
     */
    public function getFullUrlAttribute(): string
    {
        if ($this->page_id) {
            return route('page.show', $this->page->slug);
        }
        
        return $this->url ?? '#';
    }
}
