<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar postagens') }}
        </h2>
    </x-slot>

    <div class="container">
       
        <a href="{{ route('post.create') }}" class="btn btn-primary mt-5 mb-5">Criar Postagem</a>

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

        <div class="row border-bottom pb-3 mb-3">
            @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm" style="background-color: {{ $backgroundColors[$type] }};">
                    <div class="d-flex align-items-center p-3">
                        <img
                            src="{{ asset('storage/' . ($post->foto ?? 'default-post.png')) }}"
                            class="rounded-circle me-3"
                            alt="{{ $post->titulo }}"
                            style="width: 60px; height: 60px; object-fit: cover;">
                        <div>
                            <h5 class="card-title mb-0">{{ $post->titulo }}</h5>
                            <span class="badge bg-secondary">{{ $post->categoria->nome ?? 'Sem categoria' }}</span>
                        </div>
                    </div>
                    <div class="card-body position-relative">
                        <p class="card-text">{{ $post->descricao }}</p>

                        <div class="mt-2 d-flex justify-content-end gap-3" style="bottom: 10px; right: 10px ;">
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-gray-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('post.edit', $post->id) }}">
                                <i class="text-gray-500 fas fa-pencil-alt hover:text-gray-900"></i>
                            </a>
                        </div>

                    </div>


                    <button type="button" class="btn btn-primary" id="nextBtnStep2" style="background-color: black; border-color: black; color: white;">{{ $type }}</button>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</x-app-layout>