<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Todas as Postagens</h1>
        <a href="{{ route('post.create') }}" class="btn btn-primary">Criar Postagem</a>

        @php
            $postTypes = [
                'Vagas de Estágio' => $vagas,
                'Notícias' => $noticias,
                'Eventos' => $eventos,
                'Cursos' => $cursos,
            ];

            // Cores para cada tipo de postagem
            $backgroundColors = [
                'Vagas de Estágio' => '#E0DFFF',
                'Notícias' => '#7699D4',
                'Eventos' => '#C66D7B',
                'Cursos' => '#63B4D1',
            ];
        @endphp

        @foreach ($postTypes as $type => $posts)
            <h2 class="mt-4">{{ $type }}</h2>
            <div class="row border-bottom pb-3 mb-3">
                @foreach ($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm" style="background-color: {{ $backgroundColors[$type] }};">
                            <div class="d-flex align-items-center p-3">
                                <img 
                                    src="{{ asset('storage/' . ($post->foto ?? 'default-post.png')) }}" 
                                    class="rounded-circle me-3" 
                                    alt="{{ $post->titulo }}" 
                                    style="width: 60px; height: 60px; object-fit: cover;"
                                >
                                <div>
                                    <h5 class="card-title mb-0">{{ $post->titulo }}</h5>
                                    <span class="badge bg-secondary">{{ $post->categoria->nome ?? 'Sem categoria' }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $post->descricao }}</p>
                                <a href="#" class="btn btn-dark">Ver mais</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-app-layout>