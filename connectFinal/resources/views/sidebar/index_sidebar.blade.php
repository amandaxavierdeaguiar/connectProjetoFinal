<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> --}}

    <style>
    :root{--header-height: 3rem;--nav-width: 68px;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*, ::before,::after{box-sizing: border-box}
    body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}
    .header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem; background-color: #F7F6FB;

    z-index: var(--z-fixed);transition: .5s}
    .header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}
    .header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}
    .header_img img{width: 40px}
    .l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;
        /* background-color: var(--first-color); */
        /* background: linear-gradient(360deg, #90FCF9, #63B4D1, #7699D4, #7699D4, #480355); */
        background: linear-gradient(0deg, #90FCF9, #63B4D1, #7699D4, #7699D4, #480355);
        padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}
    .nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}
    .nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.2rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: #F7F6FB}.nav_logo-name{color: #F7F6FB;font-weight: 700}

    .nav_link{position: relative;color: #F7F6FB;margin-bottom: 1.5rem;transition: .3s}
    .nav_icon{font-size: 1.5rem; padding-left: 0.2rem}
    .show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: #F7F6FB}.height-100{height:100vh}
    @media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}
    .body-pd{padding-left: calc(var(--nav-width) + 188px)}}

    .userPhoto{
    border-radius: 50%;
    height: auto;
    object-fit: cover;
    overflow: hidden;}
    .nameUser{
    font-size: 1rem;
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
    color: white;
    }

    .jobUser{
    text-transform: uppercase;
    color:#e3d2f3;
    font-weight: 600;
    text-align: center;
    font-size: 0.7rem;
    font-family: 'Montserrat', sans-serif;

    }

    .TitleSkill{
    font-family: 'Montserrat', sans-serif;
    color: #36236a;
    margin-top: 3px;
    font-size: 1.4rem;
    font-weight: 500;
    color: white;
    }

    .botao-sem-estilo{
        background: none;
        border: none;
        color: inherit;
        font: inherit;
        padding: 0;
        cursor: pointer;
    }

    /* SELECT */
    #linguagens-container {
        display: none; /* Inicialmente escondido */
    }

    .btnSubmit{
        text-decoration: underline;
    }

    .forYou{
        color: black;
        width: 100%;
        margin: 0 auto;
    }




    </style>

