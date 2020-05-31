@extends('adminlte::page')

@section('title', "Detalhes do Perfil {$profile->name}")

@section('content_header')
<div class="container">
    <h1>Detalhes do Perfil <b>{{ $profile->name }}</b></h1> 
</div>
@stop

@section("content")
    <div class="card">
        <div class="card-body">        

            <ul>
                <li>
                    <strong> Nome </strong> {{ $profile->name }}
                </li>            
                <li>
                    <strong> Descrição </strong> {{ $profile->description }}
                </li>
            </ul>

            <form action="{{ route("profiles.destroy", $profile->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover o Perfil" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection