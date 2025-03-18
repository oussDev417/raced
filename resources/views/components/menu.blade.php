@props(['location' => 'header', 'class' => ''])

@php
    $menu = \App\Models\Menu::where('location', $location)
        ->where('is_active', true)
        ->first();
@endphp

@if($menu && $menu->items->count() > 0)
    @foreach($menu->items()->whereNull('parent_id')->where('is_active', true)->orderBy('order')->get() as $item)
        <a href="{{ $item->url ?: ($item->page ? route('page.show', $item->page->slug) : '#') }}" 
            target="{{ $item->target }}" 
            class="{{ request()->url() == $item->url ? 'active' : '' }} {{ $item->class }}">
            @if($item->icon)
                <i class="{{ $item->icon }}"></i>
            @endif
            {{ $item->title }}
        </a>
    @endforeach
@endif 