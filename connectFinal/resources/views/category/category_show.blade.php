@extends('layout.index')
@section('content')

<div class="loginBody">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="col-xxl-7 col-xl-7 col-lg-5 col-md-7 col-sm-9">
            <div class="card">
                <div class="card-body">
                    <h4 style="text-align:center">Aqui vais {{isset($category) ? 'atualizar' : 'adicionar'}} as categorias</h4>

                    <form method="POST" action="{{ isset($category) ? route('category.create') : route('category.create') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category))
                            <input type="hidden" value="{{$category->id}}" name="id">
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nome da Categoria</label>
                                    <input value="{{ isset($category) ? $category->nome : '' }}" name="nome" required type="text" class="form-control" id="exampleFormControlInput1">
                                    @error('nome')
                                        <div class="text-danger">Nome da Categoria inválida!</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                                    <input value="{{ isset($category) ? $category->descricao : '' }}" name="descricao"  type="text" class="form-control" id="exampleFormControlInput1">
                                    {{-- @error('descricao')
                                        <div class="text-danger">Nome da Descricao inválida!</div>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit" class="btn btn-dark mt-3">Enviar</button>
                        </div>
                    </form>

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
