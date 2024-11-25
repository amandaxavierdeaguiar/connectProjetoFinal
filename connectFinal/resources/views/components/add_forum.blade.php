<style>
    .modal {
    display: none; /* Escondido por padrão */
    position: fixed; /* Fica fixo na tela */
    z-index: 1; /* Fica acima de outros elementos */
    left: 0;
    top: 0;
    width: 100%; /* Largura total */
    height: 100%; /* Altura total */
    overflow: auto; /* Habilita rolagem se necessário */
    background-color: rgb(0,0,0); /* Cor de fundo */
    background-color: rgba(0,0,0,0.4); /* Fundo preto com opacidade */
    color:black;
    margin-right: 0;
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% do topo e centralizado */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Largura do modal */
}

.close {
    color: #aaa;
    float: right;
    float: right;
    margin-left: 10px;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.nameUserModal{
    font-size: 1rem;
    font-family: 'Montserrat', sans-serif;
    font-weight:600;
    color: rgb(80, 0, 42);
    }
.userPhotoModal{
    margin-right: 1rem;
}

#descricaoModal{
    margin-top: 15px;
}

.language {
        display: inline;
        margin-right: 10px;
        cursor: pointer; /* Indica que é clicável */
    }
    .selected {
        font-weight: bold; /* Destaque a linguagem selecionada */
        color: rgb(80, 0, 42); /* Muda a cor da linguagem selecionada */
    }
    .custom-button {
    width: auto; /* Ou uma largura específica como 150px */
    margin: 10px; /* Para adicionar alguma margem */
}
</style>

<!-- Modal -->
<div id="{{ $modalId }}" class="modal">
    <div class="modal-content">
        <div class="modal-header" style="display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center;">
                <img class="userPhotoModal" width="30px" height="30px"
                src="{{$users->photo ? asset('storage/' . $users->photo) : asset('images/default-profile.png') }}"
                style="display: inline-block; vertical-align: middle; margin-right: 10px;">
                <div style="display: flex; flex-direction: column;">
                    <p class='nameUserModal' style="margin: 0;">{{$users->name}}</p>
                    <p class='jobUser ' style="margin: 0;">{{$users->formacao}}</p>
                </div>
            </div>
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Digite o título" value="{{ old('titulo') }}" required style="flex: 1; margin: 0 10px;">
                <span class="close" style="cursor: pointer;">&times;</span>
        </div>

        {{-- <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf --}}
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('images/post-default.png') }}" alt="Avatar" class="img-fit border mb-3" style="width: 200px; height: 200px; margin:1rem">
                    <label class="btn btn-outline-primary" style="margin:1rem;width: 200px;">
                        <input type="file" name="foto" id="foto" class="d-none" accept="image/*" onchange="previewPhoto(event)">
                        Selecionar Foto
                    </label>
                </div>
                <div class="col-md-8">
                    <div class="mb-6">
                        <textarea name="descricao" id="descricaoModal" placeholder="Digite sua mensagem" class="form-control" rows="9" required>{{ old('descricao') }}</textarea>
                        {{-- @foreach ($linguages as $linguagem)
                            <label>
                                <input type="checkbox" name="linguagem" value="{{ $linguagem->id }}">
                                    #{{ $linguagem->name }}
                                </label><br>
                        @endforeach --}}
                    </div>
                    <div id="language-container">
                        @foreach ($linguages as $linguagem)
                            <p class="language" onclick="selectLanguage(this)">
                                #{{ $linguagem->name }}
                            </p>
                        @endforeach
                    </div>

                    <div id="categoria-container" style="display: flex; align-items: center;">
                        <p  style="margin-right: 10px;">Selecione a categoria: </p>
                        @foreach ($categoria as $category)
                        <p class="categoria" onclick="selectCategory(this)" style="margin-right: 5px;">
                            #{{ $category->nome }}
                        </p>
                        @endforeach
                    </div>
                </div>
                </div>
                <button type="submit" class="btn btn-dark custom-button">Postar</button>
            </form>
        {{-- <button id="saveChanges">Salvar alterações</button> --}}
    </div>
</div>

<script>
    // Função para fechar o modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Adiciona eventos de clique para fechar o modal
    document.querySelectorAll('.close').forEach(function(button) {
        button.onclick = function() {
            closeModal('{{ $modalId }}');
        }
    });

    // Fecha o modal se o usuário clicar fora dele
    window.onclick = function(event) {
        var modal = document.getElementById('{{ $modalId }}');
        if (event.target == modal) {
            closeModal('{{ $modalId }}');
        }
    }




    function selectLanguage(element) {
        // Remove a classe 'selected' de todos os elementos
        var languages = document.querySelectorAll('.language');
        languages.forEach(function(lang) {
            lang.classList.remove('selected');
        });

        // Adiciona a classe 'selected' ao elemento clicado
        element.classList.add('selected');

        // Aqui você pode adicionar lógica para armazenar a linguagem selecionada, se necessário
        console.log('Linguagem selecionada:', element.textContent);
    }

    function selectCategory(element) {
        // Remove a classe 'selected' de todos os elementos
        var category = document.querySelectorAll('.categoria');
        category.forEach(function(category) {
            category.classList.remove('selected');
        });

        // Adiciona a classe 'selected' ao elemento clicado
        element.classList.add('selected');

        // Aqui você pode adicionar lógica para armazenar a linguagem selecionada, se necessário
        console.log('Categoria selecionada:', element.textContent);
    }



</script>

{{-- <script>
    // Obtém o modal
    var modal = document.getElementById("myModal");

    // Obtém o botão que abre o modal
    var btn = document.getElementById("openModal");

    // Obtém o elemento <span> que fecha o modal
    var span = document.getElementsByClassName("close")[0];

    // Quando o usuário clica no botão, abre o modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Quando o usuário clica em <span> (x), fecha o modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Quando o usuário clica fora do modal, fecha o modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script> --}}


