<x-guest-layout>

<div class="min-h-screen flex">

    <!--  Partie gauche -->
    <div class="hidden md:flex w-1/2 bg-blue-600 text-white items-center justify-center">
        <div class="text-center p-10">
            <h1 class="text-3xl font-bold mb-4">Annuaire des Agents</h1>
            <p class="text-sm opacity-80">
                Créez votre compte pour accéder à la plateforme
            </p>
        </div>
    </div>

    <!--  Partie droite -->
    <div class="flex w-full md:w-1/2 items-center justify-center bg-gray-100">

        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">

            <!-- Titre -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Inscription</h2>
                <p class="text-sm text-gray-500">Créer un nouveau compte</p>
            </div>

            <!-- ERREURS -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-600 p-3 rounded">
                    <ul class="text-sm">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nom -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full mt-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full mt-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Mot de passe -->
                <div class="mb-4 relative">
                    <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                        class="w-full mt-1 border rounded-lg px-4 py-2 pr-10 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    <span onclick="togglePassword('password')" 
                          class="absolute right-3 top-9 cursor-pointer text-gray-500">
                        
                    </span>
                </div>

                <!-- Confirmation -->
                <div class="mb-4 relative">
                    <label class="block text-sm font-medium text-gray-700">Confirmer mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full mt-1 border rounded-lg px-4 py-2 pr-10 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    <span onclick="togglePassword('password_confirmation')" 
                          class="absolute right-3 top-9 cursor-pointer text-gray-500">
                        
                    </span>
                </div>

                <!-- Bouton -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    S'inscrire
                </button>

                <!-- Lien login -->
                <p class="text-sm text-center mt-4">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                        Se connecter
                    </a>
                </p>

            </form>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>
function togglePassword(id) {
    let input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}
</script>

</x-guest-layout>