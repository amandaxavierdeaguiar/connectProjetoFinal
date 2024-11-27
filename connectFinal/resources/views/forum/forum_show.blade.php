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

<div class="container">
    <div class="post-card">
        <h2>Criar Novo Post no Fórum</h2>

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

            <div class="form-row">
                <div class="form-group">
                    <label for="titulo">Título do Post:</label>
                    <input type="text" name="titulo" class="form-control" id="titulo" value="{{ isset($posts) ? $posts->titulo : '' }}" required>
                    @error('titulo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_categoria">Categoria:</label>
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
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="descricao">Descrição do Post:</label>
                    <textarea name="descricao" class="form-control" id="descricao" rows="4" required>{{ isset($posts) ? $posts->descricao : '' }}</textarea>
                    @error('descricao')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_linguagem">Linguagem:</label>
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
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="post_type">Tipo de Post:</label>
                    <input type="text" name="post_type" class="form-control" id="post_type" value="Fórum" readonly required>
                    @error('post_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto">Imagem:</label>
                    <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                    <small class="form-text text-muted">Se desejar atualizar a imagem, escolha um novo arquivo. Caso contrário, a imagem atual será mantida.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Post</button>
        </form>
    </div>
</div>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.post-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%;
    max-width: 800px;
}

h2 {
    text-align: center;
    color: #333;
}

.form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-group {
    flex: 1;
    margin-right: 10px;
}

.form-group:last-child {
    margin-right: 0;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="file"],
select,
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

textarea {
    resize: none;
}

.btn {
    background: #480355;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

.btn:hover {
    background-color: #0056b3;
}
</style>
@endsection
