@extends('layout.index')
@section('content')

<div class="loginBody">
    <div class="container flex-column d-flex justify-content-center align-items-center" style="height: 100%;">
        <table class="table">
        <thead>
            <tr>
              {{-- <th scope="col">id</th> --}}
              <th scope="col">Foto</th>
              <th scope="col">Nome</th>
              <th scope="col">Descricao</th>
              <th scope="col">Quantidade horas</th>
              <th scope="col">data_inicio</th>
              <th scope="col">data_fim</th>
              <th scope="col">id_categoria</th>
              <th scope="col"> </th> <!--Botao Ver/editar-->
              <th scope="col"> </th> <!--Botao Apagar - Apenas adm -->
            </tr>
          </thead>
          <tbody>
            @if(isset($allStudies) && count($allStudies) > 0)
              @foreach ($allStudies as $study)
                  <tr>
                    {{-- <th scope="row">{{$album->id}}</th> --}}
                    <td><img width="30px" height="30px"
                          src="{{$study->foto ? asset('storage/' . $study->foto) : asset('images/nophoto.jpg') }}">
                    </td>
                    <td>{{$study->nome}}</td>
                    <td>{{$study->descricao}}</td>
                    <td>{{$study->quantidade_horas}}</td>
                    <td>{{$study->data_inicio}}</td>
                    <td>{{$study->data_fim}}</td>
                    <td>{{$study->id_categoria}}</td>

                    <td><a href="{{route('study.show', $study->id)}}" type="button" class="btn btn-dark">Ver/Editar</a></td>
                    <td><a href="{{route('study.delete', $study->id)}}" type="button" class="btn btn-dark">Delete</a></td>
                  </tr>
              @endforeach
              @endif
          </tbody>
        </table>
        <div class="mt-3">
        </div>

    </div>
</div>
