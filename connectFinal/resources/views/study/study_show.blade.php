@extends('layout.index')
@section('content')
<div>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="col-xxl-7 col-xl-7 col-lg-5 col-md-7 col-sm-9">
            <div class="card">
                <div class="card-body">
                    <h4 style="text-align:center">Aqui vais {{isset($studies) ? 'atualizar' : 'adicionar'}} os Cursos </h4>

                    <form method="POST" action="{{ isset($studies) ? route('study.create') : route('study.create') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($studies))
                            <input type="hidden" value="{{$studies->id}}" name="id">
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    @if(isset($studies) && $studies->foto)
                                        <div>
                                            <p>Imagem atual:</p>
                                            <img src="{{ asset('storage/' . $studies->foto) }}" alt="Imagem do Curso" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    @else
                                        <p>Nenhuma foto carregada.</p>
                                    @endif
                                    <input type="file" name="foto" accept="image/*" class="form-control">
                                    <small class="form-text text-muted">Se desejar atualizar a imagem, escolha um novo arquivo. Caso contrário, a imagem atual será mantida.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nome do curso</label>

                                    <input value="{{ isset($studies) ? $studies->nome : '' }}" name="nome" required type="text" class="form-control" id="exampleFormControlInput1">
                                    @error('nome')
                                        <div class="text-danger">Nome do curso inválida!</div>
                                    @enderror
                            </div>

                            <div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                                    <input value="{{ isset($studies) ? $studies->descricao : '' }}" name="descricao" type="text" class="form-control" id="exampleFormControlInput1">
                                    @error('descricao')
                                        <div class="text-danger">Descricao inválida!</div>
                                    @enderror
                                </div>

                            <div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Quantidade de horas</label>
                                    <input value="{{ isset($studies) ? $studies->quantidade_horas : '' }}" name="quantidade_horas" type="number" class="form-control" id="exampleFormControlInput1">
                                    @error('quantidade_horas')
                                        <div class="text-danger">Quantidade de horas inválida!</div>
                                    @enderror
                            </div>

                            <div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Data inicio</label>
                                    <input value="{{ isset($studies) ? $studies->data_inicio : '' }}" name="data_inicio" type="date" class="form-control" id="exampleFormControlInput1">
                                    @error('data_inicio')
                                        <div class="text-danger">Data início inválida!</div>
                                    @enderror
                            </div>

                            <div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Data fim</label>
                                    <input value="{{ isset($studies) ? $studies->data_fim : '' }}" name="data_fim" type="date" class="form-control" id="exampleFormControlInput1">
                                    @error('data_fim')
                                        <div class="text-danger">Data fim inválida!</div>
                                    @enderror
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">id_categoria</label>
                                    <input value="{{ isset($studies) ? $studies->id_categoria : '' }}" name="id_categoria" type="number" class="form-control" id="exampleFormControlInput1">
                                    @error('id_categoria')
                                        <div class="text-danger">id_categoria inválida!</div>
                                    @enderror
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
@endsection
