@extends('adminlte::page')

@section('title', "Detalhes da Categoria {$category->name}")

@section('content_header')
<div class="container">
    <h1>Detalhes da Categoria <b>{{ $category->name }}</b></h1> 
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
                    <strong> Nome: </strong> {{ $category->name }}
                </li>                                                      
            </ul>
            <ul>
                <li>
                    <strong> URL: </strong> {{ $category->url }}
                </li>                                                      
            </ul>
            <ul>
                <li>
                    <strong> Descrição: </strong> {{ $category->description }}
                </li>                                                      
            </ul>

            <form action="{{ route("categories.destroy", $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover Categoria" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection