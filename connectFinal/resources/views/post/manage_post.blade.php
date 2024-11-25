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
            'Fórum' => $forum,
        ];

        $backgroundColors = [
            'Vagas de Estágio' => '#D7027B',
            'Notícias' => '#7699D4',
            'Eventos' => '#0042a6',
            'Cursos' => '#4b86df',
            'Fórum' => '#5a026a',
        ];
        @endphp

        @foreach ($postTypes as $type => $posts)
        <div class="row border-bottom pb-3 mb-3">
            @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm position-relative" style="background-color: {{ $backgroundColors[$type] }};">
                    <!-- Data no canto superior direito -->
                    <div class="position-absolute top-0 end-0 p-2 text-white" style="background-color: rgba(0, 0, 0, 0.7); border-radius: 0 0 0 10px; font-style: italic;">
                        {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}
                    </div>

                    <div class="d-flex align-items-center p-3">
                        <img
                            src="{{ asset('storage/' . ($post->foto ?? 'default-post.png')) }}"
                            class="rounded-circle me-3"
                            alt="{{ $post->titulo }}"
                            style="width: 60px; height: 60px; object-fit: cover;">
                        <div>
                            <h5 class="card-title mb-0 text-white">{{ $post->titulo }}</h5>
                            <span class="badge" style="background-color: black; color: white;">{{ $post->categoria->nome ?? 'Sem categoria' }}</span>
                        </div>
                    </div>
                    <div class="card-body position-relative">
                        <p class="card-text text-white">{{ $post->descricao }}</p>

                        <div class="mt-2 d-flex justify-content-end gap-3">
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('post.edit', $post->id) }}" class="text-white">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Tarja preta com a categoria correspondente -->
                    <div class="card-footer text-center text-white" style="background-color: black;">
                        {{ $type }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</x-app-layout>
