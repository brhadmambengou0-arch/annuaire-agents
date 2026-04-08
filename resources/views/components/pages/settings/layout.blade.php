<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">{{ $heading ?? '' }}</h1>
        <p class="text-sm text-slate-500">{{ $subheading ?? '' }}</p>
    </div>
    <div class="bg-white shadow border border-slate-100 rounded-lg p-4">
        {{ $slot }}
    </div>
</div>
