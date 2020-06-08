@extends('adminlte::page')

@section('title', "Perfis")

@section('content_header')
<a href="{{ route('profiles.create') }}" class="btn btn-dark btn-block">
    Adicionar Perfil <i class="fas fa-plus-square"></i>
</a>
<div class="container">
    

    <h1>
        Perfis  
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>
</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('profiles.search') }}" method="POST" class="form form-inline">
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
                      
                        <th style="width:270px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                    <tr>
                        <td>{{$profile->name}}</td>                    
                        <td style="width:150px;">
                            <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-warning">Ver</a>
                            <a href="{{ route('profiles.permissions', $profile->id) }}" class="btn btn-info">
                                <i class="fas fa-lock"></i>
                            </a>
                            <a href="{{ route('profiles.plans', $profile->id) }}" class="btn btn-info">
                                <i class="fas fa-list-alt"></i>
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
            

        </div>
    </div>
@endsection