<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Neo Start Technology</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <main class="max-w-6xl mx-auto px-6 py-12" >
        <h1 class="text-3xl font-bold text-blue-700 mb-10 text-center">Tableau de Bord</h1>

        <!-- Statistiques globales -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <p class="text-sm text-gray-500">Visiteurs totaux</p>
                <p class="text-2xl font-bold text-blue-600">1542</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <p class="text-sm text-gray-500">Visites aujourd’hui</p>
                <p class="text-2xl font-bold text-green-600">38</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <p class="text-sm text-gray-500">Visites ce mois</p>
                <p class="text-2xl font-bold text-yellow-600">214</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <p class="text-sm text-gray-500">Visiteurs bannis</p>
                <p class="text-2xl font-bold text-red-600">4</p>
            </div>
        </div>  

        <!-- Répartition des statuts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-4">Statuts des visiteurs</h2>
                <ul class="space-y-2 text-sm">
                    <li class="flex justify-between"><span>En attente</span><span class="font-bold text-yellow-600">12</span></li>
                    <li class="flex justify-between"><span>Validés</span><span class="font-bold text-green-600">57</span></li>
                    <li class="flex justify-between"><span>En cours</span><span class="font-bold text-blue-500">21</span></li>
                    <li class="flex justify-between"><span>Terminés</span><span class="font-bold text-gray-700">100</span></li>
                    <li class="flex justify-between"><span>Bannis</span><span class="font-bold text-red-600">4</span></li>
                </ul>
            </div>

            <!-- Top agents -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-blue-700 mb-4">Top 3 agents visités</h2>
                <ul class="space-y-2 text-sm">
                    <li class="flex justify-between"><span>M. Kossi</span><span class="font-bold">34 visites</span></li>
                    <li class="flex justify-between"><span>Mme Dossou</span><span class="font-bold">28 visites</span></li>
                    <li class="flex justify-between"><span>M. Lawson</span><span class="font-bold">20 visites</span></li>
                </ul>
            </div>
        </div>

        <!-- Graphique des visites par mois -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-blue-700 mb-6">Graphique des visites par mois</h2>
            <canvas id="visiteChart" height="100"></canvas>
        </div>
    </main>

    <!-- Chart.js -->
    <script>
    window.onload = function () {
        const ctx = document.getElementById('visiteChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janv', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Visites',
                    data: [12, 19, 10, 5, 15, 8, 18, 14, 6, 9, 11, 13],
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false 
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    };
</script>

</body>

</html>