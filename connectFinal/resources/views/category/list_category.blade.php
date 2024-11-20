@extends('layout.index')
@section('content')

<div class="loginBody">
    <div class="container flex-column d-flex justify-content-center align-items-center" style="height: 100%;">
        <table class="table">
        <thead>
            <tr>
              <th scope="col">Categoria</th>
              <th scope="col">Descrição</th>
              <th scope="col"> </th> <!--Botao Ver/editar-->
              <th scope="col"> </th> <!--Botao Apagar - Apenas adm -->
            </tr>
          </thead>
          <tbody>
            @if(isset($categories) && count($categories) > 0)
              @foreach ($categories as $category)
                  <tr>
                    <td>{{$category->nome}}</td>
                    <td>{{$category->descricao}}</td>
                    <td><a href="{{route('category.show', $category->id)}}" type="button" class="btn btn-dark">Ver/Editar</a></td>
                    <td><a href="{{route('category.delete', $category->id)}}" type="button" class="btn btn-dark">Delete</a></td>
                  </tr>
              @endforeach
            @endif
          </tbody>
        </table>
    </div>
</div>
@endsection




{{-- @extends('layout.index')
@section('content')

<div class="loginBody">
    <div class="container flex-column d-flex justify-content-center align-items-center" style="height: 100%;">
        <table class="table">
        <thead>
            <tr>
              <th scope="col">Categoria</th>
              <th scope="col">Descrição</th>
              <th scope="col"> </th>
              <th scope="col"> </th>
            </tr>
          </thead>
          <tbody>
            @if(isset($categories) && count($categories) > 0)
              @foreach ($categories as $category)
                  <tr>
                    <td>{{$category->nome}}</td>
                    <td>{{$category->descricao}}</td>
                    <td><a href="{{route('category.show', $category->id)}}" type="button" class="btn btn-dark">Ver/Editar</a></td>
                    <td><a href="{{route('category.delete', $category->id)}}" type="button" class="btn btn-dark">Delete</a></td>
                  </tr>
              @endforeach
              @endif
          </tbody>
        </table>
    </div>
</div>
@endsection --}}