</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"><i id="header-toggle">X</i>  </div>
        <img src={{asset('images/logo_frame.png')}} alt="" style="1rem;" onclick="window.location='{{ route('user.foryou') }}';">

        @if($usuariosComDesejosIguais ->isNotEmpty())
        <div style="display: flex; flex-wrap: wrap; align-items: center;">
            @foreach ($usuariosComDesejosIguais as $usuario)
                <img class="avatar header_img" src="{{$usuario->photo ? asset('storage/' . $usuario->photo) : asset('images/default-profile.png') }}" style="margin:2px" />
                {{-- <p>{{$usuario->name}} --}}
            @endforeach
        </div>
        @endif
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" >
                    <span class="nav_logo">
                        {{-- <a href="{{route('album.show', $album->id)}}" type="button" class="btn btn-dark">Ver/Editar</a></td> --}}
                        <img class="userPhoto" width="30px" height="30px"
                             src="{{$users->photo ? asset('storage/' . $users->photo) : asset('images/default-profile.png') }}"
                             style="display: inline-block; vertical-align: middle;" onclick="window.location='{{ route('user.show', $users->id) }}';">
                        <span style="display: inline-block; vertical-align: middle;">
                            <p class='nameUser' style="margin: 0;">{{$users->name}}</p>
                            <p class='jobUser' style="margin: 0;">{{$users->formacao}}</p>
                        </span>
                    </span>
                </a>

                <div class="nav_list">




                    <div class="nav_link active">
                        <i class="bi bi-grid-fill nav_icon">
                            <span class="nav_name">Skills</span>
                        </i>

                        {{-- @if(isset($linguagensSelecionadas) && count($linguagensSelecionadas) <div 0) --}}

                        @if(isset($linguagensSelecionadas) && count($linguagensSelecionadas) == 0)
                        <button type="button" onclick="mostrarLinguagens(1)" class= "botao-sem-estilo"><i class="bi bi-caret-down-fill"></i>
                        </button>
                        <form method="POST" action="{{ route('wish.create') }}">
                        @csrf
                            <input type="hidden" name="skill_type" value="1">

                            <div id="linguagens-container" style="margin-top: 1rem; margin-left:2.1rem;">
                                @foreach ($linguages as $linguagem)
                                    {{-- <label>
                                        <input type="checkbox" name="linguagem[]" value="{{ $linguagem->id }}"
                                        {{ in_array($linguagem->id, $linguagensSelecionadas) ? 'disabled' : '' }}>
                                        {{ $linguagem->name }}
                                    </label><br> --}}
                                    <label>
                                        <input type="checkbox" name="linguagem[]" value="{{ $linguagem->id }}"
                                        {{ in_array($linguagem->id, $linguagensSelecionadas) ? 'disabled' : '' }}>
                                        {{ $linguagem->name }}
                                    </label><br>
                                @endforeach
                                <button type="submit" class="botao-sem-estilo btnSubmit" style="padding-top: 1rem" >Cadastrar</button>
                            </div>
                        </form>
                        @endif

                        @if($skillUser ->isNotEmpty())
                        <button type="button" class= "botao-sem-estilo"></i>
                        </button>
                            <ul style="list-style-type: none; padding: 0; margin: 0; text-align: left; margin-top:1rem;">
                                @foreach ($skillUser  as $skill)
                                    <li>
                                        <img width="30px" height="30px"
                                            src="{{ $skill->foto ? asset('storage/' . $skill->foto) : asset('images/nophoto.jpg') }}">
                                        {{ $skill->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="nav_link active">
                        <i class="bi bi-columns-gap nav_icon" >
                            <span class="nav_name">Desejos</span>
                        </i>

                        @if($wishUser ->isEmpty())
                        <button type="button" onclick="mostrarLinguagens(2)" class= "botao-sem-estilo"><i class="bi bi-caret-down-fill"></i>
                        </button>
                        <form method="POST" action="{{ route('wish.create') }}">
                            @csrf
                            <input type="hidden" name="skill_type" value="2">

                            <div id="linguagens-container2" style="margin-top: 1rem;margin-left:2.1rem;">
                                @foreach ($linguages as $linguagem)
                                    <label>
                                        <input type="checkbox" name="linguagem[]" value="{{ $linguagem->id }}"
                                        {{ in_array($linguagem->id, $linguagensSelecionadas) ? 'disabled' : '' }}>
                                        {{ $linguagem->name }}
                                    </label><br>
                                @endforeach
                                <button type="submit" class="botao-sem-estilo btnSubmit" style="padding-top: 1rem" >Cadastrar</button>
                            </div>
                        </form>
                        @endif

                        @if($wishUser ->isNotEmpty())
                        <button type="button" class= "botao-sem-estilo"></i>
                        </button>
                            <ul style="list-style-type: none; padding: 0; margin: 0; text-align: left; margin-top:1rem;">
                                @foreach ($wishUser  as $wish)
                                    <li>
                                        <img width="30px" height="30px"
                                            src="{{ $wish->foto ? asset('storage/' . $wish->foto) : asset('images/nophoto.jpg') }}">
                                        {{ $wish->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div style="margin-left: 0.9rem;">
                <a href="{{ $users->linkedin ?? '#' }}" style="display: inline-block;" target="_blank">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="{{ $users->github ?? '#' }}" style="display: inline-block;" target="_blank">
                    <i class="bi bi-github"></i>
                </a>
            </div>

            <a href="#" class="nav_link"> <i class="bi bi-box-arrow-right nav_icon"></i>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="w-100">
        @yield('contentForYou')
    </div>
    {{-- <div class="height-100">
        <h4>Main Components</h4>

    </div> --}}
    <!--Container Main end-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) =>{
        const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
            // show navbar
            nav.classList.toggle('show')
            // change icon
            toggle.classList.toggle('bx-x')
            // add padding to body
            bodypd.classList.toggle('body-pd')
            // add padding to header
            headerpd.classList.toggle('body-pd')
        })
        }
        }

        showNavbar('header-toggle','nav-bar','body-pd','header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink(){
        if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
        }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
                });

        function mostrarLinguagens(skillType) {
            // Obtém o elemento do container de linguagens
            var linguagensContainer = document.getElementById('linguagens-container');
            var linguagensContainer2 = document.getElementById('linguagens-container2');

            // Verifica o estado atual do display e alterna
                if (linguagensContainer.style.display === 'block') {
                    linguagensContainer.style.display = 'none'; // Oculta
                } else {
                    linguagensContainer.style.display = 'block'; // Mostra
                    // Define o valor do skill_type no formulário
                    document.getElementById('skill_type').value = skillType;
                }

                // Verifica o estado atual do display e alterna
                if (linguagensContainer2.style.display === 'block') {
                    linguagensContainer2.style.display = 'none'; // Oculta
                } else {
                    linguagensContainer2.style.display = 'block'; // Mostra
                    // Define o valor do skill_type no formulário
                    document.getElementById('skill_type').value = skillType;
                }
    }
    </script>
</body>
</html>
