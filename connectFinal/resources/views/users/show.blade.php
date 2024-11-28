@extends('sidebar.index_sidebar')

@section('contentForYou')

<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center flex-column">
    <!-- Card do Perfil -->
    <div class="card shadow-sm mb-4" style="max-width: 600px; width: 100%;margin-top:2rem;">
        <div class="row g-0" style="background-color: #c6dbff;">
            <!-- Imagem de Perfil -->
            <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-profile.png') }}"
                     alt="{{ $user->name }}"
                     class="img-fluid rounded-circle userPhoto">
            </div>
            <!-- Detalhes do Perfil -->
            <div class="col-md-8" >
                <div class="card-body" style="text-align: center;">
                    <h5 class="card-title fw-bold" style="color:#480355; margin-top:1rem; margin-bottom:1rem; ">{{ $user->name }}</h5>
                    <p class="mb-1"><strong>Formação:</strong> {{ $user->formacao }}</p>
                    {{-- <p class="mb-1"><strong>Data de Nascimento:</strong> {{ $user->data_nascimento ? \Carbon\Carbon::parse($user->data_nascimento)->format('d/m/Y') : 'Não informado' }}</p> --}}

                    <div class="mt-3">
                        <p class="mb-1">
                            <strong>Email:</strong>
                            <a href="mailto:{{ $user->email }}" class="text-blue-500 hover:underline">{{ $user->email }}</a>
                        </p>
                        {{-- <p class="mb-1">
                            <strong>GitHub:</strong>
                            <a href="{{ $user->github }}" target="_blank" class="text-blue-500 hover:underline">{{ $user->github }}</a>
                        </p>
                        <p class="mb-1">
                            <strong>LinkedIn:</strong>
                            <a href="{{ $user->linkedin }}" target="_blank" class="text-blue-500 hover:underline">{{ $user->linkedin }}</a>
                        </p> --}}
                        <div style="margin-top: 0.9rem;">

                            <a href="{{ $user->linkedin ?? '#' }}" style="display: inline-block;font-size: 24px; color:black" target="_blank">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="{{ $user->github ?? '#' }}" style="display: inline-block;font-size: 24px; color:black" target="_blank">
                                <i class="bi bi-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Postagens no Fórum -->
    <div class="container mt-4 p-3">
        <div class="row border-bottom pb-3 mb-3">
            @if ($postForum->isEmpty())
                <p>Este usuário ainda não fez nenhuma postagem no Fórum.</p>
            @else
                @foreach ($postUsersProfile as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top"
                                 src="{{ $post->foto ? asset('storage/' . $post->foto) : asset('images/default-post.png') }}"
                                 alt="Imagem da postagem">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->titulo }}</h5>
                                <p class="card-text">{{ Str::limit($post->descricao, 100) }}</p>
                            </div>
                            <div class="card-footer" >
                                @if (isset($postFotoUserId   [$post->id]))
                                    @foreach ($postFotoUserId   [$post->id] as $fotoUser )
                                        <div class="user-icon">
                                            <img class="user-photo" src="{{ $fotoUser ->users_photo ? asset('storage/' . $fotoUser ->users_photo) : asset('images/user-default.png') }}" alt="Foto de {{ $fotoUser ->users_name }}">
                                            <div class="user-info"> <!-- Novo div para agrupar o nome e a formação -->
                                                <span class="user-name">{{ $fotoUser ->users_name }}</span>
                                                 <!-- Nome do usuário -->
                                                @if (!empty($fotoUser ->users_formacao))
                                                    <span class="user-formacao">{{ $fotoUser ->users_formacao }}</span> <!-- Formação do usuário -->
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>


</div>

@endsection

<style>
    /* .userPhoto {
        width: 120px;
        height: 120px;
        object-fit: cover;
    } */

    /* .card-img-top {
        max-height: 180px;
        object-fit: cover;
    } */


    /* AVATAR USER */
    .user-icon {
    display: flex;
    align-items: center;
    margin-top: 10px;
    }

    .user-photo {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 8px;
        margin-bottom: 8px;
    }

    .user-name {
        font-weight: bold;
    }

    .user-icon {
    margin-top: 10px;
    }

    .user-curso, .user-formacao {
        font-size: 0.9rem;
        color: var(--clr-gray-med);
        display: block;
    }
    .blog-languages {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    @media (max-width: 767.98px) {
        .userPhoto {
            width: 100px;
            height: 100px;
        }
    }
</style>

{{-- Estilos adicionais --}}
{{-- @section('styles')
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
@endsection --}}
