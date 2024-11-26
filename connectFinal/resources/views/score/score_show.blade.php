@extends('layout.index')
@section('content')

<div class="scoreBody">
    <div class="container flex-column d-flex justify-content-center align-items-center" style="height: 100%;">
        <table class="table">
        <thead>
            <tr>
              <th scope="col">Aluno</th>
              <th scope="col">Posts</th>
              <th scope="col">Cursos</th>
              <th scope="col">Total de Pontos</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($allScoreUser) && count($allScoreUser) > 0)
              @foreach ($allScoreUser as $score)
                  <tr>
                    <td>{{$score->aluno}}</td>
                    <td>{{$score->totalPost}}</td>
                    <td>{{$score->totalCurso}}</td>
                    <td>{{$score->totalPost + $score->totalCurso}}</td>
                  </tr>
              @endforeach
              @endif
          </tbody>
        </table>
        <div class="mt-3">
        </div>

    </div>
</div>

