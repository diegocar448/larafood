@extends('adminlte::page')

@section('title', "Detalhes do Cargo {$role->name}")

@section('content_header')
<div class="container">
    <h1>Detalhes do Cargo <b>{{ $role->name }}</b></h1> 
</div>
@stop

@section("content")
    <div class="card">
        <div class="card-body">        

            <ul>
                <li>
                    <strong> Nome </strong> {{ $role->name }}
                </li>            
                <li>
                    <strong> Descrição </strong> {{ $role->description }}
                </li>
            </ul>

            <form action="{{ route("roles.destroy", $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover o Cargo" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection