@props([
    'href' => null,
    'variant' => 'nav',
    'as' => 'a',
])

@php
    $href = $href ?? route('home.index');
@endphp

@if ($as === 'a')
<a href="{{ $href }}" {{ $attributes->class(['site-logo', 'site-logo--' . $variant]) }} aria-label="The Travel Squad — Home">
@else
<div {{ $attributes->class(['site-logo', 'site-logo--' . $variant]) }}>
@endif
<svg class="site-logo__mark" viewBox="0 0 32 32" width="32" height="32" aria-hidden="true" focusable="false">
<rect x="2" y="2" width="28" height="28" rx="8" stroke="currentColor" stroke-width="1.75" fill="none"/>
<circle cx="11" cy="21" r="2" fill="currentColor"/>
<circle cx="21" cy="21" r="2" fill="currentColor"/>
<circle cx="16" cy="11" r="2" fill="currentColor"/>
<path d="M11 21L16 11L21 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<span class="site-logo__text">Travel Squad</span>
@if ($as === 'a')
</a>
@else
</div>
@endif
