@extends('adminlte::page')

@section('title', "Cadastrar Novo Produto")

@section('content_header')
<div class="container">
    <h1>Cadastrar Novo Produto </h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label for="title">* Title:</label>
                    <input type="text" name="title" class="form-control" placeholder="Titulo:" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="title">* Preço:</label>
                    <input type="number" step="any" name="price" class="form-control" placeholder="Preço:" value="{{ old('price') }}">
                </div>
                <div class="form-group">
                    <label for="title">Imagem:</label>
                    <input type="file" name="image" class="form-control">
                </div>

              
                
                <div class="form-group">
                    <label for="description">* Descrição:</label>
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