@props(['icon' => null, 'title' => null, 'border' => false])

@php
$classes = 'bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-6' . ($border ? ' border border-sky-100' : '');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <div class="text-4xl mb-3">{{ $icon }}</div>
    @endif
    @if($title)
        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>
