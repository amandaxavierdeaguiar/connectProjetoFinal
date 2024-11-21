@extends('layout.index')
@section('content')

{{-- <form action="{{ route('wish.create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="linguagens">Selecione as Linguagens</label>
        <select class="custom-select" name="linguagem[]" id="linguagens" multiple>
            @foreach ($linguages as $linguage)
                <option value="{{ $linguage->id }}">
                    {{ $linguage->name }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-muted">Segure a tecla Ctrl (Windows) ou Command (Mac) para selecionar múltiplas opções.</small>
    </div>
    <input type="hidden" name="skill_type" value="desejo">
    <button type="submit" class="btn btn-primary">Submit</button>
</form> --}}
<div class="container">
    <h1>Cadastrar Desejos e Skills</h1>
    <form action="{{ route('wish.create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="linguagem">Escolha as Linguagens:</label>
            <select name="linguagem[]" id="linguagem" multiple required>
                @foreach($linguages as $linguagem)
                    <option value="{{ $linguagem->id }}">{{ $linguagem->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="skill_type">Tipo:</label>
            <select name="skill_type" id="skill_type" required>
                <option value="1">Skill</option>
                <option value="2">Desejo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

@endsection
