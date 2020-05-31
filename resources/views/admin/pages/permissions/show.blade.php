@extends('adminlte::page')

@section('title', "Detalhes do Permissão {$permission->name}")

@section('content_header')
<div class="container">
    <h1>Detalhes da Permissão <b>{{ $permission->name }}</b></h1> 
</div>
@stop

@section("content")
    <div class="card">
        <div class="card-body">        

            <ul>
                <li>
                    <strong> Nome </strong> {{ $permission->name }}
                </li>            
                <li>
                    <strong> Descrição </strong> {{ $permission->description }}
                </li>
            </ul>

            <form action="{{ route("permissions.destroy", $permission->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover o Perfil" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection