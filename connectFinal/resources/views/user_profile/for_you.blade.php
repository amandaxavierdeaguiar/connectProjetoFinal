@extends('sidebar.index_sidebar')
@section('contentForYou')


    <h1 className="nameDashboard" style="background: linear-gradient(90deg, #688AE9 0%, #A8B3E8 50%, #C66D7B 100%);
    -webkit-background-clip: text;
    color: transparent;
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
    font-size: 45px;
    margin-top: -10px;">Olá, {{$users->name}}</h1>
    <h2 className="statusDashboard" style="font-size: 25px;
    /* text-transform: uppercase; */
    color:#79747E;
    font-weight: 400;
    font-family: 'Montserrat', sans-serif;
    margin-top: -35px;">{{$users->curso->nome ?? ' '}}</h2>
    <div class="container d-flex flex-column justify-content-center align-items-center" style="width: 100%; min-height: 85%; margin: auto;">
    <div class="parent" style="display: grid;
    grid-template-columns: repeat(6, 1fr);
    grid-template-rows: repeat(4, 1fr);
    grid-column-gap: 20px;
    grid-row-gap: 20px;
    width: 100%; height: 100%;
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
</div>
@endsection
