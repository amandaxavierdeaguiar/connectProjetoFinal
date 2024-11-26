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
                <span class="close" style="cursor: pointer; align-self: center;">&times;</span>
            </div>

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
                    <label for="post_type" class="form-label">post_type:</label>
                    <textarea name="post_type" class="form-control" id="post_type" rows="4" required>{{ isset($posts) ? $posts->post_type : '' }}</textarea>
                    @error('post_type')
                        <div class="text-danger">{{ $post_type }}</div>
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

            {{-- <form action="{{ route('post.forum.user.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Digite o título" required  style="margin: 0; width: 100%; text-align: center;">
                    <span class="close" style="cursor: pointer; align-self: center;">&times;</span>
                </div>

        </div>


            <div class="row">
                <div class="col-md-3">
                    <img id="previewImage" src="{{ asset('images/post-default.png') }}" alt="Avatar" class="img-fit border mb-3" style="width: 200px; height: 200px; margin:1rem">
                    <label class="btn btn-outline-primary" style="margin:1rem;width: 200px;">
                        <input type="file" name="foto" id="foto" class="d-none" accept="image/*" onchange="previewPhoto(event)">
                        Selecionar Foto
                    </label>
                </div>

                <div class="col-md-8">
                    <div class="mb-6">
                        <textarea name="descricao" id="descricaoModal" placeholder="Digite sua mensagem" class="form-control" rows="9" required>{{ old('descricao') }}</textarea>

                    </div>


                    <input type="hidden" name="id_linguagem" id="linguagem" value="">

                    <input type="hidden" name="id_categoria" id="categoria" value="">

                    <input type="hidden" name="post_type" value="Fórum">

                    <div id="linguagem-container">
                        @foreach ($linguages as $linguagem)
                            <p class="linguagem" onclick="selectLanguage(this)" data-id="{{ $linguagem->id }}">
                                #{{ $linguagem->name }}
                            </p>
                        @endforeach
                    </div>

                    <div id="categoria-container" style="display: flex; align-items: center;">
                        <p style="margin-right: 10px;">Selecione a categoria: </p>
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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}

        </form>
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
        var languages = document.querySelectorAll('.linguagem');
        languages.forEach(function(lang) {
            lang.classList.remove('selected');
        });

        // Adiciona a classe 'selected' ao elemento clicado
        element.classList.add('selected');

        var selectedLanguage = element.textContent.trim().replace('#', ''); // Remove o '#' do texto
        // var selectedLanguage = element.textContent.trim().replace('#', '');
        document.getElementById('linguagem').value = selectedLanguage;

        console.log('Linguagem selecionada:', selectedLanguage);

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

        // Atualiza o valor do campo oculto com a categoria selecionada
        var selectedCategory = element.textContent.trim().replace('#', ''); // Remove o '#' do texto
        document.getElementById('categoria').value = selectedCategory;

        console.log('Categoria selecionada:', selectedCategory);

        console.log('Categoria selecionada:', element.textContent);
    }

        function previewPhoto(event) {
        var input = event.target;
        var previewImage = document.getElementById('previewImage');

        // Verifica se um arquivo foi selecionado
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // Quando o arquivo for lido, define a imagem de visualização
            reader.onload = function(e) {
                previewImage.src = e.target.result; // Define a nova imagem
            }

            reader.readAsDataURL(input.files[0]); // Lê o arquivo como URL de dados
        }
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


