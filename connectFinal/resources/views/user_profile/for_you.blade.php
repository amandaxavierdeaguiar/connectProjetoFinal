@extends('sidebar.index_sidebar')
@section('contentForYou')

<style>
    .modal {
    display: none; /* Escondido por padrão */
    position: fixed; /* Fica fixo na tela */
    z-index: 1; /* Fica acima de outros elementos */
    left: 0;
    top: 0;
    width: 100%; /* Largura total */
    height: 100%; /* Altura total */
    overflow: auto; /* Habilita rolagem se necessário */
    background-color: rgb(0,0,0); /* Cor de fundo */
    background-color: rgba(0,0,0,0.4); /* Fundo preto com opacidade */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% do topo e centralizado */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Largura do modal */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>

<h1 className="nameDashboard"
    style="background: linear-gradient(90deg, #688AE9 0%, #A8B3E8 50%, #C66D7B 100%);
    -webkit-background-clip: text;
    color: transparent;
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
    font-size: 45px;
    margin-top: 10px;">
    Olá, {{$users->name}}</h1>
<h2 className="statusDashboard"
    style="font-size: 25px;
    /* text-transform: uppercase; */
    color:#79747E;
    font-weight: 400;
    font-family: 'Montserrat', sans-serif;
    margin-top: -10px;">
    {{$users->curso->nome ?? ' '}}</h2>



<h2 className="statusDashboard"
    style="font-size: 35px;
    /* text-transform: uppercase; */
    color:#79747E;
    font-weight: 400;
    font-family: 'Montserrat', sans-serif;
    margin-top: 30px;">
    Para você... </h2>

<div class="container" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card bg-c-blue order-card"
            style="color: #fff; background: linear-gradient(45deg,#4099ff,#73b4ff);border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            border: none;
            margin-bottom: 15px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out; padding: 25px;" onclick="window.location='{{ route('user.post.job') }}';">
                <div class="card-block" style="padding: 10px;">
                    <img src="{{ asset('images/jobs_icon.png')}}" class="card-img-top" alt="Foto emprego" style="width:22%; float:right"/>
                    <p class="m-b-25" style="text-transform: uppercase; font-weight: 700; font-family: 'Montserrat', sans-serif; color: rgb(255, 255, 255);">
                    vagas de estágio</p>
                    <h6 class="m-b-0">Encontre as vagas de estágio com empresas parceiras</h6>
                    <span>25</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-6 h-lg-100">
            <div class="card bg-c-green order-card h-200"
            style="color: #fff; background: linear-gradient(45deg,#2ed8b6,#59e0c5);border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out; padding: 25px; " onclick="window.location='{{ route('user.post.evento') }}';">
                <div class="card-block" style="padding: 10px;">
                    <img src="{{ asset('images/eventos_icon.png')}}" class="card-img-top" alt="Foto Eventos" style="width:25%; float:right"/>
                    <p class="m-b-25" style="text-transform: uppercase; font-weight: 700; font-family: 'Montserrat', sans-serif; color: rgb(255, 255, 255);">
                    Eventos</p>
                    <h6 class="m-b-0">Encontre os eventos disponíveis</h6>
                    <span>15</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xl-3">
            <div class="card bg-c-yellow order-card"
            style="color: #fff; background: linear-gradient(45deg,#FFB64D,#ffcb80);border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out; padding: 25px;" onclick="window.location='{{ route('user.post.curso') }}';">
                <div class="card-block" style="padding:  10px;">
                    <img src="{{ asset('images/book_icon.png')}}" class="card-img-top" alt="Foto Curso" style="border-radius: 20px; width:60%; float:right"/>
                    <p class="m-b-25" style="text-transform: uppercase; font-weight: 700; font-family: 'Montserrat', sans-serif; color: rgb(255, 255, 255);">
                    Cursos</p>
                    <h6 class="m-b-0">Encontre os cursos disponíveis</h6>
                    <span>25</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xl-3">
            <div class="card bg-c-pink order-card"
            style="color: #fff; background: linear-gradient(45deg,#FF5370,#ff869a);border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out; padding: 25px;" onclick="window.location='{{ route('user.post.forum') }}';">
                <div class="card-block" style="padding: 10px;">
                    <img src="{{ asset('images/forum_icon.png')}}" class="card-img-top" alt="Foto emprego" style="width:60%; float:right"/>
                    <p class="m-b-25" style="text-transform: uppercase; font-weight: 700; font-family: 'Montserrat', sans-serif; color: rgb(255, 255, 255);">
                    Fórum</p>
                    <h6 class="m-b-0">Veja publicações dos usuários</h6>
                    <span>25</span>
                </div>
            </div>
        </div>

        {{-- teste --}}
        {{-- <div class="col-md-6 col-xl-6" onclick="window.location='{{ route('user.forum') }}'" style="cursor: pointer;"> --}}

        <div class="col-md-6 col-xl-6">

            {{-- id="openModal" --}}
            <div class="card bg-c-pink order-card"
            style="color: #fff; background: linear-gradient(45deg,#FF5370,#ff869a);border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out; padding: 25px;" onclick="window.location='{{ route('forum.create.form') }}';">
                <div class="card-block" style="padding: 10px;">
                    <p class="m-b-25" style="text-transform: uppercase; font-weight: 700; font-family: 'Montserrat', sans-serif; color: rgb(255, 255, 255);">
                        Queremos te ouvir!</p>
                        {{-- <a href="{{ route('post.create') }}" > --}}
                    <img  src="{{ asset('images/sms.png')}}" class="card-img-top" alt="Foto emprego" style="width:70%; float:right"
                    />
                    {{-- <a href="modal.html" class="btn btn-primary" id="openModal">Abrir Modal</a> --}}
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container" style="margin-top: 10px">
    <div class="row">
        {{-- @foreach ($posts->take(3) as $post) --}}
            <div class="col-md-4">
                @include('components.card_post_user', [
                    // 'userPhoto' => $post->user->photo ? asset('storage/' . $post->user->photo) : asset('images/default-profile.png'),
                    'userNameModal' => $users->name,
                    'userJob' => $users->formacao,
                    'linguages' => $linguages,
                ])
            </div>
        {{-- @endforeach --}}
    </div>
</div>

@endsection
