<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerencie suas atividades') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-6">
        <!-- Card Maior (Usuários) -->
        <div class="bg-white bg-opacity-90 overflow-hidden shadow-lg sm:rounded-lg flex-1 flex flex-col p-6 space-y-4">
            <h2 class="text-lg font-bold text-gray-800">Usuários</h2>

            <!-- Novo Design para Usuários -->
            <div class="w-full bg-gray-50 rounded-lg shadow-lg p-6 space-y-4">
                <!-- Número Total de Usuários -->
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-700">Total de Usuários:</h2>
                    @php
                        $userCount = \App\Models\User::count();
                        $cursos = \App\Models\User::with('curso')
                                    ->get()
                                    ->groupBy(fn($user) => $user->curso->nome ?? 'Sem Curso')
                                    ->map(fn($group) => $group->count());
                    @endphp
                    <h1 class="text-4xl font-extrabold text-purple-700">{{ $userCount }}</h1>
                </div>

                <!-- Gráfico de Pizza -->
                <div class="w-full flex justify-center items-center">
                    <div class="relative w-48 h-48">
                        <canvas id="cursoChart"></canvas>
                    </div>
                </div>

                <!-- Detalhes dos Cursos -->
                <div class="text-center mt-4">
                    @foreach($cursos as $curso => $total)
                        <p class="text-gray-700">{{ $curso }}: <strong class="text-purple-700">{{ $total }}</strong></p>
                    @endforeach
                </div>
            </div>

            <p class="text-gray-700 text-sm">
                Como administrador, você pode gerenciar a criação de novos usuários para sua plataforma.
                Clique no botão "Adicionar Novo" para começar a cadastrar novos usuários.
                <br>Dica: Certifique-se de preencher todas as informações necessárias para garantir que o usuário tenha acesso correto aos recursos.
            </p>

            <div class="flex space-x-4">
                <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                    Adicionar Novo
                </a>
                <a href="{{ route('users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow">
                    Exibir Usuários
                </a>
            </div>
        </div>

        <!-- Card Menor (Publicações) -->
        <div class="bg-white bg-opacity-90 overflow-hidden shadow-lg sm:rounded-lg w-full lg:w-1/3 p-6 h-auto">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Publicações</h2>
            <p class="text-sm text-gray-700 mb-4">
                Insira as informações da nova vaga, evento ou curso.
            </p>
            <a href="{{ route('post.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white mt-2 px-4 py-2 rounded shadow">
                Iniciar Publicação
            </a>
        </div>
    </div>

    <!-- Script para o Gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('cursoChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($cursos->keys()) !!}, // Nomes dos cursos
                datasets: [{
                    data: {!! json_encode($cursos->values()) !!}, // Totais por curso
                    backgroundColor: ['#6B46C1', '#3182CE', '#38A169', '#E53E3E', '#ED8936'], // Cores para cada curso
                    borderColor: ['#4A3B8C', '#2C5282', '#2F855A', '#C53030', '#DD6B20'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
    </script>
</x-app-layout>
