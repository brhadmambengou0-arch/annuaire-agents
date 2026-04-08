@props(['variant' => 'gray', 'size' => 'md'])

@php
$variantClasses = match($variant) {
    'primary' => 'bg-sky-100 text-sky-800',
    'success' => 'bg-emerald-100 text-emerald-800',
    'danger' => 'bg-red-100 text-red-800',
    'warning' => 'bg-amber-100 text-amber-800',
    'info' => 'bg-blue-100 text-blue-800',
    default => 'bg-gray-100 text-gray-800',
};

$sizeClasses = match($size) {
    'sm' => 'px-2 py-1 text-xs',
    'md' => 'px-3 py-1 text-sm',
    'lg' => 'px-4 py-2 text-base',
    default => 'px-3 py-1 text-sm',
};

$classes = "inline-flex items-center gap-1.5 rounded-full font-semibold " . $variantClasses . ' ' . $sizeClasses;
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
