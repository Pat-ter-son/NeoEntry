Your `edit.blade.php` code is already quite good\! It correctly pre-fills form fields using `old()` and the `$agent` object, handles file inputs for photos, and includes error/success messages.

The only minor improvements I can suggest are:

1. **Adding a default `btn-secondary` style**: Since you're using `btn-secondary` for your "Retour" link, it's good practice to define its styles within your `<style>
    ` block to ensure it looks consistent. 2. **Using `asset()` for default image paths**: If you have default images for `photo` or `photo_cni` (e.g., when an agent doesn't have one), you should use `asset()` in your Blade template for these paths as well, just like you do for your logo. This is a best practice in Laravel.

        Here's the corrected code with these minor additions:

        ----- ### `resources/views/AjoutAgent/edit.blade.php` (Code Corrigé) ```html < !DOCTYPE html> <html lang="fr" > <head> <meta charset="UTF-8" /> <meta name="viewport" content="width=device-width, initial-scale=1" /> <title>Modifier un Agent - Bleu & Blanc</title> <script src="https://cdn.tailwindcss.com" ></script> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" > <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"

        rel="stylesheet" > <style> body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 20s linear infinite;
        }

        .glass-card {
            background: rgba(255 255 255 / 0.15);
            backdrop-filter: saturate(180%) blur(15px);
            -webkit-backdrop-filter: saturate(180%) blur(15px);
            border: 1px solid rgba(255 255 255 / 0.3);
            border-radius: 1.25rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .btn-primary {
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: white;
            box-shadow: 0 6px 15px rgba(59, 130, 246, 0.6);
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #1d4ed8, #2563eb);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.8);
        }

        /* Added style for btn-secondary for consistency */
        .btn-secondary {
            background: #dbeafe;
            color: #2563eb;
            box-shadow: none;
            border: 2px solid #3b82f6;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #bfdbfe;
            color: #1e40af;
            border-color: #1e40af;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }
</style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-200 min-h-screen font-sans text-blue-900">

    <header class="py-10 text-center">
        <img src="{{ asset('Images/neo.png') }}" alt="Logo" class="mx-auto w-24 h-24 animate-spin-slow drop-shadow-lg" />
        <h1 class="mt-4 text-4xl font-extrabold tracking-wide">Modifier un Agent</h1>
        <p class="mt-2 text-blue-700 max-w-xl mx-auto">Mettez à jour les informations de {{ $agent->prenoms }} {{ $agent->nom }}</p>
    </header>

    <main class="max-w-7xl mx-auto px-4 md:px-8 mb-20">

        <section class="glass-card p-10 mb-14">
            <h2 class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Édition de l'agent
                <span class="text-blue-600">{{ $agent->nom }} {{ $agent->prenoms }}</span>
            </h2>

            @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form class="grid md:grid-cols-2 gap-6" method="POST" action="{{ route('updateAjouteAgent', $agent->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Indique à Laravel que c'est une requête PUT pour la mise à jour --}}

                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="nom">Nom</label>
                    <input id="nom" type="text" name="nom" required
                        value="{{ old('nom', $agent->nom) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="prenoms">Prénoms</label>
                    <input id="prenoms" type="text" name="prenoms" required
                        value="{{ old('prenoms', $agent->prenoms) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="matricule">Matricule</label>
                    <input id="matricule" type="text" name="matricule" required
                        value="{{ old('matricule', $agent->matricule) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="fonction">Fonction</label>
                    <input id="fonction" type="text" name="fonction" required
                        value="{{ old('fonction', $agent->fonction) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="departement">Département</label>
                    <input id="departement" type="text" name="departement" required
                        value="{{ old('departement', $agent->departement) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="statut">Statut</label>
                    <select id="statut" name="statut" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Sélectionner le statut</option>
                        <option value="En fonction" {{ old('statut', $agent->statut) == 'En fonction' ? 'selected' : '' }}>En fonction</option>
                        <option value="En retraite" {{ old('statut', $agent->statut) == 'En retraite' ? 'selected' : '' }}>En retraite</option>
                        <option value="Hors service" {{ old('statut', $agent->statut) == 'Hors service' ? 'selected' : '' }}>Hors service</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="numApp">N° Appartement</label>
                    <input id="numApp" type="number" name="numApp" required
                        value="{{ old('numApp', $agent->numApp) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="sexe">Sexe</label>
                    <select id="sexe" name="sexe" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Sélectionner le sexe</option>
                        <option value="M" {{ old('sexe', $agent->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                        <option value="F" {{ old('sexe', $agent->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                        <option value="Autre" {{ old('sexe', $agent->sexe) == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="dateNaissance">Date de naissance</label>
                    <input id="dateNaissance" type="date" name="dateNaissance"
                        value="{{ old('dateNaissance', $agent->dateNaissance) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="dateEntree">Date d’entrée</label>
                    <input id="dateEntree" type="date" name="dateEntree"
                        value="{{ old('dateEntree', $agent->dateEntree) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="photo">Photo</label>
                    @if ($agent->photo)
                    <p class="text-sm text-gray-600 mb-2">Photo actuelle :</p>
                    <img src="{{ Storage::url($agent->photo) }}" alt="Photo actuelle de l'agent" class="w-24 h-24 rounded-full object-cover mb-4 border border-blue-300">
                    @else
                    {{-- Using asset() for default image if there's no photo --}}
                    <p class="text-sm text-gray-600 mb-2">Aucune photo actuelle.</p>
                    <img src="{{ asset('images/default-user-blue.png') }}" alt="Photo par défaut" class="w-24 h-24 rounded-full object-cover mb-4 border border-blue-300">
                    @endif
                    <input id="photo" type="file" name="photo" accept="image/*"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
                    <small class="text-gray-500 mt-1 block">Laissez vide pour conserver la photo actuelle.</small>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="photo_cni">Photo de la CNI</label>
                    @if ($agent->photo_cni)
                    <p class="text-sm text-gray-600 mb-2">CNI actuelle :</p>
                    <img src="{{ Storage::url($agent->photo_cni) }}" alt="CNI actuelle de l'agent" class="max-w-full h-auto rounded-lg shadow-md border border-blue-300 mb-4">
                    @else
                    {{-- Using asset() for default CNI image if there's no photo --}}
                    <p class="text-sm text-gray-600 mb-2">Aucune photo CNI actuelle.</p>
                    <img src="{{ asset('images/default-cni-blue.png') }}" alt="CNI par défaut" class="max-w-full h-auto rounded-lg shadow-md border border-blue-300 mb-4">
                    @endif
                    <input id="photo_cni" type="file" name="photo_cni" accept="image/*"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
                    <small class="text-gray-500 mt-1 block">Laissez vide pour conserver la CNI actuelle.</small>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="email">Email</label>
                    <input id="email" type="email" name="email"
                        value="{{ old('email', $agent->email) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="phone">Téléphone</label>
                    <input id="phone" type="tel" name="phone"
                        value="{{ old('phone', $agent->phone) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="adresse">Adresse</label>
                    <input id="adresse" type="text" name="adresse"
                        value="{{ old('adresse', $agent->adresse) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="ville">Ville</label>
                    <input id="ville" type="text" name="ville"
                        value="{{ old('ville', $agent->ville) }}"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>

                <div class="md:col-span-2 flex justify-center mt-6">
                    <button type="submit"
                        class="bg-blue-700 text-white px-16 py-4 rounded-3xl font-semibold shadow-lg hover:bg-blue-800 transition duration-300 flex items-center justify-center gap-3">
                        Mettre à jour l'agent
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </form>
            <div class="mt-8 text-center">
                <a href="{{ route('vueAjoutAgent') }}" class="btn-secondary inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Retour à la liste des agents
                </a>
            </div>
        </section>

    </main>
</body>

</html>
```