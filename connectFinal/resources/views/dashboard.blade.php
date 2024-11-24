<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerencie suas atividades') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card de Estágio -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-start">
                        <h3 class="text-sm font-semibold text-gray-600">Publicação - VAGAS DE ESTÁGIOS </h3> 
                        <a href="{{ route('post.index') }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Editar
            </a>
                    </div>
                    
                    <p class="text-gray-900">Insira as informações da nova vaga para publicá-la no portal</p>
                </div>

                <!-- Card de Eventos-->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-start">
                        <h3 class="text-sm font-semibold text-gray-600">Publicação - Eventos</h3>
                        <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Editar
                        </button>
                    </div>
                    <p class="text-gray-900">Lançe ou edite os eventos no portal</p>
                </div>

                <!-- Card de Notícias-->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-start">
                        <h3 class="text-sm font-semibold text-gray-600">Publicação - Notícias</h3>
                        <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Editar
                        </button>
                    </div>
                    <p class="text-gray-900">Selecione uma categoria para iniciar a publicação de notícias</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mt-6 relative">
                <h3 class="text-xl font-semibold">Cadastro de usuários</h3>
                
                <h1>Admin <span>(3)</span> user (10)</h1>
                <a 
    href="{{ route('users.index') }}" 
    class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 absolute top-2 right-2"
        >
    Exibir usuários
</a>
                
                <canvas class="mt-4"></canvas>

                <p class="text-gray-900 mt-4">
                    Como administrador, você pode gerenciar a criação de novos usuários para sua plataforma. <br> 
                    Clique no botão "Adicionar Novo" para começar a cadastrar novos usuários. <br>
                    <strong>Dica:</strong> Certifique-se de preencher todas as informações necessárias para garantir que o usuário tenha acesso correto aos recursos.
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
                <h3 class="text-xl font-semibold">Últimas mensagens</h3>
            </div>
        </div>
    </div>



 </x-app-layout>