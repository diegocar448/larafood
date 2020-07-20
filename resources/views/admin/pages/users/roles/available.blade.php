@extends('adminlte::page')

@section('title', "Cargos disponiveis Cargo ")

@section('content_header')

<div class="container">
    

    {{-- <h1>
        Cargos do perfil <b> {{ $role->name }} </b>
        <a href="{{ route('roles.roles.available', $role->id) }}" class="btn btn-dark">Adicionar Nova Permissão</a>
    </h1>  --}}

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuários</a></li>
    </ol>

    <br>
    <h1>Cargos disponíveis perfil <strong>{{ $user->name }}</strong></h1>

</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('users.roles.available', $user->id) }}" method="POST" class="form form-inline">
                @csrf                
                <input type="text" name="filter" placeholder="Busca" class="form-control" value="{{ $filters["filter"] ?? ''}}">
                <button type="submit" class="btn btn-dark">Buscar</button>                
            </form>
            <br>
            @if (session('sucesso'))
                    <div class="alert alert-success">
                        {{ session('sucesso') }}
                    </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="cardy-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>                                              
                        <th>Nome</th>                                              
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('users.roles.attach', $user->id) }}" method="POST">
                        @csrf
                        @foreach($roles as $role)
                        <tr>
                            <td>
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                            </td>                       
                            <td>{{$role->name}}</td>                       
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="500">
                                <button class="btn btn-success btn-block" type="submit">Vincular</button>
                            </td>
                        </tr>
                    </form> 
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $roles->appends($filters)->links() !!}
            @else
                {!! $roles->links() !!}
            @endif
            

        </div>
    </div>
@endsection