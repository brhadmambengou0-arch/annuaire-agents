@props(['variant' => 'info', 'icon' => null, 'title' => null])

@php
$variantClasses = match($variant) {
    'success' => 'bg-emerald-50 border-emerald-200 text-emerald-800',
    'danger' => 'bg-red-50 border-red-200 text-red-800',
    'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
    'info' => 'bg-blue-50 border-blue-200 text-blue-800',
    default => 'bg-sky-50 border-sky-200 text-sky-800',
};

$classes = "border rounded-lg p-4 " . $variantClasses;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if($title)
        <h4 class="font-semibold mb-1">{{ $title }}</h4>
    @endif
    <div class="flex items-start gap-3">
        @if($icon)
            <span class="text-lg flex-shrink-0">{{ $icon }}</span>
        @endif
        <div class="text-sm">
            {{ $slot }}
        </div>
    </div>
</div>
