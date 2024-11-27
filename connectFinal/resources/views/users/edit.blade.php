<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>

    <div class="container mt-5" style="width: 40%; max-width: 400px;">
      


        <!-- Steps -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="steps-container">
                <ul class="steps d-flex list-unstyled justify-content-center  gap-2 align-items-center">
                    <li class="step active">
                        <span class="step-circle">1</span>
                      
                    </li>
                    <li class="step-separator">
                      
                    </li>
                    <li class="step">
                        <span class="step-circle">2</span>
                     
                    </li>
                    <li class="step-separator">
                     
                    </li>
                    <li class="step">
                        <span class="step-circle">3</span>
                      
                    </li>
                </ul>
            </div>
        </div>


        <!-- Formulário Multi-Step -->

          <!-- Formulário Multi-Step -->
          <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="card shadow rounded p-4">
            <!-- Passo 1 -->
            <div id="step-1" class="form-step">
              

                <!-- Avatar -->

                <div class="d-flex flex-column align-items-center mb-4">
                    <img   id="photoPreview"
                     src="{{ $user->photo ? asset('storage/' . $user->photo) :asset('images/default-profile.png')  }}"
                     alt="Foto do Usuário"
                     class="w-20 h-20 rounded-full mb-2"

                        alt="Avatar"
                        class="img-fit rounded-circle border mb-3"
                        style="width: 120px; height: 120px;">
                    <label class="btn btn-outline-primary">
                        <input type="file" name="photo" id="photo" class="d-none" accept="image/*" onchange="previewPhoto(event)">
                        Selecionar Foto
                    </label>
                </div>




                


                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>


                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>


                    <div class="mb-4">
                        <label for="nif" class="block text-sm font-medium text-gray-700">NIF</label>
                        <input type="text" name="nif" id="nif" value="{{ old('nif', $user->nif) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="nextBtn">Próximo</button>
                    </div>

            </div>

            <div id="step-2" class="form-step d-none">

                <div class="mb-4">
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento', $user->data_nascimento) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>


                <div class="mb-4">
                    <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                    <input type="endereco" name="endereco" id="endereco" value="{{ old('endereco', $user->endereco) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>



                <div class="mb-4">
                    <label for="telefone" class="block text-sm font-medium text-gray-700">telefone</label>
                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $user->telefone) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>

                
                

                <div class="mb-4">
    <label for="user_type" class="block text-sm font-medium text-gray-700">Tipo de Usuário</label>
    <select name="user_type" id="user_type" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        <option value="1" {{ old('user_type', $user->user_type) == 1 ? 'selected' : '' }}>Usuário Comum</option>
        <option value="2" {{ old('user_type', $user->user_type) == 2 ? 'selected' : '' }}>Administrador</option>
    </select>
</div>
               

                <div class="mb-3">
                    <label for="id_curso" class="form-label">Curso:</label>
                    <select id="id_curso" name="id_curso" class="form-select">
                        <option value="">Selecione um curso</option>
                        @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}"
                            {{ old('curso', $user->curso) == $curso->id ? 'selected' : '' }}>
                            {{ $curso->nome }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-primary" id="prevBtn">Voltar</button>
                    <button type="button" class="btn btn-primary" id="nextBtnStep2">Próximo</button>
                </div>

                </div>
               

          



            <!-- Curso
                <div class="mb-4">
                    <label for="id_curso" class="block text-sm font-medium text-gray-700">Curso</label>
                    <select name="id_curso" id="id_curso" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Selecione um curso</option>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ $user->id_curso == $curso->id ? 'selected' : '' }}>
                                {{ $curso->name }}
                            </option>
                        @endforeach
                    </select>
                </div> -->

          
           <!-- Passo 3 -->


 <div id="step-3" class="form-step d-none">

 
 <div class="mb-4">
                    <label for="telefone" class="block text-sm font-medium text-gray-700">Linkedin</label>
                    <input type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', $user->linkedin) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="github" class="block text-sm font-medium text-gray-700">Github</label>
                    <input type="text" name="github" id="github" value="{{ old('github', $user->github) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="formacao" class="block text-sm font-medium text-gray-700">Formação</label>
                    <input type="text" name="formacao" id="formacao" value="{{ old('formacao', $user->formacao) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>

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