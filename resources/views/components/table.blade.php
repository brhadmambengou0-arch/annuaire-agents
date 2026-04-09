@props(['striped' => true])

<div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="w-full {{ $striped ? 'divide-y divide-gray-200' : '' }}">
        {{ $slot }}
    </table>
</div>
