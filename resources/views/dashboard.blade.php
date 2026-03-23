<x-app-layout>

<div class="p-6">

    <!--  HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Bonjour, {{ auth()->user()->name }} 
        </h1>
        <p class="text-gray-500">
            Bienvenue sur le tableau de bord de l’annuaire
        </p>
    </div>

    <!--  STATISTIQUES -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="text-gray-500 text-sm">Total Agents</h2>
            <p class="text-2xl font-bold text-blue-600">
                {{ \App\Models\Agent::count() }}
            </p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="text-gray-500 text-sm">Actifs</h2>
            <p class="text-2xl font-bold text-green-600">
                {{ \App\Models\Agent::where('is_active', true)->count() }}
            </p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="text-gray-500 text-sm">Fonctions</h2>
            <p class="text-2xl font-bold text-purple-600">
                {{ \App\Models\Fonction::count() }}
            </p>
        </div>

    </div>

    <!--  ACTIONS RAPIDES -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <a href="/annuaire"
           class="bg-blue-600 text-white p-6 rounded-xl shadow hover:bg-blue-700 transition block">
            <h2 class="text-lg font-bold mb-2"> Accéder à l'annuaire</h2>
            <p class="text-sm opacity-80">Voir tous les agents</p>
        </a>

        <a href="/admin/entites"
           class="bg-gray-800 text-white p-6 rounded-xl shadow hover:bg-gray-900 transition block">
            <h2 class="text-lg font-bold mb-2"> Gérer les structures</h2>
            <p class="text-sm opacity-80">Directions, services, départements</p>
        </a>

    </div>

</div>

</x-app-layout>