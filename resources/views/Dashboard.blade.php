@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 to-white py-10 px-2">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-extrabold text-blue-700 text-center mb-10 drop-shadow-lg tracking-tight">Dashboard</h1>
        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="glassmorphism-box p-8 flex flex-col items-center">
                <span class="text-5xl mb-2 text-blue-600 font-black">{{ $totalAgents }}</span>
                <span class="text-lg font-semibold text-blue-800">Agents</span>
            </div>
            <div class="glassmorphism-box p-8 flex flex-col items-center">
                <span class="text-5xl mb-2 text-pink-500 font-black">{{ $totalLocataires }}</span>
                <span class="text-lg font-semibold text-pink-700">Locataires</span>
            </div>
            <div class="glassmorphism-box p-8 flex flex-col items-center">
                <span class="text-5xl mb-2 text-green-500 font-black">{{ $totalVisiteurs }}</span>
                <span class="text-lg font-semibold text-green-700">Visiteurs</span>
            </div>
        </div>
        <!-- Derniers Agents -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-blue-700 mb-4">Derniers Agents</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white/80 glassmorphism-box rounded-2xl shadow-xl">
                    <thead class="bg-blue-50 text-blue-700">
                        <tr>
                            <th class="px-6 py-3">Photo</th>
                            <th class="px-6 py-3">Nom</th>
                            <th class="px-6 py-3">Prénoms</th>
                            <th class="px-6 py-3">Matricule</th>
                            <th class="px-6 py-3">Fonction</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agents as $agent)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4">
                                <img src="{{ $agent->photo ? asset('storage/' . $agent->photo) : asset('images/default-user-blue.png') }}" class="h-12 w-12 rounded-full object-cover border-2 border-blue-200 shadow" alt="Photo">
                            </td>
                            <td class="px-6 py-4">{{ $agent->nom }}</td>
                            <td class="px-6 py-4">{{ $agent->prenoms }}</td>
                            <td class="px-6 py-4">{{ $agent->matricule }}</td>
                            <td class="px-6 py-4">{{ $agent->fonction }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-400">Aucun agent</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Derniers Locataires -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-pink-700 mb-4">Derniers Locataires</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white/80 glassmorphism-box rounded-2xl shadow-xl">
                    <thead class="bg-pink-50 text-pink-700">
                        <tr>
                            <th class="px-6 py-3">Photo</th>
                            <th class="px-6 py-3">Nom</th>
                            <th class="px-6 py-3">Prénoms</th>
                            <th class="px-6 py-3">Statut</th>
                            <th class="px-6 py-3">Appartement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locataires as $locataire)
                        <tr class="hover:bg-pink-50 transition">
                            <td class="px-6 py-4">
                                <img src="{{ $locataire->photo ? asset('storage/' . $locataire->photo) : asset('images/default-user-blue.png') }}" class="h-12 w-12 rounded-full object-cover border-2 border-pink-200 shadow" alt="Photo">
                            </td>
                            <td class="px-6 py-4">{{ $locataire->nom }}</td>
                            <td class="px-6 py-4">{{ $locataire->prenoms }}</td>
                            <td class="px-6 py-4">{{ $locataire->statut }}</td>
                            <td class="px-6 py-4">{{ $locataire->numApp }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-400">Aucun locataire</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Derniers Visiteurs -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-green-700 mb-4">Derniers Visiteurs</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white/80 glassmorphism-box rounded-2xl shadow-xl">
                    <thead class="bg-green-50 text-green-700">
                        <tr>
                            <th class="px-6 py-3">Nom</th>
                            <th class="px-6 py-3">Prénoms</th>
                            <th class="px-6 py-3">Téléphone</th>
                            <th class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visiteurs as $visiteur)
                        <tr class="hover:bg-green-50 transition">
                            <td class="px-6 py-4">{{ $visiteur->nom }}</td>
                            <td class="px-6 py-4">{{ $visiteur->prenoms }}</td>
                            <td class="px-6 py-4">{{ $visiteur->phone }}</td>
                            <td class="px-6 py-4">{{ $visiteur->created_at ? $visiteur->created_at->format('d/m/Y H:i') : '' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-400">Aucun visiteur</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .glassmorphism-box {
        background: rgba(255, 255, 255, 0.92);
        box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.18);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-radius: 2rem;
        border: 2px solid rgba(59, 130, 246, 0.10);
    }
