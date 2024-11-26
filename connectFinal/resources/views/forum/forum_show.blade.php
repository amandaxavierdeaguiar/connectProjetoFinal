@extends('sidebar.index_sidebar')
@section('contentForYou')

{{-- <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 100%; max-width: 600px;">
        <h2 class="text-center">Criar Novo Post no Fórum</h2>

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

        <form action="{{ isset($posts) ? route('forum.create') : route('forum.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($posts))
                <input type="hidden" name="id" value="{{ $posts->id }}">
            @endif

            <div class="mb-3">
                <label for="titulo" class="form-label">Título do Post:</label>
                <input type="text" name="titulo" class="form-control" id="titulo" value="{{ isset($posts) ? $posts->titulo : '' }}" required>
                @error('titulo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição do Post:</label>
                <textarea name="descricao" class="form-control" id="descricao" rows="4" required>{{ isset($posts) ? $posts->descricao : '' }}</textarea>
                @error('descricao')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="post_type" class="form-label">Tipo de Post:</label>
                <input type="text" name="post_type" class="form-control" id="post_type" value="Fórum" readonly required>
                @error('post_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoria:</label>
                <select name="id_categoria" class="form-select" id="id_categoria" required>
                    <option value="">Selecione uma categoria</option>
                    @foreach($categoria as $categoria)
                        <option value="{{ $categoria->id }}" {{ (isset($posts) && $posts->id_categoria == $categoria->id) ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
                @error('id_categoria')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_linguagem" class="form-label">Linguagem:</label>
                <select name="id_linguagem" class="form-select" id="id_linguagem" required>
                    <option value="">Selecione uma linguagem</option>
                    @foreach($linguagem as $linguagem)
                        <option value="{{ $linguagem->id }}" {{ (isset($posts) && $posts->id_linguagem == $linguagem->id) ? 'selected' : '' }}>
                            {{ $linguagem->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_linguagem')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Imagem:</label>
                <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                <small class="form-text text-muted">Se desejar atualizar a imagem, escolha um novo arquivo. Caso contrário, a imagem atual será mantida.</small>
            </div>



            <button type="submit" class="btn btn-primary">Salvar Post</button>
        </form>
    </div>
</div> --}}

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 100%; max-width: 600px;">
        <h2 class="text-center">Criar Novo Post no Fórum</h2>

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

        <form action="{{ isset($posts) ? route('forum.create') : route('forum.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($posts))
                <input type="hidden" name="id" value="{{ $posts->id }}">
            @endif

            <div class="mb-3">
                <label for="titulo" class="form-label">Título do Post:</label>
                <input type="text" name="titulo" class="form-control" id="titulo" value="{{ isset($posts) ? $posts->titulo : '' }}" required>
                @error('titulo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição do Post:</label>
                <textarea name="descricao" class="form-control" id="descricao" rows="4" required>{{ isset($posts) ? $posts->descricao : '' }}</textarea>
                @error('descricao')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="post_type" class="form-label">Tipo de Post:</label>
                <input type="text" name="post_type" class="form-control" id="post_type" value="Fórum" readonly required>
                @error('post_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoria:</label>
                <select name="id_categoria" class="form-select" id="id_categoria" required>
                    <option value="">Selecione uma categoria</option>
                    @foreach($categoria as $categoria)
                        <option value="{{ $categoria->id }}" {{ (isset($posts) && $posts->id_categoria == $categoria->id) ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
                @error('id_categoria')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_linguagem" class="form-label">Linguagem:</label>
                <select name="id_linguagem" class="form-select" id="id_linguagem" required>
                    <option value="">Selecione uma linguagem</option>
                    @foreach($linguagem as $linguagem)
                        <option value="{{ $linguagem->id }}" {{ (isset($posts) && $posts->id_linguagem == $linguagem->id) ? 'selected' : '' }}>
                            {{ $linguagem->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_linguagem')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Imagem:</label>
                <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                <small class="form-text text-muted">Se desejar atualizar a imagem, escolha um novo arquivo. Caso contrário, a imagem atual será mantida.</small>
            </div>



            <button type="submit" class="btn btn-primary">Salvar Post</button>
        </form>
    </div>
</div>


@endsection
