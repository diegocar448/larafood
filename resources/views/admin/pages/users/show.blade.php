@extends('adminlte::page')

@section('title', "Detalhes do usuário {$user->name}")

@section('content_header')
<div class="container">
    <h1>Detalhes do Usuário <b>{{ $user->name }}</b></h1> 
</div>
@stop

@section("content")
    <div class="card">
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif

            <ul>
                <li>
                    <strong> Nome </strong> {{ $user->name }}
                </li>
                <li>
                    <strong> Email </strong> {{ $user->email }}
                </li>               
                <li>
                    <strong> Tenant </strong> {{ $user->tenant->name }}
                </li>               
            </ul>

            <form action="{{ route("users.destroy", $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover o Usuário" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection