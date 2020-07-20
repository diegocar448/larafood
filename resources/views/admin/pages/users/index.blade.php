@extends('adminlte::page')

@section('title', "Usuários")

@section('content_header')
<a href="{{ route('users.create') }}" class="btn btn-dark btn-block">
    Adicionar registro <i class="fas fa-plus-square"></i>
</a>
<div class="container">
    

    <h1>
        Usuários     
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuários</a></li>
    </ol>
</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('users.search') }}" method="POST" class="form form-inline">
                @csrf                
                <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{old('filter')}}">
                <button type="submit" class="btn btn-dark">Buscar</button>                
            </form>
        </div>
        <div class="cardy-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th style="width:290px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td style="width:150px;">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">Ver</a>                            
                            <a href="{{ route('users.roles', $user->id) }}" class="btn btn-info" title="Cargos">
                                <i class="fas fa-address-card"></i> Cargos
                            </a>                            
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif
            

        </div>
    </div>
@endsection