@extends('sidebar.index_sidebar')

@section('contentForYou')

<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center flex-column">
    <!-- Card do Perfil -->
    <div class="card shadow-sm mb-4" style="max-width: 700px; width: 100%;">
        <div class="row g-0">
            <!-- Imagem de Perfil -->
            <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-profile.png') }}"
                     alt="{{ $user->name }}"
                     class="img-fluid rounded-circle userPhoto">
            </div>
            <!-- Detalhes do Perfil -->
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $user->name }}</h5>
                    <p class="mb-1"><strong>Formação:</strong> {{ $user->formacao }}</p>
                    <p class="mb-1"><strong>Data de Nascimento:</strong> {{ $user->data_nascimento ? \Carbon\Carbon::parse($user->data_nascimento)->format('d/m/Y') : 'Não informado' }}</p>

                    <div class="mt-3">
                        <p class="mb-1">
                            <strong>Email:</strong>
                            <a href="mailto:{{ $user->email }}" class="text-blue-500 hover:underline">{{ $user->email }}</a>
                        </p>
                        <p class="mb-1">
                            <strong>GitHub:</strong>
                            <a href="{{ $user->github }}" target="_blank" class="text-blue-500 hover:underline">{{ $user->github }}</a>
                        </p>
                        <p class="mb-1">
                            <strong>LinkedIn:</strong>
                            <a href="{{ $user->linkedin }}" target="_blank" class="text-blue-500 hover:underline">{{ $user->linkedin }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Postagens no Fórum -->
    <div class="container mt-4">
        <h5 class="mb-4"> {{ $user->name }}</h5>
        <div class="row">
            @if ($postForum->isEmpty())
                <p>Este usuário ainda não fez nenhuma postagem no Fórum.</p>
            @else
                @foreach ($postForum as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top"
                                 src="{{ $post->foto ? asset('storage/' . $post->foto) : asset('images/default-post.png') }}"
                                 alt="Imagem da postagem">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->titulo }}</h5>
                                <p class="card-text">{{ Str::limit($post->descricao, 100) }}</p>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection

{{-- Estilos adicionais --}}
@section('styles')
<style>
    .userPhoto {
        width: 120px;
        height: 120px;
        object-fit: cover;
    }

    .card-img-top {
        max-height: 180px;
        object-fit: cover;
    }

    @media (max-width: 767.98px) {
        .userPhoto {
            width: 100px;
            height: 100px;
        }
    }
</style>
@endsection
