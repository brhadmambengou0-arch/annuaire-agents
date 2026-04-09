@props(['title' => null, 'description' => null, 'icon' => null, 'action' => null])

<section {{ $attributes->merge(['class' => 'py-12 px-4 sm:px-6 lg:px-8']) }}>
    <div class="max-w-7xl mx-auto">
        @if($title || $icon)
            <div class="flex items-start gap-4 mb-8">
                @if($icon)
                    <span class="text-4xl flex-shrink-0">{{ $icon }}</span>
                @endif
                <div class="flex-1">
                    @if($title)
                        <h2 class="text-3xl font-bold text-gray-900">{{ $title }}</h2>
                    @endif
                    @if($description)
                        <p class="mt-2 text-lg text-gray-600">{{ $description }}</p>
                    @endif
                </div>
                @if($action)
                    <div class="flex-shrink-0">{{ $action }}</div>
                @endif
            </div>
        @endif
        
        <div class="content">
            {{ $slot }}
        </div>
    </div>
</section>
