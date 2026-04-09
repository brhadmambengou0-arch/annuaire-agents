@props(['variant' => 'primary', 'size' => 'md', 'type' => 'button', 'href' => null, 'icon' => null])

@php
$baseClasses = 'inline-flex items-center gap-2 rounded-lg font-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

$variantClasses = match($variant) {
    'primary' => 'bg-gradient-to-r from-sky-600 to-sky-500 text-white hover:shadow-lg hover:-translate-y-0.5 focus:ring-sky-500',
    'secondary' => 'bg-sky-100 text-sky-700 hover:bg-sky-200 focus:ring-sky-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
    'ghost' => 'text-sky-700 hover:bg-sky-50 focus:ring-sky-500',
    default => 'bg-gray-200 text-gray-700 hover:bg-gray-300 focus:ring-gray-500',
};

$sizeClasses = match($size) {
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg',
    default => 'px-4 py-2 text-base',
};

$classes = "$baseClasses $variantClasses $sizeClasses";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon) <span>{{ $icon }}</span> @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon) <span>{{ $icon }}</span> @endif
        {{ $slot }}
    </button>
@endif
