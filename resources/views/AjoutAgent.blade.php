<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestion des Agents - Bleu & Blanc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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

        /* Table styles from the agent code, adapted for the template */
        table {
            border-collapse: separate;
            border-spacing: 0 0.8rem;
            width: 100%;
        }

        thead tr {
            background: #bfdbfe;
            color: #1e40af;
            text-transform: uppercase;
            font-weight: 700;
        }

        tbody tr {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
            transition: transform 0.2s ease;
        }

        tbody tr:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
        }

        tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            color: #1e40af;
        }

        /* Agent image in table */
        .agent-photo {
            height: 56px;
            width: 56px;
            border-radius: 9999px;
            border: 3px solid #93c5fd;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .agent-photo:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px #3b82f6aa;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: white;
            box-shadow: 0 6px 15px rgba(59, 130, 246, 0.6);
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            /* Increased padding for better look */
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #1d4ed8, #2563eb);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.8);
        }

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

        .btn-danger {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 12px #dc2626cc;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #b91c1c;
            box-shadow: 0 6px 20px #b91c1cdd;
        }

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

    <header class="bg-white/70 backdrop-blur-lg shadow-lg py-4 px-8 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('Images/neo.png') }}" alt="Logo Bleu & Blanc"
                    class="h-12 w-12 rounded-full animate-spin-slow drop-shadow-md" />
                <h1 class="text-2xl font-bold text-blue-800 hidden sm:block">Neo Start Technology <span
                        class="text-blue-500">Admin</span></h1>
            </div>

            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('vueAjoutAgent') }}"
                    class="text-blue-700 hover:text-blue-900 font-medium text-lg transition duration-300 relative group">
                    👤Agents
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>

                <a href="{{ route('vueAjoutAgentLoca') }}"
                    class="text-gray-600 hover:text-blue-900 font-medium text-lg transition duration-300 relative group">
                    👤Locataires
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>

                <a href="{{ route('vueAjoutLoca') }}"
                    class="text-gray-600 hover:text-blue-900 font-medium text-lg transition duration-300 relative group">
                    👤Agents&Locataires
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>

                <a href="{{ route('vueAjoutLoca') }}"
                    class="text-gray-600 hover:text-blue-900 font-medium text-lg transition duration-300 relative group">
                    👤Admin
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>
            </nav>

            <div class="md:hidden">
                <button id="menu-toggle" class="text-blue-700 hover:text-blue-900 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden mt-4 hidden">
            <nav class="flex flex-col space-y-3 px-4 py-2 bg-white rounded-lg shadow-md">
                <a href="#" class="block text-blue-700 hover:text-blue-900 font-medium py-2">Agents</a>
                <a href="#" class="block text-gray-600 hover:text-blue-900 font-medium py-2">Locataires</a>
                <a href="#" class="block text-gray-600 hover:text-blue-900 font-medium py-2">Agents&Locataires</a>
            </nav>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-4 md:px-8 mb-20 mt-8">
        <section class="glass-card p-10 mb-14">
            <h2 class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Ajout d'un nouvel agent
            </h2>

            @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            <form class="grid md:grid-cols-2 gap-6" method="POST" action="{{ route('storeAjoutAgent') }}"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="nom">Nom</label>
                    <input id="nom" type="text" name="nom" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="prenoms">Prénoms</label>
                    <input id="prenoms" type="text" name="prenoms" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="matricule">Matricule</label>
                    <input id="matricule" type="text" name="matricule" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="fonction">Fonction</label>
                    <input id="fonction" type="text" name="fonction" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="departement">Département</label>
                    <input id="departement" type="text" name="departement" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="statut">Statut</label>
                    <select id="statut" name="statut" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Sélectionner le statut</option>
                        <option value="En fonction">En fonction</option>
                        <option value="En retraite">En retraite</option>
                        <option value="Hors service">Hors service</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="numApp">N° Appartement</label>
                    <input id="numApp" type="number" name="numApp" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="sexe">Sexe</label>
                    <select id="sexe" name="sexe" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Sélectionner le sexe</option>
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>

                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="dateNaissance">Date de naissance</label>
                    <input id="dateNaissance" type="date" name="dateNaissance"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="dateEntree">Date d’entrée</label>
                    <input id="dateEntree" type="date" name="dateEntree"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="photo">Photo</label>
                    <input id="photo" type="file" name="photo" accept="image/*"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="photo_cni">Photo de la CNI</label>
                    <input id="photo_cni" type="file" name="photo_cni" accept="image/*"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="email">Email</label>
                    <input id="email" type="email" name="email"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="phone">Téléphone</label>
                    <input id="phone" type="tel" name="phone"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="adresse">Adresse</label>
                    <input id="adresse" type="text" name="adresse"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="ville">Ville</label>
                    <input id="ville" type="text" name="ville"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>

                <div class="md:col-span-2 flex justify-center mt-6">
                    <button type="submit"
                        class="bg-blue-700 text-white px-16 py-4 rounded-3xl font-semibold shadow-lg hover:bg-blue-800 transition duration-300 flex items-center justify-center gap-3">
                        Enregistrer l'agent
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </section>

        <section class="max-w-6xl mx-auto mt-20 mb-10">
            <h2 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Liste des Agents</h2>

            <div>
                <div class="alert">
                    @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>

                <div class="search-container mx-auto mb-6 glass-card p-1 rounded-md shadow-md">
                    <input type="text" id="searchInput" class="search-input bg-white/80 backdrop-blur-sm border-none focus:border-blue-500 focus:ring-blue-500" placeholder="Rechercher un agent...">
                    <svg class="search-icon w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-6a7 7 0 10-14 0 7 7 0 0014 0z"></path>
                    </svg>
                </div>

                <div class="overflow-x-auto bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg p-6">
                    <table class="min-w-full divide-y divide-gray-200 text-left">
                        <thead class="bg-gradient-to-r from-cyan-500 to-blue-700 text-white">
                            <tr>
                                <th class="px-4 py-3 font-bold uppercase text-sm">Photo</th>
                                <th class="px-4 py-3 font-bold uppercase text-sm">Nom</th>
                                <th class="px-4 py-3 font-bold uppercase text-sm">Prénoms</th>
                                <th class="px-4 py-3 font-bold uppercase text-sm">Fonction</th>
                                <th class="px-4 py-3 font-bold uppercase text-sm">Statut</th>
                                <th class="px-4 py-3 font-bold uppercase text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            @foreach ($agents as $agent)
                            <tr class="hover:bg-blue-50 agent-row" data-agent-name="{{ strtolower($agent->nom . ' ' . $agent->prenoms) }}" data-agent-function="{{ strtolower($agent->fonction) }}">
                                <td class="px-4 py-3">
                                    <img src="{{ Storage::url($agent->photo) }}"
                                        alt="Photo de {{ $agent->prenoms }} {{ $agent->nom }}"
                                        class="w-12 h-12 rounded-full border border-blue-300 shadow cursor-pointer object-cover agent-photo"
                                        onclick="openPhotoModal('agentPhotoModal', '{{ asset($agent->photo) }}', 'Photo de {{ $agent->prenoms }} {{ $agent->nom }}')">
                                </td>
                                <td class="px-4 py-3">{{ $agent->nom }}</td>
                                <td class="px-4 py-3">{{ $agent->prenoms }}</td>
                                <td class="px-4 py-3">{{ $agent->fonction }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full {{ $agent->statut == 'En fonction' ? 'bg-green-100 text-green-700' : ($agent->statut == 'En retraite' ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700') }} font-semibold select-none">
                                        {{ $agent->statut }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 space-x-2 flex items-center">
                                    <button onclick="openAgentDetailsModal('{{$agent->id }}')"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-yellow-600">
                                        voir ➕
                                    </button>

                                    <button
                                        class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-blue-700">
                                        <a href="">✏️Modifier</a>
                                    </button>

                                    <form action="{{ route('deleteAjoutAgent', $agent->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-red-700">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>

    @foreach ($agents as $agent)
    <div id="agentDetailsModal{{ $agent->id }}"
        class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center px-4 py-10">
        <div
            class="bg-gradient-to-br from-blue-50 to-blue-200 rounded-3xl shadow-2xl max-w-3xl w-full relative p-8 border-4 border-blue-500 glass-card text-blue-900">
            <button onclick="closeModal('agentDetailsModal{{ $agent->id }}')"
                class="absolute top-4 right-4 text-blue-700 hover:text-red-600 text-3xl font-extrabold leading-none">×</button>
            <div class="text-center mb-6">
                <img src="{{ Storage::url($agent->photo) }}" alt="{{ $agent->nom }} {{ $agent->prenoms }}"
                    class="w-28 h-28 rounded-full mx-auto border-4 border-blue-600 shadow-lg object-cover" />
                <h3 class="text-4xl font-extrabold mt-4">{{ $agent->nom }} {{ $agent->prenoms }}</h3>
                <p class="text-blue-700 italic">{{ $agent->fonction }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-blue-900 text-sm font-medium">
                <p><strong>Matricule :</strong> {{ $agent->matricule }}</p>
                <p><strong>Département :</strong> {{ $agent->departement }}</p>
                <p><strong>Statut :</strong> {{ $agent->statut }}</p>
                <p><strong>N° Appartement :</strong> {{ $agent->numApp }}</p>
                <p><strong>Sexe :</strong> {{ $agent->sexe }}</p>
                <p><strong>Date de naissance :</strong> {{ $agent->dateNaissance }}</p>
                <p><strong>Date d'entrée :</strong> {{ $agent->dateEntree }}</p>
                <p><strong>Email :</strong> {{ $agent->email }}</p>
                <p><strong>Téléphone :</strong> {{ $agent->phone }}</p>
                <p><strong>Adresse :</strong> {{ $agent->adresse }}</p>
                <p><strong>Ville :</strong> {{ $agent->ville }}</p>
                <div class="md:col-span-2">
                    <p class="font-bold mb-2">Copie CNI :</p>
                    <img src="{{ Storage::url($agent->cni) }}" alt="CNI de {{ $agent->nom }}"
                        class="max-w-full h-auto rounded-lg shadow-md border border-blue-300" />
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div id="agentPhotoModal"
        class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center px-4 py-10">
        <div
            class="bg-gradient-to-br from-blue-50 to-blue-200 rounded-3xl shadow-2xl max-w-md w-full relative p-4 border-4 border-blue-500 glass-card text-blue-900 flex flex-col items-center">
            <button onclick="closeModal('agentPhotoModal')"
                class="self-end mb-4 text-blue-700 hover:text-red-600 text-3xl font-extrabold leading-none">×</button>
            <img id="modalAgentPhotoImg" src="{{ Storage::url($agent->photo) }}" alt="Photo Agent"
                class="max-w-full max-h-[70vh] rounded-3xl shadow-lg object-cover" />
        </div>
    </div>


    <script>
        // Scripts JS existants pour les modals et la recherche
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openPhotoModal(id, imgSrc, altText) {
            const modal = document.getElementById(id);
            const modalImg = document.getElementById('modalAgentPhotoImg');
            modalImg.src = imgSrc;
            modalImg.alt = altText;
            openModal(id);
        }

        function openAgentDetailsModal(agentId) {
            const modalId = `agentDetailsModal${agentId}`;
            openModal(modalId);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const agentRows = document.querySelectorAll('.agent-row');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();

                agentRows.forEach(row => {
                    const agentName = row.dataset.agentName || '';
                    const agentFunction = row.dataset.agentFunction || '';

                    if (agentName.includes(searchTerm) || agentFunction.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Script pour le menu hamburger
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            menuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>

</body>

</html>