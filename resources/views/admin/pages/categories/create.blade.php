@extends('adminlte::page')

@section('title', "Cadastrar Nova Categoria")

@section('content_header')
<div class="container">
    <h1>Cadastrar Nova Categoria </h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" class="form" method="POST">
                @csrf
                {{$errors}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ old('name') }}">
                </div>
                
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <br>
                    
                    <textarea class="form-control" name="description" cols="150" rows="5">
                        {{ old('description') }}
                    </textarea>
                </div>

             
                
            

                <div class="form-group">
                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection