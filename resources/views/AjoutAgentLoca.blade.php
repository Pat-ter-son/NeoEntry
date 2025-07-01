<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestion - Agents & Locataires - Bleu & Blanc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
            transition: all 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Transition modal content */
        .modal-content {
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s ease-in-out;
            /* Nouveau style pour le pop-up */
            background: linear-gradient(135deg, rgba(209, 233, 255, 0.9), rgba(230, 242, 255, 0.9));
            border: 2px solid rgba(147, 197, 253, 0.6);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
            opacity: 1;
        }


        /* Table styles */
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

        /* Agent/Locataire image in table */
        .photo {
            height: 56px;
            width: 56px;
            border-radius: 9999px;
            border: 3px solid #93c5fd;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .photo:hover {
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
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #1d4ed8, #2563eb);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.8);
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

        /* Search Bar */
        .search-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            /* Increased max-width for better search bar experience */
            margin-bottom: 2rem;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #1e3a8a;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .search-icon {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            color: #718096;
        }

        .glassmorphism-box {
            background: rgba(255, 255, 255, 0.15);
            /* Adjusted transparency for consistency */
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            /* Consistent shadow */
            backdrop-filter: saturate(180%) blur(15px);
            /* Consistent blur */
            -webkit-backdrop-filter: saturate(180%) blur(15px);
            border-radius: 1.25rem;
            /* Consistent border radius */
            border: 1px solid rgba(255 255 255 / 0.3);
            /* Consistent border */
        }

        .animate-fade-in {
            animation: fade-in 0.4s cubic-bezier(.4, 2, .6, 1) both;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-200 min-h-screen font-sans text-blue-900">
    <header class="py-10 text-center">
        <img src="{{ asset('Images/neo.png') }}" alt="Logo" class="mx-auto w-24 h-24 animate-spin-slow drop-shadow-lg" />
        <h1 class="mt-4 text-4xl font-extrabold tracking-wide">Gestion des Agents et Locataires</h1>
        <p class="mt-2 text-blue-700 max-w-xl mx-auto">Gérez les informations de vos agents et locataires en un seul
            endroit</p>
    </header>

    <main class="max-w-7xl mx-auto px-4 md:px-8 mb-20">

        <section class="glass-card p-10 mb-14">
            <h2 class="text-2xl font-semibold border-l-4 border-blue-600 pl-4 mb-6 text-blue-800">Ajout d’un Agent
                + Locataire
            </h2>

            @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif

            <form class="grid md:grid-cols-2 gap-6" method="POST" action="storeAjoutAgentLoca"
                @csrf
                enctype="multipart/form-data">
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
                    <label class="block mb-2 font-semibold text-blue-700" for="adresse">Adresse</label>
                    <input id="adresse" type="text" name="adresse"
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
                    <label class="block mb-2 font-semibold text-blue-700" for="date_entree">Date d’entrée</label>
                    <input id="date_entree" type="date" name="date_entree"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="montant_loyer">Montant Loyer</label>
                    <input id="montant_loyer" type="number" name="montant_loyer"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="numero_appartement">N° Appartement</label>
                    <input id="numero_appartement" type="text" name="numero_appartement"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="statut_locataire">Statut Locataire</label>
                    <select id="statut_locataire" name="statut_locataire"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Sélectionner le statut</option>
                        <option value="Actif">Actif</option>
                        <option value="Résilié">Résilié</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="statut_agent">Statut Agent</label>
                    <select id="statut_agent" name="statut_agent"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Sélectionner le statut</option>
                        <option value="Actif">Actif</option>
                        <option value="Retraité">Retraité</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-blue-700" for="photo">Photo</label>
                    <input id="photo" type="file" name="photo" accept="image/*"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 font-semibold text-blue-700" for="photo_cni">Photo CNI</label>
                    <input id="photo_cni" type="file" name="photo_cni" accept="image/*"
                        class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
                </div>

                <div class="md:col-span-2 flex justify-center mt-6">
                    <button type="submit"
                        class="bg-blue-700 text-white px-16 py-4 rounded-3xl font-semibold shadow-lg hover:bg-blue-800 transition duration-300 flex items-center justify-center gap-3">
                        Valider
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </section>

        <section class="max-w-7xl mx-auto mt-20 mb-10">
            <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Liste des Agents & Locataires</h2>

            <div class="search-container mx-auto mb-6 glass-card p-1 rounded-md shadow-md">
                <input type="text" id="searchInput"
                    class="search-input bg-white/80 backdrop-blur-sm border-none focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Rechercher un agent ou un locataire...">
                <svg class="search-icon w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-6a7 7 0 10-14 0 7 7 0 0014 0z"></path>
                </svg>
            </div>

            <div class="overflow-x-auto bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 text-left">
                    <thead class="bg-gradient-to-r from-cyan-500 to-blue-700 text-white">
                        <tr class="hover:bg-blue-50 agent-locataire-row" data-name="{{ $agentLoca->nom }}"
                            data-matricule="A001" data-fonction="Agent Commercial">
                            <td class="px-4 py-3">
                                <img src="{{ Storage::url($agentLoca->photo) }}" alt="Photo de {{ $agentLoca->nom }}"
                                    class="w-12 h-12 rounded-full border border-blue-300 shadow cursor-pointer object-cover photo"
                                    onclick="openPhotoModal('itemPhotoModal', 'https://via.placeholder.com/400', 'Photo de Jean Dupont')">
                            </td>
                            <td class="px-4 py-3">{{ $agentLoca->nom }}</td>
                            <td class="px-4 py-3">{{ $agentLoca->prenoms }}</td>
                            <td class="px-4 py-3">{{ $agentLoca->fonction }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold select-none">
                                    {{ $agentLoca->statutAgent }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold select-none">
                                    {{ $agentLoca->statutLoca }}
                                </span>
                            </td>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        <tr class="hover:bg-blue-50 agent-locataire-row" data-name="jean dupont"
                            data-matricule="A001" data-fonction="Agent Commercial">
                            <td class="px-4 py-3">
                                <img src=" {{ Storage::url($agentLoca->photo) }}" alt="Photo de  {{ $agentLoca->id }}"
                                    class="w-12 h-12 rounded-full border border-blue-300 shadow cursor-pointer object-cover photo"
                                    onclick="openPhotoModal('itemPhotoModal', 'https://via.placeholder.com/400', 'Photo de Jean Dupont')">
                            </td>
                            <td class="px-4 py-3"> {{ $agentLoca->nom}}</td>
                            <td class="px-4 py-3"> {{ $agentLoca->prenoms }}</td>
                            <td class="px-4 py-3"> {{ $agentLoca->fonction }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold select-none">
                                    Actif
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold select-none">
                                    N/A
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <button onclick="openAgentDetailsModal('')"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-yellow-600">
                                    voir ➕
                                </button>

                                <button
                                    class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-blue-700"><a href="">✏️Modifier</a>
                                </button>

                                <button class="bg-red-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-red-700">
                                    <a href="">🗑️ Supprimer</a>
                                </button>

                            </td>
                        </tr>
                        <tr class="hover:bg-blue-50 agent-locataire-row" data-name="marie curie"
                            data-matricule="L001" data-fonction="N/A">
                            <td class="px-4 py-3">
                                <img src="https://via.placeholder.com/48" alt="Photo de Marie Curie"
                                    class="w-12 h-12 rounded-full border border-blue-300 shadow cursor-pointer object-cover photo"
                                    onclick="openPhotoModal('itemPhotoModal', 'https://via.placeholder.com/400', 'Photo de Marie Curie')">
                            </td>
                            <td class="px-4 py-3">Curie</td>
                            <td class="px-4 py-3">Marie</td>
                            <td class="px-4 py-3">N/A</td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold select-none">
                                    N/A
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold select-none">
                                    Actif
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <button onclick="openDetailsModal('itemDetailsModal', {
                                    photo: ' {{ Storage::url($agentLoca->cni) }}',
                                    name: ' {{ $agentLoca->nom},  {{ $agentLoca->prenoms }}',
                                    
                                    matricule: ' {{ $agentLoca->matricule }}',
                                    departement: ' {{ $agentLoca->departement }}',
                                    statutAgent: ' {{ $agentLoca->statutAgent }}',
                                    statutLocataire: ' {{ $agentLoca->statutLoca }}',
                                    numAppartement: ' {{ $agentLoca->numApp }}',
                                    dateEntree: ' {{ $agentLoca->dateEntree }}',
                                    montantLoyer: ' {{ $agentLoca->montantLoyer }}',
                                    adresse: ' {{ $agentLoca->adresse }}',
                                    photoCNI: 'https://via.placeholder.com/600x400'
                                })"
                                    class="bg-cyan-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-cyan-700">Voir
                                    +</button>
                                <button
                                    class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm shadow hover:bg-blue-700"><a
                                        href="#">Modifier</a></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <div id="itemDetailsModal"
        class="fixed inset-0 z-50 modal-overlay flex items-center justify-center px-4 py-10">
        <div class="rounded-3xl shadow-2xl max-w-3xl w-full relative p-8 text-blue-900 modal-content">
            <button onclick="closeModal('itemDetailsModal')"
                class="absolute top-4 right-4 text-blue-700 hover:text-red-600 text-3xl font-extrabold leading-none">×</button>
            <div class="text-center mb-6">
                <img id="modalDetailPhoto" src="" alt="Photo"
                    class="w-28 h-28 rounded-full mx-auto border-4 border-blue-600 shadow-lg object-cover" />
                <h3 id="modalDetailName" class="text-4xl font-extrabold mt-4"></h3>
                <p id="modalDetailRole" class="text-blue-700 italic"></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-blue-900 text-sm font-medium">
                <p><strong>Matricule :</strong> <span id="modalDetailMatricule"></span></p>
                <p><strong>Département :</strong> <span id="modalDetailDepartement"></span></p>
                <p><strong>Statut Agent :</strong> <span id="modalDetailStatutAgent"></span></p>
                <p><strong>Statut Locataire :</strong> <span id="modalDetailStatutLocataire"></span></p>
                <p><strong>N° Appartement :</strong> <span id="modalDetailNumAppartement"></span></p>
                <p><strong>Date d'entrée :</strong> <span id="modalDetailDateEntree"></span></p>
                <p><strong>Montant Loyer :</strong> <span id="modalDetailMontantLoyer"></span></p>
                <p class="md:col-span-2"><strong>Adresse :</strong> <span id="modalDetailAdresse"></span></p>
                <div class="md:col-span-2">
                    <p class="font-bold mb-2">Copie CNI :</p>
                    <img id="modalDetailPhotoCNI" src="" alt="CNI"
                        class="max-w-full h-auto rounded-lg shadow-md border border-blue-300" />
                </div>
            </div>
        </div>
    </div>


    <div id="itemPhotoModal"
        class="fixed inset-0 z-50 modal-overlay flex items-center justify-center px-4 py-10">
        <div class="rounded-3xl shadow-2xl max-w-md w-full relative p-4 text-blue-900 flex flex-col items-center modal-content">
            <button onclick="closeModal('itemPhotoModal')"
                class="self-end mb-4 text-blue-700 hover:text-red-600 text-3xl font-extrabold leading-none">×</button>
            <img id="modalItemPhotoImg" src="" alt="Photo Item"
                class="max-w-full max-h-[70vh] rounded-3xl shadow-lg object-cover" />
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('active');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('active');
        }

        function openPhotoModal(id, imgSrc, altText) {
            const modalImg = document.getElementById('modalItemPhotoImg');
            modalImg.src = imgSrc;
            modalImg.alt = altText;
            openModal(id);
        }

        function openDetailsModal(modalId, data) {
            const modal = document.getElementById(modalId);
            document.getElementById('modalDetailPhoto').src = data.photo;
            document.getElementById('modalDetailName').textContent = data.name;
            document.getElementById('modalDetailRole').textContent = data.role;
            document.getElementById('modalDetailMatricule').textContent = data.matricule;
            document.getElementById('modalDetailDepartement').textContent = data.departement;
            document.getElementById('modalDetailStatutAgent').textContent = data.statutAgent;
            document.getElementById('modalDetailStatutLocataire').textContent = data.statutLocataire;
            document.getElementById('modalDetailNumAppartement').textContent = data.numAppartement;
            document.getElementById('modalDetailDateEntree').textContent = data.dateEntree;
            document.getElementById('modalDetailMontantLoyer').textContent = data.montantLoyer;
            document.getElementById('modalDetailAdresse').textContent = data.adresse;
            document.getElementById('modalDetailPhotoCNI').src = data.photoCNI;
            document.getElementById('modalDetailPhotoCNI').alt = 'CNI de ' + data.name;

            openModal(modalId);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const itemRows = document.querySelectorAll('.agent-locataire-row');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();

                itemRows.forEach(row => {
                    const itemName = row.dataset.name || '';
                    const itemMatricule = row.dataset.matricule || '';
                    const itemFunction = row.dataset.fonction || '';

                    if (itemName.includes(searchTerm) || itemMatricule.includes(searchTerm) || itemFunction.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Make sure modals are hidden by default on page load (important for initial state)
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                modal.classList.remove('active');
            });
        });
    </script>
</body>

</html>