</style>
@endsection
// Masquer l'indicateur de chargement
document.getElementById('loadingIndicator').classList.add('hidden');

// Calcul des statistiques globales
const totalVisitorsCount = visitors.length;
document.getElementById('totalVisitors').textContent = totalVisitorsCount;

const today = new Date();
const { start: startOfToday, end: endOfToday } = getStartAndEndOfDay(today);
const todayVisitsCount = visitors.filter(v => {
const visitDate = new Date(v.timestamp);
return visitDate >= startOfToday && visitDate <= endOfToday;
    }).length;
    document.getElementById('todayVisits').textContent=todayVisitsCount;

    const { start: startOfMonth, end: endOfMonth }=getStartAndEndOfMonth(today);
    const monthVisitsCount=visitors.filter(v=> {
    const visitDate = new Date(v.timestamp);
    return visitDate >= startOfMonth && visitDate <= endOfMonth;
        }).length;
        document.getElementById('monthVisits').textContent=monthVisitsCount;

        const bannedVisitorsCount=visitors.filter(v=> v.isBanned).length;
        document.getElementById('bannedVisitors').textContent = bannedVisitorsCount;

        // Calcul des statuts des visiteurs
        const statusCounts = {
        'En attente': 0,
        'Validés': 0,
        'En cours': 0,
        'Terminés': 0,
        'Bannis': 0
        };
        visitors.forEach(v => {
        if (statusCounts.hasOwnProperty(v.status)) {
        statusCounts[v.status]++;
        }
        });
        document.getElementById('statusPending').textContent = statusCounts['En attente'];
        document.getElementById('statusValidated').textContent = statusCounts['Validés'];
        document.getElementById('statusInProgress').textContent = statusCounts['En cours'];
        document.getElementById('statusCompleted').textContent = statusCounts['Terminés'];
        document.getElementById('statusBanned').textContent = statusCounts['Bannis'];

        // Calcul des top agents
        const agentCounts = {};
        visitors.forEach(v => {
        if (v.agentVisited) {
        agentCounts[v.agentVisited] = (agentCounts[v.agentVisited] || 0) + 1;
        }
        });
        const sortedAgents = Object.entries(agentCounts).sort(([, a], [, b]) => b - a).slice(0, 3);
        const topAgentsList = document.getElementById('topAgentsList');
        topAgentsList.innerHTML = ''; // Nettoyer la liste existante
        if (sortedAgents.length > 0) {
        sortedAgents.forEach(([agent, count]) => {
        const li = document.createElement('li');
        li.className = 'flex justify-between';
        li.innerHTML = `<span>${agent}</span><span class="font-bold">${count} visites</span>`;
        topAgentsList.appendChild(li);
        });
        } else {
        const li = document.createElement('li');
        li.className = 'flex justify-between';
        li.innerHTML = `<span>Aucune donnée</span><span class="font-bold">0 visites</span>`;
        topAgentsList.appendChild(li);
        }

        // Mettre à jour le graphique des visites par mois
        const monthlyVisits = new Array(12).fill(0);
        visitors.forEach(v => {
        const visitDate = new Date(v.timestamp);
        const month = visitDate.getMonth(); // 0 pour Janvier, 11 pour Décembre
        if (month >= 0 && month < 12) {
            monthlyVisits[month]++;
            }
            });

            if (chartInstance) {
            chartInstance.data.datasets[0].data=monthlyVisits;
            chartInstance.update();
            } else {
            const ctx=document.getElementById('visiteChart').getContext('2d');
            chartInstance=new Chart(ctx, {
            type: 'bar' ,
            data: {
            labels: ['Janv', 'Fév' , 'Mars' , 'Avril' , 'Mai' , 'Juin' , 'Juil' , 'Août' , 'Sept' , 'Oct' , 'Nov' , 'Déc' ],
            datasets: [{
            label: 'Visites' ,
            data: monthlyVisits,
            backgroundColor: 'rgba(59, 130, 246, 0.7)' ,
            borderColor: 'rgba(37, 99, 235, 1)' ,
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
            }
            }

            // Initialisation de Firebase et écoute des changements d'authentification
            window.onload=async function () {
            try {
            // Afficher l'indicateur de chargement
            document.getElementById('loadingIndicator').classList.remove('hidden');

            const app=initializeApp(firebaseConfig);
            db=getFirestore(app);
            auth=getAuth(app);

            // Gérer l'authentification
            if (initialAuthToken) {
            await signInWithCustomToken(auth, initialAuthToken);
            } else {
            await signInAnonymously(auth);
            }

            onAuthStateChanged(auth, (user)=> {
            if (user) {
            currentUserId = user.uid;
            document.getElementById('userIdDisplay').textContent = currentUserId;
            console.log("Utilisateur connecté:", currentUserId);

            // Écouter les données des visiteurs une fois authentifié
            const visitorsCollectionRef = collection(db, `artifacts/${appId}/public/data/visitors`);
            onSnapshot(visitorsCollectionRef, (snapshot) => {
            const visitorsData = [];
            snapshot.forEach(doc => {
            const data = doc.data();
            // Assurez-vous que le timestamp est une chaîne ISO ou un objet Date
            // Si c'est un objet Timestamp de Firestore, convertissez-le
            if (data.timestamp && typeof data.timestamp.toDate === 'function') {
            data.timestamp = data.timestamp.toDate().toISOString();
            }
            visitorsData.push(data);
            });
            updateDashboard(visitorsData);
            }, (error) => {
            console.error("Erreur lors de la récupération des visiteurs:", error);
            document.getElementById('loadingIndicator').textContent = "Erreur de chargement des données.";
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('loadingIndicator').classList.add('text-red-500');
            });

            } else {
            console.log("Aucun utilisateur connecté.");
            document.getElementById('userIdDisplay').textContent = "Non connecté";
            document.getElementById('loadingIndicator').textContent = "Veuillez vous connecter pour voir les données.";
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('loadingIndicator').classList.add('text-red-500');
            }
            });

            } catch (error) {
            console.error("Erreur d'initialisation Firebase ou d'authentification:", error);
            document.getElementById('loadingIndicator').textContent = "Erreur d'initialisation de l'application.";
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('loadingIndicator').classList.add('text-red-500');
            }

            // Logique pour le bouton d'ajout de données de test
            document.getElementById('addTestDataBtn').addEventListener('click', async () => {
            if (!db || !currentUserId) {
            alert("Veuillez attendre la connexion à la base de données."); // Utilisation temporaire pour l'exemple
            return;
            }

            const statuses = ['En attente', 'Validés', 'En cours', 'Terminés', 'Bannis'];
            const agents = ['M. Kossi', 'Mme Dossou', 'M. Lawson', 'Mlle Dupont', 'M. Martin'];
            const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];
            const randomAgent = agents[Math.floor(Math.random() * agents.length)];
            const randomBanned = Math.random() < 0.1; // 10% de chance d'être banni

                // Générer une date aléatoire dans les 3 derniers mois
                const now=new Date();
                const randomDaysAgo=Math.floor(Math.random() * 90); // Jusqu'à 90 jours en arrière
                const randomDate=new Date(now.setDate(now.getDate() - randomDaysAgo));

                const visitorData={
                name: `Visiteur ${Math.floor(Math.random() * 10000)}`,
                status: randomStatus,
                agentVisited: randomAgent,
                timestamp: randomDate.toISOString(), // Utiliser ISO string pour la compatibilité
                isBanned: randomBanned,
                createdAt: serverTimestamp() // Firestore Timestamp pour l'ordre
                };

                try {
                await addDoc(collection(db, `artifacts/${appId}/public/data/visitors`), visitorData);
                console.log("Document de visiteur ajouté avec succès !");
                } catch (e) {
                console.error("Erreur lors de l'ajout du document: ", e);
                    alert(" Erreur lors de l'ajout du document de test."); // Utilisation temporaire pour l'exemple
                }
                });
                };
                </script>
                </body>

                </html>