@extends('adminlte::page')

@section('title', "Editar Categoria {$category->name}")

@section('content_header')
<div class="container">
    <h1>Editar Categoria {{ $category->name }}</h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" class="form" method="POST">
                @csrf
                {{ method_field('PUT') }}

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $category->name ?? old('name') }}">
                </div>

                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="text" name="url" class="form-control" placeholder="URL:" value="{{ $category->url ?? old('url') }}">
                </div>
                
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <br>
                    
                    <textarea class="form-control" name="description" cols="150" rows="5">
                        {{ $category->name ?? old('description') }}
                    </textarea>
                </div>
            

                <div class="form-group">
                    <input type="submit" value="Atualizar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection