@extends('sidebar.index_sidebar')
@section('contentForYou')



<div class="loginBody" style="
        background-image: url('{{ asset('images/disc.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center; margin-top:50px">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="col-xxl-7 col-xl-7 col-lg-5 col-md-7 col-sm-9">
            <div class="card">
                <div class="card-body">
                    <h4 style="text-align:center">Aqui vais {{isset($user) ? 'atualizar' : 'adicionar'}} o seu perfil</h4>
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ isset($user) ? route('edit_user.create') : route('edit_user.create') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="hidden" name="email" value="{{ $user->email }}"> <!-- Campo oculto para email -->
                        <input type="hidden" name="user_type" value="{{ $user->user_type }}"> <!-- Campo oculto para user_type -->

                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    @if(isset($user) && $user->photo)
                                        <div>
                                            <p>Imagem atual:</p>
                                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Imagem do Álbum" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    @else
                                        <p>Nenhuma foto carregada.</p>
                                    @endif
                                    <input type="file" name="photo" accept="image/*" class="form-control">
                                    <small class="form-text text-muted">Se desejar atualizar a imagem, escolha um novo arquivo. Caso contrário, a imagem atual será mantida.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Seu nome</label>
                                    <input value="{{ isset($user) ? $user->name : '' }}" name="name" type="text" class="form-control" id="exampleFormControlInput1">
                                    @error('name')
                                        <div class="text-danger">Nome inválido!</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Data de Nascimento</label>
                                    <input value="{{ isset($user) ? $user->data_nascimento : '' }}" name="data_nascimento" type="date" class="form-control" id="exampleFormControlInput1">
                                    @error('data_nascimento')
                                        <div class="text-danger">Data inválida!</div>
                                    @enderror
                                </div>
                                <div>
                                    <select class="custom-select" name="id_curso">
                                        <option value="">Selecione o curso</option>
                                        @foreach ($curso as $curso)
                                            <option value="{{ $curso->id }}">
                                                {{ $curso->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nif:</label>
                                        <input value="{{ isset($user) ? $user->nif : '' }}" name="nif" type="text" class="form-control" id="exampleFormControlInput1">
                                        @error('nif')
                                            <div class="text-danger">nif inválido!</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Formação:</label>
                                        <input value="{{ isset($user) ? $user->formacao : '' }}" name="formacao" type="text" class="form-control" id="exampleFormControlInput1">
                                        @error('formacao')
                                            <div class="text-danger">formacao inválido!</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3"><label for="exampleFormControlInput1" class="form-label">Linkedin:</label>
                                        <input value="{{ isset($user) ? $user->linkedin : '' }}" name="linkedin" type="text" class="form-control" id="exampleFormControlInput1">
                                        @error('linkedin')
                                            <div class="text-danger">linkedin inválido!</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">GitHub:</label>
                                        <input value="{{ isset($user) ? $user->github : '' }}" name="github" type="text" class="form-control" id="exampleFormControlInput1">
                                        @error('github')
                                            <div class="text-danger">github inválido!</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">endereco:</label>
                                        <input value="{{ isset($user) ? $user->endereco : '' }}" name="endereco" type="text" class="form-control" id="exampleFormControlInput1">
                                        @error('endereco')
                                            <div class="text-danger">endereco inválido!</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">telefone:</label>
                                        <input value="{{ isset($user) ? $user->telefone : '' }}" name="telefone" type="text" class="form-control" id="exampleFormControlInput1">
                                        @error('telefone')
                                            <div class="text-danger">telefone inválido!</div>
                                        @enderror
                                    </div>
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
