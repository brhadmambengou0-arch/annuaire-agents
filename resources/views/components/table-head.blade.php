@props(['striped' => true])

<thead class="bg-sky-50 {{ $striped ? 'divide-x divide-gray-200' : '' }}">
    <tr>
        {{ $slot }}
    </tr>
</thead>
