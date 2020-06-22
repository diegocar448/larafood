@extends('adminlte::page')

@section('title', "Editar Produto {$product->title}")

@section('content_header')
<div class="container">
    <h1>Editar Produto {{ $product->title }}</h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" class="form" method="POST" enctype="multipart/form-data">
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
                    <label for="title">* Titulo:</label>
                    <input type="text" name="title" class="form-control" placeholder="Titulo:" value="{{ $product->title ?? old('title') }}">
                </div>
                <div class="form-group">
                    <label for="title">* Preço:</label>
                    <input type="number" step="any" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price ?? old('price') }}">
                </div>
                
                <div class="form-group">
                    <label for="title">Imagem:</label>
                    <input type="file" name="image" class="form-control">
                </div>              
                
                <div class="form-group">
                    <label for="description">* Descrição:</label>
                    <br>
                    
                    <textarea class="form-control" name="description" cols="150" rows="5">
                        {{ $product->description ?? old('description') }}
                    </textarea>
                </div>
            

                <div class="form-group">
                    <input type="submit" value="Atualizar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection