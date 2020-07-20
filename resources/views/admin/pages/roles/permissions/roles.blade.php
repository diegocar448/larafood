@extends('adminlte::page')

@section('title', "Permissões do Usuario ")

@section('content_header')

<div class="container">
    

    <h1>
        Cargo do Usuário <b> {{ $role->name }} </b>
        <a href="{{ route('users.roles.available', $role->id) }}" class="btn btn-dark">Adicionar Nova Permissão</a>
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuário</a></li>
    </ol>
</div>


@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('users.search') }}" method="POST" class="form form-inline">
                @csrf                
                <input type="text" name="filter" placeholder="Busca" class="form-control" value="{{ $filters["filter"] ?? ''}}">
                <button type="submit" class="btn btn-dark">Buscar</button>                
            </form>
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
                        <th>Nome</th>                      
                        <th style="width:50px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>                    
                        <td style="width:150px;">
                            <a href="{{ route('roles.user.detach', [$user->id, $role->id ]) }}" class="btn btn-danger">Desvincular</a>                           
                        </td>
                    </tr>
                    @endforeach 
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