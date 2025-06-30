<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Enregistrement Visiteur - Bleu & Blanc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Application de la police Poppins */
        }

        /* Animation rotation lente pour le logo */
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

        /* Glass effect */
        .glass-card {
            background: rgba(255 255 255 / 0.15);
            backdrop-filter: saturate(180%) blur(15px);
            -webkit-backdrop-filter: saturate(180%) blur(15px);
            border: 1px solid rgba(255 255 255 / 0.3);
            border-radius: 1.25rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        /* Scrollbar personnalisé pour table */
        ::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #2563eb;
            /* bleu tailwind-600 */
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #e0e7ff;
            /* bleu clair tailwind-200 */
            border-radius: 10px;
        }

        /* Overlay fade */
        .modal-overlay {
            background-color: rgba(13, 42, 148, 0.7);
            /* bleu foncé transparent */
            backdrop-filter: blur(8px);
        }

        /* Transition modal */
        .modal-open {
            opacity: 1;
            transform: scale(1);
            transition: all 0.3s ease;
        }

        .modal-closed {
            opacity: 0;
            transform: scale(0.9);
            pointer-events: none;
            transition: all 0.3s ease;
        }

        <div class="search-container mx-auto mb-6 glass-card p-1 rounded-md shadow-md"><input type="text" id="searchInput" class="search-input bg-white/80 backdrop-blur-sm border-none focus:border-blue-500 focus:ring-blue-500" placeholder="Rechercher un agent..."><svg class="search-icon w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M21 21l-6-6m2-6a7 7 0 10-14 0 7 7 0 0014 0z"></path></svg></div><style>

        /* Style pour la barre de recherche */
        .search-container {
            position: relative;
            width: 100%;
            max-width: 400px;
            margin-bottom: 2rem;
            /* Removed padding and border from search-container as glass-card handles it */
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #1e3a8a;
            /* Tailwind blue-900 */
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            /* Tailwind blue-500 */
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            /* Blue shadow on focus */
        }

        .search-icon {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            color: #718096;
            /* Tailwind gray-600 */
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-200 min-h-screen font-sans text-blue-900">

    <header class="py-10 text-center">
        <img src="{{ asset('Images/neo.png') }}" alt="Logo" class="mx-auto w-24 h-24 animate-spin-slow drop-shadow-lg" />
        <h1 class="mt-4 text-4xl font-extrabold tracking-wide">Enregistrement du Visiteur</h1>
        <p class="mt-2 text-blue-700 max-w-xl mx-auto">Merci de renseigner les informations ci-dessous avec précision</p>
    </header>

    <main class="max-w-7xl mx-auto px-4 md:px-8 mb-20">
        <section class="glass-card p-10 mb-14">
            <form action="{{ route('storeAjoutVisiteur') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf
                <div>
                    @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <fieldset>
                        <legend class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Informations personnelles</legend>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <input type="text" name="nom" placeholder="Nom" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="text" name="prenom" placeholder="Prénom" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <select name="sexe" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Sexe</option>
                                <option value="F">F</option>
                                <option value="M">M</option>
                            </select>
                            <input type="date" name="date_naissance" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="text" name="profession" placeholder="Profession (optionnel)"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="tel" name="telephone" placeholder="Téléphone" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="email" name="email" placeholder="Email (facultatif)"
                                class="md:col-span-3 rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Informations administratives</legend>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <select name="type_piece" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Type de pièce</option>
                                <option>CNI</option>
                                <option>Passeport</option>
                                <option>Permis</option>
                            </select>
                            <input type="text" name="numero_piece" placeholder="Numéro de la pièce" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <div>
                                <label for="photo_piece" class="block text-sm font-medium text-gray-700 mb-1">Copie de la pièce d'identité</label>
                                <input type="file" id="photo_piece" name="photo_piece"
                                    class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
                            </div>
                            <div>
                                <label for="photo_visiteur" class="block text-sm font-medium text-gray-700 mb-1">Photo du visiteur</label>
                                <input type="file" id="photo_visiteur" name="photo_visiteur"
                                    class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Détails de la visite</legend>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <input type="date" name="date_visite" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="time" name="heure_arrivee" required
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="time" name="heure_depart" placeholder="Heure de départ (optionnel)"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="text" name="motif" placeholder="Motif de la visite"
                                class="md:col-span-2 rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="text" name="objets" placeholder="Objet(s) apporté(s)"
                                class="md:col-span-3 rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Locataire visité</legend>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <input type="text" name="locataire_nom" placeholder="Nom du locataire"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="text" name="numero_appartement" placeholder="N° appartement ou chambre"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="text" name="etage_bloc" placeholder="Étage ou Bloc"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="text" name="relation" placeholder="Relation avec le locataire"
                                class="md:col-span-3 rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Sécurité</legend>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <select name="badge"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Badge ?</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>

                            <select name="autorisation"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Autorisation du locataire ?</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                                <option value="Vérifiée par téléphone">Vérifiée par téléphone</option>
                                <option value="Vérifiée par email">Vérifiée par email</option>
                            </select>
                            <input type="text" name="numero_badge" placeholder="Numéro du badge"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <select name="autorisation"
                                class="rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Autorisation du locataire ?</option>
                                <option>Oui</option>
                                <option>Non</option>
                                <option>Vérifiée par téléphone</option>
                            </select>
                            <input type="text" name="agent_enregistreur" placeholder="Agent ayant enregistré"
                                class="md:col-span-2 rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <input type="text" name="signature" placeholder="Signature du visiteur"
                                class="md:col-span-3 rounded-xl border border-blue-300 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </fieldset>

                    <div class="text-center mt-6">
                        <button
                            class="bg-blue-700 text-white px-16 py-4 rounded-3xl font-semibold shadow-lg hover:bg-blue-800 transition duration-300 flex items-center justify-center gap-3 mx-auto"
                            type="submit">
                            Enregistrer la visite
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <section class="max-w-6xl mx-auto mt-20 mb-10">
            <div class="search-container mx-auto mb-6 glass-card p-1 rounded-md shadow-md">
                <input type="text" id="searchInput" class="search-input bg-white/80 backdrop-blur-sm border-none focus:border-blue-500 focus:ring-blue-500" placeholder="Rechercher un agent...">
                <svg class="search-icon w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-6a7 7 0 10-14 0 7 7 0 0014 0z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Liste des visiteurs</h2>
            <div class="overflow-x-auto bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 text-left">
                    <thead class="bg-gradient-to-r from-cyan-500 to-blue-700 text-white">
                        <tr>
                            <th class="px-4 py-3 font-bold uppercase text-sm">Photo</th>
                            <th class="px-4 py-3 font-bold uppercase text-sm">Nom</th>
                            <th class="px-4 py-3 font-bold uppercase text-sm">Prénom</th>
                            <th class="px-4 py-3 font-bold uppercase text-sm">Téléphone</th>
                            <th class="px-4 py-3 font-bold uppercase text-sm">Date visite</th>
                            <th class="px-4 py-3 font-bold uppercase text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($visiteur as $visiteurs)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-3">
                                <img src="{{ storage_path('$visiteurs->photo_visiteur') }}"
                                    alt="Photo"
                                    class="w-12 h-12 rounded-full border border-blue-300 shadow cursor-pointer object-cover"
                                    onclick="openPhotoModal('photoModal', '{{ asset($visiteurs->photo_visiteur) }}', '{{ $visiteurs->prenom }} {{ $visiteurs->nom }}')">
                            </td>

                            <td class="px-4 py-3">{{ $visiteurs->nom }}</td>
                            <td class="px-4 py-3">{{ $visiteurs->prenom }}</td>
                            <td class="px-4 py-3">{{ $visiteurs->telephone }}</td>
                            <td class="px-4 py-3">{{ $visiteurs->date_visite }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <button onclick="openModal('janeModal')" class="bg-cyan-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-cyan-700">Voir +</button>
                                <button class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-blue-700">Modifier</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    @foreach ($visiteur as $visiteurs)
    <div id="janeModal" class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center px-4 py-10">
        <div class="bg-gradient-to-br from-blue-50 to-blue-200 rounded-3xl shadow-2xl max-w-3xl w-full relative p-8 border-4 border-blue-500 glass-card text-blue-900">
            <button onclick="closeModal('janeModal')" class="absolute top-4 right-4 text-blue-700 hover:text-red-600 text-3xl font-extrabold leading-none">×</button>
            <div class="text-center mb-6">
                <img src="{{ storage_path('$visiteurs->photo_visiteur') }}" alt="{{ $visiteurs->nom }}" class="w-28 h-28 rounded-full mx-auto border-4 border-blue-600 shadow-lg object-cover" />
                <h3 class="text-4xl font-extrabold mt-4">{{ $visiteurs->nom }}</h3>
                <p class="text-blue-700 italic">{{ $visiteurs->motif}}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-blue-900 text-sm font-medium">
                <p><strong>Sexe :</strong>{{ $visiteurs->sexe }}</p>
                <p><strong>Date de naissance :</strong> {{ $visiteurs->date_naissance }}</p>
                <p><strong>Téléphone :</strong> {{ $visiteurs->telephone }}</p>
                <p><strong>Email :</strong> {{ $visiteurs->email }}</p>
                <p><strong>Profession :</strong> {{ $visiteurs->profession }}</p>
                <p><strong>Type pièce :</strong> {{ $visiteurs->type_piece }}</p>
                <p><strong>Numéro pièce :</strong> {{ $visiteurs->numero_piece}}</p>
                <p><strong>Date visite :</strong> {{ $visiteurs->date_visite }}</p>
                <p><strong>Heure arrivée :</strong> {{ $visiteurs->heure_arrive }}</p>
                <p><strong>Heure départ :</strong> {{ $visiteurs->heure_depart }}</p>
                <p><strong>Motif :</strong> {{ $visiteurs->motif }}</p>
                <p><strong>Objets :</strong> {{ $visiteurs->objets }}</p>
                <p><strong>Locataire :</strong> {{ $visiteurs->locataire_nom }}</p>
                <p><strong>Appart. :</strong> {{ $visiteurs->numero_appartement }}</p>
                <p><strong>Bloc :</strong>{{ $visiteurs->etage_bloc}}</p>
                <p><strong>Relation :</strong> {{ $visiteurs->relation }}</p>
                <p><strong>Badge remis :</strong> {{ $visiteurs->badge }}</p>
                <p><strong>Numéro Badge :</strong> {{ $visiteurs->numero_badge }}</p>
                <p><strong>Autorisation :</strong> {{ $visiteurs->autorisation }}</p>
                <p><strong>Agent :</strong> {{ $visiteurs->agent_enregistreur }}</p>
            </div>
        </div>
    </div>

    <div id="photoModal" class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center px-4 py-10">
        <div class="bg-gradient-to-br from-blue-50 to-blue-200 rounded-3xl shadow-2xl max-w-md w-full relative p-4 border-4 border-blue-500 glass-card text-blue-900 flex flex-col items-center">
            <button onclick="closeModal('photoModal')" class="self-end mb-4 text-blue-700 hover:text-red-600 text-3xl font-extrabold leading-none">×</button>
            <img id="{{ storage_path('$visiteurs->photo_visiteur') }}" src="" alt="Photo Visiteur" class="max-w-full max-h-[70vh] rounded-3xl shadow-lg object-cover" />
        </div>
    </div>

    @endforeach

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openPhotoModal(id, imgSrc, altText) {
            const modal = document.getElementById(id);
            const modalImg = document.getElementById('modalPhotoImg');
            modalImg.src = imgSrc;
            modalImg.alt = altText;
            openModal(id);

        }

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const agentRows = document.querySelectorAll('.agent-row'); // Assuming you have elements with this class for your table rows

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();

                agentRows.forEach(row => {
                    const agentName = row.dataset.agentName || ''; // Assuming data-agent-name attribute
                    const agentFunction = row.dataset.agentFunction || ''; // Assuming data-agent-function attribute

                    if (agentName.includes(searchTerm) || agentFunction.includes(searchTerm)) {
                        row.style.display = ''; // Show the row
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });
            });
        });
    </script>


</body>

</html>