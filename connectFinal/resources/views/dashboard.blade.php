<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerencie suas atividades') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-6 lg:w-1/3">
            <!-- Card Maior (Usuários) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 flex flex-col p-8 space-y-6">
                <h2 class="text-lg font-bold text-gray-800">Usuários</h2>

                <div class="w-full h-32 bg-gray-100 rounded flex items-center justify-center">
                    <span>Gráfico: Publicações</span>

                </div>

                <div class="w-full h-32 bg-gray-100 rounded flex items-center justify-center">
                    <span>Gráfico: Usuários</span>
                     <!-- tive que chamar esta variável que está originalmente feita para dashboard no método index d o UserCOntrolerr -->
                     @php
    $userCount = \App\Models\User::count();
    $userPhotos = \App\Models\User::whereNotNull('photo')->take(3)->get(['photo']);
@endphp

<h1>Total de Usuários: {{ $userCount }}</h1>

<div class="flex space-x-4 mt-4">
    @foreach($userPhotos as $user)
        <div class="rounded-full overflow-hidden w-16 h-16">
            <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de {{ $user->name }}" class="w-full h-full object-cover">
        </div>
    @endforeach
</div>
                    <span></span>
                </div>

                <p class="text-gray-700 text-sm">
                    Como administrador, você pode gerenciar a criação de novos usuários para sua plataforma.
                    Clique no botão "Adicionar Novo" para começar a cadastrar novos usuários.
                    <br>Dica: Certifique-se de preencher todas as informações necessárias para garantir que o usuário tenha acesso correto aos recursos.
                </p>

                <div class="flex space-x-4">
                    <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-2 py-2 rounded shadow">
                        Adicionar Novo
                    </a>
                    <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-800 px-2 py-2 rounded shadow">
                        Exibir Usuários
                    </a>
                </div>
            </div>

            <!-- Card Menor (Publicações) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full lg:w-1/3 p-6 h-50">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Publicações</h2>
                <p class="text-sm text-gray-700 mb-4">
                    Insira as informações da nova vaga, evento ou curso.
                </p>
                <a href="{{ route('post.create') }}" class="bg-blue-500 text-white mt-2 mb-2 px-1 py-1 rounded shadow">
                    Iniciar Publicação
                </a>
            </div>
        </div>
    </div>




</x-app-layout>