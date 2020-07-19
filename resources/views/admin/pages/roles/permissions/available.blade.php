@extends('adminlte::page')

@section('title', "Permissões do perfil ")

@section('content_header')

<div class="container">
    

    {{-- <h1>
        Permissões do perfil <b> {{ $profile->name }} </b>
        <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark">Adicionar Nova Permissão</a>
    </h1>  --}}

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>

    <br>
    <h1>Permissões disponíveis perfil <strong>{{ $profile->name }}</strong></h1>

</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="POST" class="form form-inline">
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
                    <form action="{{ route('profiles.permissions.attach', $profile->id) }}" method="POST">
                        @csrf
                        @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                            </td>                       
                            <td>{{$permission->name}}</td>                       
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
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif
            

        </div>
    </div>
@endsection