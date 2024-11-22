<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Novo Usuário') }}
        </h2>
    </x-slot>

    <div class="container mt-5" style="width: 40%; max-width: 400px;">


    <h2>Criar Novo Curso</h2>

    <!-- Steps -->
    <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="steps-container">
                <ul class="steps d-flex list-unstyled justify-content-center align-items-center">
                    <li class="step active">
                        <span class="step-circle">1</span>
                        <p class="step-label">Dados Pessoais</p>
                    </li>
                    <li class="step-separator">
                        <i class="fas fa-chevron-right"></i>
                    </li>
                    <li class="step">
                        <span class="step-circle">2</span>
                        <p class="step-label">Dados Profissionais</p>
                    </li>
                    <li class="step-separator">
                        <i class="fas fa-chevron-right"></i>
                    </li>
                    <li class="step">
                        <span class="step-circle">3</span>
                        <p class="step-label">Finalização</p>
                    </li>
                </ul>
            </div>
        </div>

    <!-- Formulário Multi-Step -->
    <div class="card shadow rounded p-4">
            <!-- Passo 1 -->
    <div id="step-1" class="form-step">
                <h4 class="text-center mb-4">Passo 1: Dados Pessoais</h4>

                <!-- Avatar -->
                <div class="d-flex flex-column align-items-center mb-4">
                    <img id="photoPreview" 
                         src="{{ asset('images/default-profile.png') }}" 
                         alt="Avatar"
                         class="img-fit rounded-circle border mb-3" 
                         style="width: 120px; height: 120px;">
                    <label class="btn btn-outline-primary">
                        <input type="file" name="photo" id="photo" class="d-none" accept="image/*" onchange="previewPhoto(event)">
                        Selecionar Foto
                    </label>
                </div>

    <form id="multiStepForm" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nif" class="form-label">NIF:</label>
            <input type="text" id="nif" name="nif" class="form-control">
        </div>

        <div class="text-center">
         <button type="button" class="btn btn-primary" id="nextBtn">Próximo</button>
        </div>
    
</div>

        <!-- <div class="mb-3">
            <label for="photo" class="form-label">Foto:</label>
            <input type="file" id="photo" name="photo" class="form-control">
        </div> -->
<div id="step-2" class="form-step d-none">
            <h4 class="text-center mb-4">Passo 2: Dados Profissionais</h4>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control">
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço:</label>
            <input type="text" id="endereco" name="endereco" class="form-control">
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" id="telefone" name="telefone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="user_type" class="form-label">Tipo de Usuário:</label>
            <select id="user_type" name="user_type" class="form-select">
                <option value="1">Usuário Comum</option>
                <option value="0">Administrador</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_curso" class="form-label">Curso:</label>
            <select id="id_curso" name="id_curso" class="form-select">
                <option value="">Selecione um curso</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                @endforeach
            </select>
    </div>
    <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-primary" id="prevBtn">Voltar</button>
                    <button type="button" class="btn btn-primary" id="nextBtnStep2">Próximo</button>
                </div>

</div>

 <!-- Passo 3 -->
 <div id="step-3" class="form-step d-none">
                <h4 class="text-center mb-4">Passo 3: Finalização</h4>
                <p class="text-center">Revise as informações e clique em "Criar Usuário" para finalizar.</p>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-primary" id="prevBtnStep3">Voltar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
        
        
            </div>
            </form>
    </div>
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
            background-color: #dee2e6; /* Cinza padrão */
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #6c757d;
        }

        .active .step-circle {
            background-color: #6f42c1; /* Roxo */
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
    width: 100%; /* Largura total do container */
    height: 100%; /* Altura total do container */
    object-fit: cover; /* Ajusta a imagem sem distorcer */
    border-radius: 50%; /* Para manter formato circular */
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

            reader.onload = function (e) {
                document.getElementById('photoPreview').src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
