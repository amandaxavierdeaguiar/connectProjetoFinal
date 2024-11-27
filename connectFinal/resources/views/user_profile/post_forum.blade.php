@extends('sidebar.index_sidebar')

@section('contentForYou')
<style>
    :root {
      --clr-gray-light: #d7dfe2;
      --clr-gray-med: #616b74;
      --clr-gray-dark: #414b56;
      --clr-link: #4d97b2;
      --clr-popular: #ef257a;
      --clr-technology: #651fff;
      --clr-psychology: #e85808;
    }

    .cards {
      overflow: hidden;
      box-shadow: 0px 2px 20px var(--clr-gray-light);
      background: white;
      border-radius: 0.5rem;
      position: relative;
      width: 350px;
      margin: 1rem;
      transition: 250ms all ease-in-out;
      cursor: pointer;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0px 2px 40px var(--clr-gray-light);
    }

    .banner-img {
      position: absolute;
      object-fit: cover;
      height: 14rem;
      width: 100%;
      top: 0;
        left: 0;
    }

    .category-tag {
      font-size: 0.8rem;
      font-weight: bold;
      color: white;
      background: red;
      padding: 0.5rem 1.3rem 0.5rem 1rem;
      text-transform: uppercase;
      position: absolute;
      z-index: 1;
      top: 1rem;
      left: 0;
      border-radius: 0 2rem 2rem 0;
    }

    .popular {
      background: var(--clr-popular);
    }

    .technology {
      background: var(--clr-technology);
    }

    .psychology {
      background: var(--clr-psychology);
    }

    .card-body {
      margin: 15rem 1rem 1rem 1rem;
    }

    .blog-hashtag {
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--clr-link);
    }

    .blog-title {
      line-height: 1.5rem;
      margin: 1rem 0 0.5rem;
      color: rgb(80, 0, 42);
    }

    .blog-description {
      color: var(--clr-gray-med);
      font-size: 0.9rem;
    }

    .card-profile {
      display: flex;
      margin-top: 2rem;
      align-items: center;
    }

    .profile-img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
    }

    .card-profile-info {
      margin-left: 1rem;
    }

    .profile-name {
      font-size: 1rem;
    }

    .profile-followers {
      color: var(--clr-gray-med);
      font-size: 0.9rem;
    }

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

    </style>

<div class="container">
    <div class="row border-bottom pb-3 mb-3">
        @if($postForum->isEmpty())
            <p style="color: black">Não há nada para mostrar.</p>
        @else
            @foreach ($postForum as $post)
                <div class="cards">
                    <div class="card-banner">
                        <!-- Post Title -->
                        <p class="category-tag popular">{{ $post->titulo }}</p>

                        <!-- Post Image -->
                        <img class="banner-img" src="{{ $post->foto ? asset('storage/' . $post->foto) : asset('images/post-default.png') }}" alt="{{ $post->titulo }}">
                    </div>

                    <div class="card-body">
                        <div class="blog-languages">
                            @if (isset($postCategoriaName[$post->id]))
                                    @foreach ($postCategoriaName[$post->id] as $categoria)
                                        <span class="blog-hashtag">#{{ $categoria->categoria_nome }}</span>
                                    @endforeach
                            @endif
                        </div>

                        <div class="blog-languages">
                            @if (isset($postLinguagemName[$post->id]))
                                    @foreach ($postLinguagemName[$post->id] as $linguagem)
                                        <span class="blog-hashtag">#{{ $linguagem->linguagem_name }}</span>
                                    @endforeach
                            @endif
                        </div>

                        {{-- foto User Post --}}

                        <br>
                        <!-- Post Description -->
                        <p class="blog-description">{{ $post->descricao }}</p>
                    </div>
                    <div class="card-footer" >

                        @if (isset($postFotoUser   [$post->id]))
                            @foreach ($postFotoUser   [$post->id] as $fotoUser )
                                <div class="user-icon">
                                    <img class="user-photo" src="{{ $fotoUser ->users_photo ? asset('storage/' . $fotoUser ->users_photo) : asset('images/user-default.png') }}" alt="Foto de {{ $fotoUser ->users_name }}">
                                    <div class="user-info"> <!-- Novo div para agrupar o nome e a formação -->
                                        <span class="user-name">{{ $fotoUser ->users_name }}</span> <!-- Nome do usuário -->
                                        @if (!empty($fotoUser ->users_formacao))
                                            <span class="user-formacao">{{ $fotoUser ->users_formacao }}</span> <!-- Formação do usuário -->
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
