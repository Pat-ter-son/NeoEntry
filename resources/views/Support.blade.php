<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Support & Assistance - Neo Start</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animation Spin Slow */
        .animate-spin-slow {
            animation: spin 20s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Glassmorphism card */
        .glass-card {
            background: rgba(255 255 255 / 0.8);
            box-shadow: 0 8px 32px rgb(31 38 135 / 0.2);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 2rem;
            border: 1.5px solid rgba(255 255 255 / 0.3);
            transition: box-shadow 0.3s ease;
        }

        .glass-card:hover {
            box-shadow: 0 16px 48px rgb(31 38 135 / 0.35);
        }

        /* Pulse animation for icons */
        .pulse {
            animation: pulse 2.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(90deg, #6366f1, #a21caf, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }

        /* Smooth fade-in */
        .fade-in {
            animation: fadeIn 0.6s ease forwards;
            opacity: 0;
        }

        .fade-in.visible {
            opacity: 1;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Styles for the sidebar and content area */
        .sidebar {
            width: 256px;
            transform: translateX(-256px);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            box-shadow: none;
        }

        .sidebar.open {
            transform: translateX(0);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 40;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            pointer-events: none;
        }

        .overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        .main-content {
            transition: margin-left 0.3s ease-in-out;
            margin-left: 0;
        }

        /* Adjust main content padding when sidebar is visible on medium screens and up */
        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .overlay {
                display: none;
            }

            .main-content {
                margin-left: 256px;
            }

            .menu-button {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-tr from-indigo-50 via-white to-pink-50 min-h-screen font-sans text-gray-800 relative">

    <nav id="sidebar"
        class="sidebar fixed top-0 left-0 h-full bg-gradient-to-br from-indigo-800 via-purple-800 to-pink-800 text-white z-50 overflow-y-auto pt-16 pb-4 flex flex-col">
        <div class="px-6 mb-8 flex flex-col items-center">
            <a href="{{ route('vueSupport') }}" class="flex flex-col items-center gap-3 select-none">
                <img src="{{ asset('Images/neo.png') }}" alt="Logo Neo Start"
                    class="w-20 h-20 rounded-full animate-spin-slow border-4 border-white shadow-lg" />
                <h1 class="text-2xl font-extrabold text-white tracking-wide drop-shadow-lg text-center mt-2">Neo Start
                    Technology</h1>
            </a>
        </div>

        <ul class="flex flex-col gap-2 text-white font-semibold tracking-wide text-lg px-4">
            <li>
                <a href="{{ route('vueSupport') }}"
                    class="block py-2 px-4 rounded-md hover:bg-white/20 transition duration-200 {{ request()->routeIs('vueSupport') ? 'bg-white/30' : '' }}">
                    <span class="{{ request()->routeIs('vueSupport') ? 'underline decoration-pink-300 decoration-4 underline-offset-4' : '' }}">Accueil</span>
                </a>
            </li>
            
            
            <li>
                <a href="{{ route('vueAjoutVisiteur') }}"
                    class="block py-2 px-4 rounded-md hover:bg-white/20 transition duration-200 {{ request()->routeIs('vueAjoutVisiteur') ? 'bg-white/30' : '' }}">
                    <span class="{{ request()->routeIs('vueAjoutVisiteur') ? 'underline decoration-pink-300 decoration-4 underline-offset-4' : '' }}">Ajout Visiteur</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('vueDashboard') }}"
                    class="block py-2 px-4 rounded-md hover:bg-white/20 transition duration-200 {{ request()->routeIs('vueDashboard') ? 'bg-white/30' : '' }}">
                    <span class="{{ request()->routeIs('vueDashboard') ? 'underline decoration-pink-300 decoration-4 underline-offset-4' : '' }}">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('vueAdmin') }}"
                    class="block py-2 px-4 rounded-md bg-gradient-to-r from-blue-500 to-pink-500 text-white font-bold shadow hover:from-blue-600 hover:to-pink-600 transition duration-200 mt-4 text-center">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0l4-4m-4 4l4 4m13-4a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                            Connexion
                    </span>
                </a>
            </li>
        </ul>
    </nav>

    <div id="sidebar-overlay" class="overlay fixed inset-0 z-40 md:hidden" onclick="toggleSidebar()"></div>

    <div id="main-content" class="flex-1 main-content md:ml-64 pt-10 pb-24 px-6 md:px-10">
        <button id="menu-button"
            class="menu-button fixed top-4 left-4 z-50 p-3 bg-indigo-700 text-white rounded-lg shadow-xl hover:bg-indigo-600 transition-all duration-300 md:hidden"
            onclick="toggleSidebar()" aria-label="Ouvrir le menu">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <h1 class="text-4xl md:text-5xl font-extrabold text-center gradient-text mb-12 md:mb-16 select-none drop-shadow-md">
            Support & Assistance
        </h1>

        <section class="glass-card p-8 md:p-10 mb-12 md:mb-16 shadow-xl mx-auto max-w-4xl">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 text-center
text-indigo-700 drop-shadow-md">Présentation de
                l’application</h2>
            <p class="text-lg leading-relaxed max-w-3xl mx-auto text-center text-gray-700">
                Neo Start Technology est une plateforme de gestion des visiteurs qui assure un suivi sécurisé et efficace.
                Gagnez du temps et améliorez la traçabilité avec une interface moderne et intuitive.
            </p>
        </section>

        <section class="mb-12 md:mb-16">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-700 mb-6 md:mb-10
text-center drop-shadow-md">Étapes d'utilisation</h2>
            <div class="max-w-4xl mx-auto space-y-6 md:space-y-8">
                <div class="bg-white rounded-3xl shadow-lg p-6 md:p-8 flex
gap-6 md:gap-8 items-center hover:shadow-2xl transition cursor-default">
                    <div class="flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded-full
bg-gradient-to-tr from-indigo-500 via-purple-600 to-pink-500 flex
items-center justify-center text-white text-3xl md:text-4xl font-bold select-none
pulse">
                        1
                    </div>
                    <div>
                        <h3 class="text-lg md:text-xl font-semibold mb-2 md:mb-3 text-indigo-900">Ajouter un visiteur</h3>
                        <p class="text-gray-700 mb-2 md:mb-3 max-w-xl">
                            Cliquez sur <span class="font-bold
text-indigo-600">« Ajouter un visiteur »</span> et remplissez
                            les champs suivants :
                        </p>
                        <ul class="list-disc list-inside text-gray-600 text-lg max-w-xl">
                            <li>Nom, Prénoms, Sexe, Matricule</li>
                            <li>Email & Téléphone</li>
                            <li>Motif de visite & Agent recherché</li>
                            <li>Validité & Heure d’entrée / départ</li>
                            <li>Photo & Pièce d’identité</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-16 md:mb-20">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-700 mb-6 md:mb-10
text-center drop-shadow-md">Statuts des visiteurs</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 max-w-6xl mx-auto">
                <div class="glass-card p-6 md:p-8 text-center shadow-lg hover:shadow-2xl transition cursor-default">
                    <div class="text-yellow-400 text-4xl md:text-5xl mb-3 md:mb-4 animate-pulse">⏳</div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-1 md:mb-2 text-yellow-600">En attente</h3>
                    <p class="text-gray-700">En attente de validation ou de compléments d’informations.</p>
                </div>

                <div class="glass-card p-6 md:p-8 text-center shadow-lg hover:shadow-2xl transition cursor-default">
                    <div class="text-green-400 text-4xl md:text-5xl mb-3 md:mb-4 animate-pulse">✅</div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-1 md:mb-2 text-green-600">Valide</h3>
                    <p class="text-gray-700">Le visiteur est autorisé et a reçu la confirmation.</p>
                </div>

                <div class="glass-card p-6 md:p-8 text-center shadow-lg hover:shadow-2xl transition cursor-default">
                    <div class="text-red-400 text-4xl md:text-5xl mb-3 md:mb-4 animate-pulse">❌</div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-1 md:mb-2 text-red-600">Banni</h3>
                    <p class="text-gray-700">L’accès a été
                        refusé. Le visiteur est bloqué sauf décision contraire.</p>
                </div>

                <div class="glass-card p-6 md:p-8 text-center shadow-lg hover:shadow-2xl transition cursor-default">
                    <div class="text-blue-400 text-4xl md:text-5xl mb-3 md:mb-4 animate-pulse">📦</div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-1 md:mb-2 text-blue-600">Terminé</h3>
                    <p class="text-gray-700">La visite s’est conclue. Les données sont archivées.</p>
                </div>
            </div>
        </section>

        <section class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
            <div
                class="glass-card p-6 md:p-8 flex flex-col items-center gap-3 md:gap-4
text-center shadow-lg hover:shadow-2xl transition cursor-pointer"
                role="button" tabindex="0" aria-label="Contact par email support@neostart.tech">
                <svg class="w-12 h-12 md:w-16 md:h-16 text-indigo-600 animate-pulse" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path d="M4 4h16v16H4V4zM22 6l-10 7L2 6" />
                </svg>
                <h3 class="text-lg md:text-xl font-bold text-indigo-700">Email</h3>
                <a href="mailto:support@neostart.tech"
                    class="text-indigo-600 font-semibold underline
hover:text-pink-500 transition">support@neostart.tech</a>
            </div>

            <div
                class="glass-card p-6 md:p-8 flex flex-col items-center gap-3 md:gap-4
text-center shadow-lg hover:shadow-2xl transition cursor-pointer"
                role="button" tabindex="0" aria-label="Contact par téléphone +22890422020">
                <svg class="w-12 h-12 md:w-16 md:h-16 text-green-600 animate-pulse" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path
                        d="M2 7a4 4 0 014-4h1.586a1 1 0
01.707.293l2.414 2.414a1 1 0 010 1.414L7.414 9a1 1 0 01-1.414 0L4
7.414a1 1 0 010-1.414L6.414 3H7a2 2 0 012 2v3a2 2 0 01-2 2H4z" />
                    <path
                        d="M21 17a4 4 0 01-4 4h-1.586a1 1 0
01-.707-.293l-2.414-2.414a1 1 0 010-1.414L16.586 15a1 1 0 011.414
0l2.586 2.586a1 1 0 010 1.414L17 21h1a2 2 0 002-2v-3a2 2 0 00-2-2z" />
                </svg>
                <h3 class="text-lg md:text-xl font-bold text-green-700">Téléphone</h3>
                <a href="tel:+22890422020"
                    class="text-green-600 font-semibold underline
hover:text-pink-500 transition">+228 90 42 20 20</a>
            </div>

            <div
                class="glass-card p-6 md:p-8 flex flex-col items-center gap-3 md:gap-4
text-center shadow-lg hover:shadow-2xl transition cursor-default"
                role="region" aria-label="Adresse de Neo Start Technology">
                <svg class="w-12 h-12 md:w-16 md:h-16 text-pink-600 animate-pulse" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path
                        d="M12 21c-4.418 0-8-7.168-8-11.667C4 7.03 7.03
4 12 4c4.97 0 8 3.03 8 5.333 0 4.5-3.582 11.667-8 11.667z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                <h3 class="text-lg md:text-xl font-bold text-pink-700">Adresse</h3>
                <p class="text-pink-600 font-semibold">Totsi, Lomé, Togo</p>
            </div>
        </section>

        <section
            class="max-w-4xl mx-auto mt-16 md:mt-20 bg-gradient-to-r
from-indigo-100 via-purple-100 to-pink-100 rounded-3xl p-8 md:p-10
shadow-inner">
            <h2
                class="text-2xl md:text-3xl font-extrabold mb-4 md:mb-6 text-center gradient-text tracking-wide drop-shadow-lg select-none">
                FAQ Rapide
            </h2>
            <ul class="text-lg text-indigo-800 space-y-3 md:space-y-4 max-w-xl mx-auto list-disc list-inside">
                <li><strong>⏱ Délais de réponse :</strong> Moins de 24h ouvrées</li>
                <li><strong>🔒 Confidentialité
                        :</strong> Vos données sont protégées et traitées avec
                    soin</li>
                <li><strong>🌍 Langues :</strong> Français, Anglais</li>
                <li><strong>🕒 Horaires :</strong> Lundi - Vendredi, 8h à 18h</li>
            </ul>
        </section>

        <div class="mt-12 md:mt-16 text-center">
            <a href="{{ route('vueDashboard') }}"
                class="inline-block px-6 py-2 md:px-8 md:py-3 rounded-full
bg-gradient-to-r from-pink-500 to-indigo-600 text-white font-bold
shadow-lg hover:from-pink-600 hover:to-indigo-700 transition">
                ← Retour au Dashboard
            </a>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mainContent = document.getElementById('main-content'); // Keep mainContent for potential future use if needed

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('open');
            // On mobile, prevent scrolling when sidebar is open
            if (window.innerWidth < 768) { // Tailwind's 'md' breakpoint
                document.body.classList.toggle('overflow-hidden');
            }
        }

        // Close sidebar on overlay click
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Add 'current page' styling to sidebar links
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('#sidebar a');

            sidebarLinks.forEach(link => {
                const linkHref = new URL(link.href).pathname;
                const spanElement = link.querySelector('span');
                // Check if the current path matches the link's href exactly or is a sub-path (for dashboard/support pages)
                const isActive = (currentPath === linkHref) ||
                    (currentPath.startsWith('/vueDashboard') && linkHref === '/vueDashboard') ||
                    (currentPath.startsWith('/vueSupport') && linkHref === '/vueSupport') ||
                    (currentPath.startsWith('/vueAjoutAgent') && linkHref === '/vueAjoutAgent') ||
                    (currentPath.startsWith('/vueAjoutLoca') && linkHref === '/vueAjoutLoca') ||
                    (currentPath.startsWith('/vueAjoutVisiteur') && linkHref === '/vueAjoutVisiteur') ||
                    (currentPath.startsWith('/vueAjoutAgentLoca') && linkHref === '/vueAjoutAgentLoca');


                if (isActive && spanElement) {
                    link.classList.add('bg-white/30', 'rounded-md');
                    spanElement.classList.add('underline', 'decoration-pink-300', 'decoration-4', 'underline-offset-4');
                } else if (spanElement) {
                    link.classList.remove('bg-white/30', 'rounded-md');
                    spanElement.classList.remove('underline', 'decoration-pink-300', 'decoration-4', 'underline-offset-4');
                }
            });
        });

        // Ensure body scrolling is re-enabled if window is resized while sidebar is open
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768 && document.body.classList.contains('overflow-hidden')) {
                document.body.classList.remove('overflow-hidden');
            }
            // If sidebar is open on mobile and resized to desktop, close sidebar
            if (window.innerWidth >= 768 && sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('open');
            }
        });
    </script>

</body>

</html>
```