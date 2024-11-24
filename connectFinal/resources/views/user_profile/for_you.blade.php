@extends('sidebar.index_sidebar')
@section('contentForYou')


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

    {{-- <div class="container d-flex flex-column justify-content-center align-items-center" style="width: 100%; min-height: 85%; margin: auto;"> --}}


    {{-- <div class="parent" style="display: grid;
    grid-template-columns: repeat(6, 1fr);
    grid-template-rows: repeat(4, 1fr);
    grid-column-gap: 20px;
    grid-row-gap: 20px;
    width: 100%; height: 100%;justify-content: center;
    ">

        <div class="div1" style="grid-area: 1 / 1 / 5 / 3; ">
            <div className="card cardJob" style="background-color: #D7027B ; border-radius: 20px;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;">
                <img src="{{ asset('images/jobs.png')}}" className="card-img-top" alt="Foto emprego" style="border-radius: 20px;width:100%;"/>
                <div className="cardBody" style="padding:1px; text-align: center;font-size: 20px;
                text-transform: uppercase;
                font-weight: 700;
                font-family: 'Montserrat', sans-serif;
                color: rgb(255, 255, 255); ">
                    <p className="cardText">Vagas (10)</p>
                </div>
            </div>
        </div>
        <div class="div2" style="grid-area: 1 / 3 / 3 / 5; height: 100%;">
            <div className="card cardEvent" style="background-color: #0042a6 ;  border-radius: 20px;
            width: 100%;
            object-fit: cover;
            object-position: center;">
                <img src="{{ asset('images/evento.png')}}" className="card-img-top" alt="Foto emprego" style="border-radius: 20px;width:100%"/>
                <div className="cardBody" style="padding:1px; text-align: center;font-size: 20px;
                text-transform: uppercase;
                font-weight: 700;
                font-family: 'Montserrat', sans-serif;
                color: rgb(255, 255, 255); ">
                    <p className="cardText">Eventos (2)</p>
                </div>
            </div>
        </div>
        <div class="div3" style="grid-area: 1 / 5 / 3 / 7; height: 100%;">
            <div className="card cardStudy" style="background-color: #4b86df ; border-radius: 20px;
            width: 100%;
            object-fit: cover;
            object-position: center;">
                    <img src="{{ asset('images/book.png')}}" className="card-img-top" alt="Foto emprego" style="border-radius: 20px; width:100%"/>
                    <div className="cardBody" style="padding:1px; text-align: center;font-size: 20px;
                    text-transform: uppercase;
                    font-weight: 700;
                    font-family: 'Montserrat', sans-serif;
                    color: rgb(255, 255, 255);">
                        <p className="cardText">Cursos (25)</p>
                    </div>
                </div>
        </div>
        <div class="div4" style= "grid-area: 3 / 3 / 5 / 7;">
            <div className="card cardForum" style="background-color: #5a026a ; border-radius: 20px;
            width: 100%;
            object-fit: cover;
            object-position: center;">
                <img src="{{ asset('images/balao.png')}}" className="card-img-top" alt="Foto emprego" style="border-radius: 20px; width:100%"/>
                <div className="cardBody" style="padding:1px; text-align: center;font-size: 20px;
                text-transform: uppercase;
                font-weight: 700;
                font-family: 'Montserrat', sans-serif;
                color: rgb(255, 255, 255);">
                    <p className="cardText">fórum</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div> --}}

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
            transition: all 0.3s ease-in-out; padding: 25px;">
                <div class="card-block" style="padding: 10px;">
                    <img src="{{ asset('images/jobs_icon.png')}}" class="card-img-top" alt="Foto emprego" style="width:20%; float:right"/>
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
            transition: all 0.3s ease-in-out; padding: 25px;
            ">
                <div class="card-block" style="padding: 10px;">
                    <img src="{{ asset('images/eventos_icon.png')}}" class="card-img-top" alt="Foto emprego" style="width:20%; float:right"/>
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
            transition: all 0.3s ease-in-out; padding: 25px;">
                <div class="card-block" style="padding:  10px;">
                    <img src="{{ asset('images/book_icon.png')}}" class="card-img-top" alt="Foto emprego" style="border-radius: 20px; width:60%; float:right"/>
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
            transition: all 0.3s ease-in-out; padding: 25px;">
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
        <div class="col-md-6 col-xl-6">
            <div class="card bg-c-pink order-card"
            style="color: #fff; background: linear-gradient(45deg,#FF5370,#ff869a);border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out; padding: 25px;">
                <div class="card-block" style="padding: 10px;">
                    <img src="{{ asset('images/forum_icon.png')}}" class="card-img-top" alt="Foto emprego" style="width:60%; float:right"/>
                    <p class="m-b-25" style="text-transform: uppercase; font-weight: 700; font-family: 'Montserrat', sans-serif; color: rgb(255, 255, 255);">
                    ESCREVA SUA NOTICIA</p>
                    <h6 class="m-b-0">Veja publicações dos usuários</h6>
                    <span>25</span>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
