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
              <th scope="col"> </th> <!--Botao Ver/editar-->
              <th scope="col"> </th> <!--Botao Apagar - Apenas adm -->
            </tr>
          </thead>
          <tbody>
            @if(isset($language) && count($language) > 0)
              @foreach ($language as $lin)
                  <tr>
                      {{-- <th scope="row">{{$album->id}}</th> --}}
                      <td><img width="30px" height="30px"
                          src="{{$lin->foto ? asset('storage/' . $lin->foto) : asset('images/nophoto.jpg') }}">
                      </td>
                      <td>{{$lin->name}}</td>

                      <td><a href="{{route('language.show', $lin->id)}}" type="button" class="btn btn-dark">Ver/Editar</a></td>
                            <td><a href="{{route('language.delete', $lin->id)}}" type="button" class="btn btn-dark">Delete</a></td>
                  </tr>
              @endforeach
              @endif
          </tbody>
        </table>
        <div class="mt-3">
        </div>

    </div>
</div>
