<div class="container">
    <div class="row border-bottom pb-3 mb-3">
        {{-- @if($userProfile->isEmpty())
            <p style="color: black">Não há nada para mostrar.</p>
        @else --}}
            <h1>Informações do Usuário</h1>
            @foreach ($userProfile as $user)
                <li>{{$user}}</li>
            @endforeach
                {{-- <div class="card mb-3">
                    <div class="card-header">
                        Detalhes do Usuário
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">{{ $user->name }}</li>
                            <li class="list-group-item">{{ $user->nif ?? 'Não informado' }}</li>
                            <li class="list-group-item">
                                @if($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto do Usuário" style="max-width: 150px; max-height: 150px;">
                                @else
                                    Não informado
                                @endif
                            </li>
                            <li class="list-group-item">{{ $user->linkedin ?? 'Não informado' }}</li>
                            <li class="list-group-item">{{ $user->github ?? 'Não informado' }}</li>
                            <li class="list-group-item">{{ $user->formacao ?? 'Não informado' }}</li>
                            <li class="list-group-item"> {{ $user->data_nascimento ? ($user->data_nascimento)->format('d/m/Y') : 'Não informado' }}</li>
                            <li class="list-group-item">{{ $user->endereco ?? 'Não informado' }}</li>
                            <li class="list-group-item"> {{ $user->telefone ?? 'Não informado' }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach --}}
    </div>
</div>
