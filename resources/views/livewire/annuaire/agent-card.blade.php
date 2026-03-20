<div class="bg-white p-4 rounded shadow hover:shadow-lg transition cursor-pointer"
     wire:click="showDetails">
    <div class="flex items-center space-x-4">
        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="w-12 h-12 rounded-full">
        <div>
            <h3 class="font-semibold text-pink-700">{{ $agent->nom }} {{ $agent->prenom }}</h3>
            <p class="text-gray-500">{{ $agent->fonction->nom ?? 'Fonction non définie' }}</p>
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded shadow-lg p-6 w-96">
                <h2 class="text-xl font-bold mb-4">{{ $agent->nom }} {{ $agent->prenom }}</h2>
                <p><strong>Email:</strong> {{ $agent->email }}</p>
                <p><strong>Téléphone:</strong> {{ $agent->telephone ?? 'N/A' }}</p>
                <p><strong>Fonction:</strong> {{ $agent->fonction->nom ?? 'N/A' }}</p>

                <button wire:click="closeModal"
                        class="mt-4 bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700">
                    Fermer
                </button>
            </div>
        </div>
    @endif
</div>