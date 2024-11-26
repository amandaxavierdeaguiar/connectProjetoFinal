<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Novo Usuário') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-5">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">Gerenciar Usuários</h1>
            <a href="{{ route('users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Novo Usuário
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Foto</th>
                    <th class="border border-gray-300 px-4 py-2">Nome</th>

                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">NIF</th>
                    <th class="border border-gray-300 px-4 py-2">Data de Nascimento</th>
                    <th class="border border-gray-300 px-4 py-2">Endereço</th>
                    <th class="border border-gray-300 px-4 py-2">Telefone</th>
                    <th class="border border-gray-300 px-4 py-2">Curso</th>
                    <th class="border border-gray-300 px-4 py-2">Tipo de usuário</th>
                    <th class="border border-gray-300 px-4 py-2">Formação</th>
                    <th class="border border-gray-300 px-4 py-2">LinkedIn</th>
                    <th class="border border-gray-300 px-4 py-2">GitHub</th>
                    <th class="border border-gray-300 px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                
                    <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>


                    <td class="border border-gray-300 px-4 py-2">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de {{ $user->name }}" class="w-12 h-12 rounded-full">
                        @else
                            <span class="text-gray-500">Sem Foto</span>
                        @endif
                    </td>
                    
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->nif ?? 'Não informado' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->data_nascimento ?? 'Não informado' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->endereco ?? 'Não informado' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->telefone ?? 'Não informado' }}</td>
                   
                    <td class="border border-gray-300 px-4 py-2">{{ $user->curso->name ?? 'Sem curso' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($user->user_type === 1)
                            Administrador
                        @elseif($user->user_type === 2)
                            Usuário Padrão
                        @else
                            Não definido
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->formacao ?? 'Não informado' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->linkedin ?? 'Não informado' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->github ?? 'Não informado' }}</td>
                    <td class="border border-gray-300 px-4 py-2 flex gap-2 justify-center">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
