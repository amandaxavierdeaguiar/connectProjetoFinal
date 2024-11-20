@extends('layout.index')

@section('content')
<div class="flex">
    <div class="{{ $open ? 'w-60 h-screen' : 'w-20 h-full' }} duration-300 h-screen relative divGlobal">
        <button class="absolute cursor-pointer rounded-full -right-3 top-9 w-7 border-2 border-dark-purple bg-white" onclick="toggleOpen()">
            <span id="toggle-arrow">{{ $open ? '←' : '→' }}</span>
        </button>

        <img class="userPhoto mx-auto" src="{{ asset('images/userDefault.png') }}" style="width: {{ $open ? '70%' : '120%' }}; margin-top: {{ $open ? 'auto' : '60px' }}; padding: {{ $open ? '20px' : '5px' }};"/>

        <p class="jobUser " style="{{ $open ? 'display: block;' : 'display: none;' }}">FrontEnd Developer</p>
        <p class="nameUser  p-5" style="{{ $open ? 'display: block;' : 'display: none;' }}">Bia Aguiar</p>

        <div class="h-screen w-full p-5">
            <div class="w-55 h-10 relative rounded shadow-md mx-auto btnGlobal m-2" style="{{ $open ? 'display: block;' : 'display: none;' }}">
                <div class="flex items-center btnSkill">
                    <span class="iconMenu m-2">📊</span>
                    <h2 class="TitleSkill p-0.5">Skills</h2>
                </div>
                <button class="absolute cursor-pointer rounded-full -right-0 top-3 w-7" onclick="toggleSkill()">
                    <span id="skill-arrow">{{ $openSkill ? '▲' : '▼' }}</span>
                </button>

                <ul id="skills-list" style="{{ $openSkill ? 'display: block;' : 'display: none;' }}">
                    @foreach($languages as $lang)
                        <li class="flex items-center">
                            <img src="{{ asset($lang['photo']) }}" alt="{{ $lang['nome'] }}" class="photoSkill" />
                            <span class='languages'>{{ $lang['nome'] }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="w-55 h-10 relative rounded shadow-md mx-auto btnGlobal m-2">
                    <div class="flex items-center btnSkill">
                        <span class="iconMenu m-2">💭</span>
                        <h2 class="TitleSkill p-0.5">Desejos</h2>
                    </div>
                    <button class="absolute cursor-pointer rounded-full -right-0 top-3 w-7" onclick="toggleWish()">
                        <span id="wish-arrow">{{ $openWish ? '▲' : '▼' }}</span>
                    </button>

                    <ul id="wishes-list" style="{{ $openWish ? 'display: block;' : 'display: none;' }}">
                        @foreach($wishes as $wish)
                            <li class="flex items-center">
                                <img src="{{ asset($wish['photo']) }}" alt="{{ $wish['nome'] }}" class="photoSkill" />
                                <span class='languages'>{{ $wish['nome'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="absolute top-0 left-0 w-full" style="{{ $open ? 'display: none;' : 'display: block;' }}">
                <ul class="ulMenu" style="margin: 0; padding: 0;">
                    @foreach($languages as $lang)
                        <li class="flex items-center liMenu" style="margin: 5; padding: 15;">
                            <img src="{{ asset($lang['photo']) }}" alt="{{ $lang['nome'] }}" class="photoSkillMenu" />
                        </li>
                    @endforeach
                    @foreach($wishes as $wish)
                        <li class="flex items-center liMenu" style="margin: 5; padding: 15;">
                            <img src="{{ asset($wish['photo']) }}" alt="{{ $wish['nome'] }}" class="photoSkillMenu" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="">
    </div>
</div>

<script>
    let open = {{ $open ? 'true' : 'false' }};
    let openSkill = {{ $openSkill ? 'true' : 'false' }};
    let openWish = {{ $openWish ? 'true' : 'false' }};

    function toggleOpen() {
        open = !open;
        document.getElementById('toggle-arrow').innerText = open ? '←' : '→';
        document.querySelector('.divGlobal').classList.toggle('w-60');
        document.querySelector('.divGlobal').classList.toggle('w-20');
    }

    function toggleSkill() {
        openSkill = !openSkill;
        document.getElementById('skill-arrow').innerText = openSkill ? '▲' : '▼';
        document.getElementById('skills-list').style.display = openSkill ? 'block' : 'none';
    }

    function toggleWish() {
        openWish = !openWish;
        document.getElementById('wish-arrow').innerText = openWish ? '▲' : '▼';
        document.getElementById('wishes-list').style.display = openWish ? 'block' : 'none';
    }
</script>
@endsection

