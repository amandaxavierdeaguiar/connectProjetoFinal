<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar postagem') }}
        </h2>
    </x-slot>

    <div class="container mt-5" style="width: 70%; max-width: 600px;">
        <h1>Editar Postagem</h1>

        <!-- Steps -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="steps-container">
                <ul class="steps d-flex list-unstyled justify-content-center align-items-center gap-2">
                    <li class="step active">
                        <span class="step-circle">1</span>
                    </li>
                    <li class="step">
                        <span class="step-circle">2</span>
                    </li>
                    <li class="step-separator"></li>
                    <li class="step">
                        <span class="step-circle">3</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Formulário Multi-Step -->
        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card shadow rounded p-4 mb-5">
                <!-- Passo 1 -->
                <div id="step-1" class="form-step">
                    <div class="d-flex flex-column align-items-center mb-4">
                        <img id="photoPreview"
                            src="{{ $post->foto ? asset('storage/' . $post->foto) : asset('images/default-post.png') }}"
                            alt="Avatar"
                            class="img-fit rounded-circle border mb-3"
                            style="width: 120px; height: 120px;">
                        <label class="btn btn-outline-primary">
                            <input type="file" name="foto" id="foto" class="d-none" accept="image/*" onchange="previewPhoto(event)">
                            Alterar Foto
                        </label>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                   

                    <select name="post_type" id="post_type" class="form-control mb-3" required>
                        <option value="" disabled>Selecione o tipo de postagem</option>
                        @foreach (App\Models\Post::$postTypes as $type)
                        <option value="{{ $type }}" {{ $type == $post->post_type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                        @endforeach
                    </select>

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $post->titulo }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea name="descricao" id="descricao" class="form-control" rows="4" required>{{ $post->descricao }}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="nextBtn">Próximo</button>
                    </div>
                </div>

                <!-- Passo 2 -->
                <div id="step-2" class="form-step d-none">
                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">Categoria</label>
                        <select name="id_categoria" id="id_categoria" class="form-control" required>
                            <option value="" disabled>Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $categoria->id == $post->id_categoria ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_linguagem" class="form-label">Linguagem</label>
                        <select name="id_linguagem" id="id_linguagem" class="form-control" required>
                            <option value="" disabled>Selecione uma linguagem</option>
                            @foreach ($linguagens as $linguagem)
                            <option value="{{ $linguagem->id }}" {{ $linguagem->id == $post->id_linguagem ? 'selected' : '' }}>
                                {{ $linguagem->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-outline-primary mb-3" id="prevBtn">Voltar</button>
                        <button type="button" class="btn btn-primary mb-3" id="nextBtnStep2">Próximo</button>
                    </div>
                </div>

                <!-- Passo 3 -->
                <div id="step-3" class="form-step d-none">
                    <h4 class="text-center mb-4">Passo 3: Finalização</h4>
                    <p class="text-center">Revise as informações e clique em "Atualizar Post" para finalizar.</p>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="button" class="btn btn-outline-primary" id="prevBtnStep3">Voltar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    </div>
    <style>
        .steps-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .steps {
            display: flex;
            align-items: center;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #dee2e6;
            /* Cinza padrão */
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #6c757d;
        }

        .active .step-circle {
            background-color: #6f42c1;
            /* Roxo */
            color: #fff;
        }

        .btn-primary {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        .btn-outline-primary:hover {
            background-color: #6f42c1;
            color: #fff;
        }


        .img-fit {
            width: 100%;
            /* Largura total do container */
            height: 100%;
            /* Altura total do container */
            object-fit: cover;
            /* Ajusta a imagem sem distorcer */
            border-radius: 50%;
            /* Para manter formato circular */
        }
    </style>

    <script>
        const steps = document.querySelectorAll('.form-step');
        const stepCircles = document.querySelectorAll('.step-circle');
        let currentStep = 0;

        function updateStepIndicator(step) {
            stepCircles.forEach((circle, index) => {
                if (index <= step) {
                    circle.parentNode.classList.add('active');
                } else {
                    circle.parentNode.classList.remove('active');
                }
            });
        }

        document.getElementById('nextBtn').addEventListener('click', () => {
            steps[currentStep].classList.add('d-none');
            currentStep++;
            steps[currentStep].classList.remove('d-none');
            updateStepIndicator(currentStep);
        });

        document.getElementById('nextBtnStep2').addEventListener('click', () => {
            steps[currentStep].classList.add('d-none');
            currentStep++;
            steps[currentStep].classList.remove('d-none');
            updateStepIndicator(currentStep);
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            steps[currentStep].classList.add('d-none');
            currentStep--;
            steps[currentStep].classList.remove('d-none');
            updateStepIndicator(currentStep);
        });

        document.getElementById('prevBtnStep3').addEventListener('click', () => {
            steps[currentStep].classList.add('d-none');
            currentStep--;
            steps[currentStep].classList.remove('d-none');
            updateStepIndicator(currentStep);
        });

        function previewPhoto(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('photoPreview').src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>