<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .spin-logo {
            animation: spin 10s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        img[src$="neo.png"] {
            background-color: transparent !important;
            mix-blend-mode: multiply;
        }
    </style>
</head>

<body class="min-h-screen flex bg-transparent">

    <div class="w-1/2 flex items-center justify-center" style="background-color: #E6F0FA;">
        <img src="{{ asset('Images/neo.png') }}" alt="Logo Neo Start Technology" class="mx-auto mb-4 spin-logo" style="width: 300px; height: auto;" />
    </div>
    

    <div class="w-1/2 flex items-center justify-center bg-white">
        <form method="POST" class="bg-white w-full max-w-sm p-8 space-y-4 shadow-lg rounded-xl" {{ route('vue') }}>
        @csrf

            <h2 class="text-2xl text-blue-800 font-bold text-center mb-4">Connexion</h2>

            <input type="email" name="email" placeholder="Email" 

                class="w-full px-4 py-2 border border-blue-300 rounded focus:ring-2 focus:ring-blue-500 " />
            <input type=" password" name="password" placeholder="Mot de passe"
                class="w-full px-4 py-2 border border-blue-300 rounded focus:ring-2 focus:ring-blue-500"  />
            <button type="submit"
                class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded font-semibold transition">Se connecter</button>
        </form>

    </div>
</body>

</html>