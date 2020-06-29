@extends('adminlte::page')

@section('title', "Detalhes da Mesa {$table->identify}")

@section('content_header')
<div class="container">
    <h1>Detalhes da Mesa <b>{{ $table->identify }}</b></h1> 
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
                    <strong> Identificador da mesa: </strong> {{ $table->identify }}
                </li>                                                      
            </ul>       
            <ul>
                <li>
                    <strong> Descrição: </strong> {{ $table->description }}
                </li>                                                      
            </ul>

            <form action="{{ route("tables.destroy", $table->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover Mesa" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection