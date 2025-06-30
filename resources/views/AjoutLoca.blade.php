<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestion des Locataires - Bleu & Blanc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Application de la police Poppins */
            background: linear-gradient(120deg, #c7d2fe 0%, #f1f5f9 100%);
            /* Garde le fond original des locataires */
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

        /* Locataire image in table */
        .locataire-photo {
            height: 56px;
            width: 56px;
            border-radius: 9999px;
            border: 3px solid #93c5fd;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .locataire-photo:hover {
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

    <header class="py-10 text-center">
        <img src="{{ asset('Images/neo.png') }}" alt="Logo" class="mx-auto w-24 h-24 animate-spin-slow drop-shadow-lg" />
        <h1 class="mt-4 text-4xl font-extrabold tracking-wide text-blue-700">Gestion des Locataires</h1>
        <p class="mt-2 text-blue-700 max-w-xl mx-auto">Ajoutez, modifiez ou consultez les informations de vos locataires</p>
    </header>

    <main class="max-w-7xl mx-auto px-4 md:px-8 mb-20">

        <section class="glass-card p-10 mb-14">
            <h2 class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Ajout d'un nouveau locataire
            </h2>

            @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            <form class="grid md:grid-cols-2 gap-6" method="POST" action="{{ route('storeAjoutAgentLoca') }}"
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
                    <label class="block mb-2 font-semibold text-blue-700" for="statut">Statut</label>
                    <select id="statut" name="statut" required
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Sélectionner le statut</option>
                        <option value="Occupant">Occupant</option>
                        <option value="Libre">Libre</option>
                        <option value="En préavis">En préavis</option>
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
                    <label class="block mb-2 font-semibold text-blue-700" for="dateSortie">Date de sortie</label>
                    <input id="dateSortie" type="date" name="dateSortie"
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
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="ville">Ville</label>
                    <input id="ville" type="text" name="ville"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>

                <div class="md:col-span-2 flex justify-center mt-6">
                    <button type="submit"
                        class="btn-primary flex items-center justify-center gap-3">
                        Enregistrer le locataire
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </section>

        <section class="max-w-6xl mx-auto mt-20 mb-10">
            <h2 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Liste des Locataires</h2>

            <div>
                <div class="alert">
                    @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>

                <div class="search-container mx-auto mb-6 glass-card p-1 rounded-md shadow-md">
                    <input type="text" id="searchInput" class="search-input bg-white/80 backdrop-blur-sm border-none focus:border-blue-500 focus:ring-blue-500" placeholder="Rechercher un locataire...">
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
                            @foreach ($locataires as $locataire)
                            <tr class="hover:bg-blue-50 locataire-row" data-locataire-name="{{ strtolower($locataire->nom . ' ' . $locataire->prenoms) }}" data-locataire-function="{{ strtolower($locataire->fonction) }}">
                                <td class="px-4 py-3">
                                    <img src="{{ Storage::url($locataire->photo) }}"
                                        alt="Photo de {{ $locataire->prenoms }} {{ $locataire->nom }}"
                                        class="w-12 h-12 rounded-full border border-blue-300 shadow cursor-pointer object-cover locataire-photo"
                                        onclick="openPhotoModal('locatairePhotoModal', '{{ Storage::url($locataire->photo) }}', 'Photo de {{ $locataire->prenoms }} {{ $locataire->nom }}')">
                                </td>
                                <td class="px-4 py-3">{{ $locataire->nom }}</td>
                                <td class="px-4 py-3">{{ $locataire->prenoms }}</td>
                                <td class="px-4 py-3">{{ $locataire->fonction }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full {{ $locataire->statut == 'Occupant' ? 'bg-green-100 text-green-700' : ($locataire->statut == 'En préavis' ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700') }} font-semibold select-none">
                                        {{ $locataire->statut }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 space-x-2">
                                    <button onclick="openLocataireDetailsModal({{ $locataire->id }})"
                                        class="bg-cyan-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-cyan-700">Voir
                                        +</button>
                                    <a href="#"
                                        class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-blue-700">Modifier</a>
                                    <a href="#"
                                        class="bg-red-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-red-700">Supprimer</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>

    @foreach ($locataires as $locataire)
    <div id="locataireDetailsModal{{ $locataire->id }}"
        class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center px-4 py-10">
        <div
            class="bg-gradient-to-br from-blue-50 to-blue-200 rounded-3xl shadow-2xl max-w-3xl w-full relative p-8 border-4 border-blue-500 glass-card text-blue-900">
            <button onclick="closeModal('locataireDetailsModal{{ $locataire->id }}')"
                class="absolute top-4 right-4 text-blue-700 hover:text-red-600 text-3xl font-extrabold leading-none">×</button>
            <div class="text-center mb-6">
                <img src="{{ Storage::url($locataire->photo) }}" alt="{{ $locataire->nom }} {{ $locataire->prenoms }}"
                    class="w-28 h-28 rounded-full mx-auto border-4 border-blue-600 shadow-lg object-cover" />
                <h3 class="text-4xl font-extrabold mt-4">{{ $locataire->nom }} {{ $locataire->prenoms }}</h3>
                <p class="text-blue-700 italic">{{ $locataire->fonction }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-blue-900 text-sm font-medium">
                <p><strong>Matricule :</strong> {{ $locataire->matricule }}</p>
                <p><strong>Département :</strong> {{ $locataire->departement }}</p>
                <p><strong>Statut :</strong> {{ $locataire->statut }}</p>
                <p><strong>N° Appartement :</strong> {{ $locataire->numApp }}</p>
                <p><strong>Sexe :</strong> {{ $locataire->sexe }}</p>
                <p><strong>Date de naissance :</strong> {{ $locataire->dateNaissance }}</p>
                <p><strong>Date d'entrée :</strong> {{ $locataire->dateEntree }}</p>
                <p><strong>Date de sortie :</strong> {{ $locataire->dateSortie }}</p>
                <p><strong>Email :</strong> {{ $locataire->email }}</p>
                <p><strong>Téléphone :</strong> {{ $locataire->phone }}</p>
                <p><strong>Adresse :</strong> {{ $locataire->adresse }}</p>
                <p><strong>Ville :</strong> {{ $locataire->ville }}</p>
                <div class="md:col-span-2">
                    <p class="font-bold mb-2">Copie CNI :</p>
                    <img src="{{ Storage::url($locataire->photo_cni) }}" alt="CNI de {{ $locataire->nom }}"
                        class="max-w-full h-auto rounded-lg shadow-md border border-blue-300" />
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div id="locatairePhotoModal"
        class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center px-4 py-10">
        <div
            class="bg-gradient-to-br from-blue-50 to-blue-200 rounded-3xl shadow-2xl max-w-md w-full relative p-4 border-4 border-blue-500 glass-card text-blue-900 flex flex-col items-center">
            <button onclick="closeModal('locatairePhotoModal')"
                class="self-end mb-4 text-blue-700 hover:text-red-600 text-3xl font-extrabold leading-none">×</button>
            <img id="modalLocatairePhotoImg" src="" alt="Photo Locataire"
                class="max-w-full max-h-[70vh] rounded-3xl shadow-lg object-cover" />
        </div>
    </div>


    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openPhotoModal(id, imgSrc, altText) {
            const modal = document.getElementById(id);
            const modalImg = document.getElementById('modalLocatairePhotoImg');
            modalImg.src = imgSrc;
            modalImg.alt = altText;
            openModal(id);
        }

        // Specific function to open locataire details modal
        function openLocataireDetailsModal(locataireId) {
            const modalId = `locataireDetailsModal${locataireId}`;
            openModal(modalId);
        }

        // Script pour la barre de recherche
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const locataireRows = document.querySelectorAll('.locataire-row');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();

                locataireRows.forEach(row => {
                    const locataireName = row.dataset.locataireName || '';
                    const locataireFunction = row.dataset.locataireFunction || '';

                    if (locataireName.includes(searchTerm) || locataireFunction.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>