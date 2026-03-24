<div class="flex gap-6">

    <!--   SIDEBAR (ARBRE STATIQUE) -->
    <div class="w-64 bg-white rounded shadow p-4">

        <h2 class="font-bold text-pink-700 mb-4">Structures</h2>

        <ul class="space-y-2 text-sm">
            <li class="font-semibold text-gray-700">Direction Générale</li>

            <li class="ml-4 text-gray-600"> Service RH</li>
            <li class="ml-8 text-gray-500"> Département Recrutement</li>
            <li class="ml-8 text-gray-500"> Département Formation</li>

            <li class="ml-4 text-gray-600"> Service Informatique</li>
            <li class="ml-8 text-gray-500"> Support IT</li>
        </ul>

    </div>


    <!-- CONTENU PRINCIPAL -->
    <div class="flex-1 space-y-6">

        <!-- 🔎 BARRE ENCADRÉE -->
        <div class="bg-white p-4 rounded shadow flex flex-col md:flex-row gap-4">

            <!-- Recherche -->
            <input type="text"
                   wire:model="search"
                   placeholder="Rechercher un agent..."
                   class="flex-1 border p-2 rounded focus:outline-none focus:ring focus:border-pink-300">

            <!-- Boutons -->
            <div class="flex gap-2">
                <button class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">
                    Réinitialiser
                </button>

                <button class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
                    + Ajouter
                </button>
            </div>

        </div>


        <!-- 👤 PLACEHOLDER AGENT CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- Carte 1 -->
            <div class="bg-white p-4 rounded shadow animate-pulse">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                    <div class="space-y-2">
                        <div class="w-24 h-3 bg-gray-300 rounded"></div>
                        <div class="w-16 h-3 bg-gray-200 rounded"></div>
                    </div>
                </div>
            </div>

            <!-- Carte 2 -->
            <div class="bg-white p-4 rounded shadow animate-pulse">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                    <div class="space-y-2">
                        <div class="w-24 h-3 bg-gray-300 rounded"></div>
                        <div class="w-16 h-3 bg-gray-200 rounded"></div>
                    </div>
                </div>
            </div>

            <!-- Carte 3 -->
            <div class="bg-white p-4 rounded shadow animate-pulse">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                    <div class="space-y-2">
                        <div class="w-24 h-3 bg-gray-300 rounded"></div>
                        <div class="w-16 h-3 bg-gray-200 rounded"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>