<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="container mx-auto mt-8">
    <!-- Botão para adicionar novo usuário -->
    <div class="mb-4">
        <a href="{{ route('users.create') }}">
            <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Adicionar novo usuário
            </button>
        </a>
    </div>

    <!-- Tabela de usuários -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Gerenciar Usuários</h2>
        <table class="min-w-full table-auto">
            <thead>
                <tr class="text-left">
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">NIF</th>
                    <th class="px-4 py-2">Foto</th>
                    <th class="px-4 py-2">Data de Nascimento</th>
                    <th class="px-4 py-2">Endereço</th>
                    <th class="px-4 py-2">Telefone</th>
                    <th class="px-4 py-2">Curso</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->nif }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ $user->photo }}" alt="Foto" class="w-12 h-12 rounded-full">
                        </td>
                        <td class="px-4 py-2">{{ $user->data_nascimento }}</td>
                        <td class="px-4 py-2">{{ $user->endereco }}</td>
                        <td class="px-4 py-2">{{ $user->telefone }}</td>
                        <td class="px-4 py-2">{{ $user->curso ? $user->curso->name : 'N/A' }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <!-- Botão de edição -->
                            <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                <i class="fas fa-pencil-alt"></i> Editar
                            </a>
                            <!-- Botão de exclusão -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i> Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    

</x-app-layout>