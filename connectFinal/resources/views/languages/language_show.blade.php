@extends('layout.index')
@section('content')
<div>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="col-xxl-7 col-xl-7 col-lg-5 col-md-7 col-sm-9">
            <div class="card">
                <div class="card-body">
                    <h4 style="text-align:center">Aqui vais {{isset($language) ? 'atualizar' : 'adicionar'}} as Linguagens</h4>

                    <form method="POST" action="{{ isset($language) ? route('language.create') : route('language.create') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($language))
                            <input type="hidden" value="{{$language->id}}" name="id">
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    @if(isset($language) && $language->foto)
                                        <div>
                                            <p>Imagem atual:</p>
                                            <img src="{{ asset('storage/' . $language->foto) }}" alt="Imagem do Álbum" style="max-width: 200px; max-height: 200px;">
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
                                    <label for="exampleFormControlInput1" class="form-label">Nome da Linguagem</label>
                                    <input value="{{ isset($language) ? $language->name : '' }}" name="name" required type="text" class="form-control" id="exampleFormControlInput1">
                                    @error('name')
                                        <div class="text-danger">Nome da Linguagem inválida!</div>
                                    @enderror
                                </div>

                                <div>
                                    <select class="custom-select" name="id_categoria">
                                        <option value="">Selecione a Categoria</option>
                                        @foreach ($categoria as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <label for="">Id Banda</label>
                                    <input value="{{ isset($album) ? $album->band_id : '' }}" name="band_id" required type="number" class="form-control" id="exampleFormControlInput1"> --}}
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
@endsection
