<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Créer un compte - Neo Start</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-8 md:p-10 space-y-6 border border-blue-200">

        <!-- Logo Neo Start -->
        <div class="flex justify-center">
            <img src="{{ asset('Images/neo.png') }}"
                alt="Logo Neo Start"
                class="w-20 h-20 object-contain rounded-full border-4 border-blue-100 shadow-md" />
        </div>

        <!-- Titre -->
        <div class="text-center">
            <h2 class="text-2xl md:text-3xl font-extrabold text-blue-700">Créer un compte administrateur</h2>
            <p class="text-sm text-blue-500 mt-1">Accès sécurisé à la plateforme Neo Start</p>
        </div>

        @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 border border-green-300 shadow">
            <p class="text-sm font-medium">
                {{ session('success') }}
            </p>
        </div>
        @endif

        <!-- Formulaire -->
        <form {{ route('vueAjoutAgent') }} method=" POST" class="space-y-5 text-blue-700">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium mb-1">Nom complet</label>
                <input type="text" id="name" placeholder="AKAKPO"
                    class="w-full px-4 py-2 border border-blue-300 bg-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-blue-800 placeholder-blue-400" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-1">Adresse e-mail</label>
                <input type="email" id="email" placeholder="exemple@neostart.com"
                    class="w-full px-4 py-2 border border-blue-300 bg-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-blue-800 placeholder-blue-400" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1">Mot de passe</label>
                <input type="password" id="password" placeholder="••••••••"
                    class="w-full px-4 py-2 border border-blue-300 bg-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-blue-800 placeholder-blue-400" />
            </div>

            <!-- Lien mot de passe oublié -->
            <div class="text-right">
                <a href="#" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
            </div>



            <!-- Bouton -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-2 rounded-xl transition duration-300 shadow-md">
                Valider
            </button>
        </form>

    </div>
</body>

</html>