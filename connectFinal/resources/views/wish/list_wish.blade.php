@extends('layout.index')
@section('content')

<div class="container">
    <h1>Dados Cadastrados</h1>

    <h3>Linguagens Selecionadas:</h3>
    <ul>
        @foreach($linguagem['linguagens'] as $linguagemId)
            <li>{{ $linguagemId }}</li> <!-- Aqui você pode querer buscar o nome da linguagem a partir do ID -->
        @endforeach
    </ul>

    <h3>Tipo de Skill:</h3>
    <p>
        @if($data['skill_type'] == 1)
            Skill
        @elseif($data['skill_type'] == 2)
            Desejo
        @else
            Tipo desconhecido
        @endif
    </p>
</div>
@endsection
