@extends('adminlte::page')

@section('title', "Perfis das permissão ")

@section('content_header')

<div class="container">
    

    <h1>
        Perfis das permissão <b> {{ $permission->name }} </b>        
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.index') }}">Perfis</a></li>
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
                        <th style="width:250px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                    <tr>
                        <td>{{$profile->name}}</td>                    
                        <td style="width:150px;">
                            {{-- <a href="{{ route('profiles.permissions.detach', $profile->id) }}" class="btn btn-info">Editar</a>                            --}}
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