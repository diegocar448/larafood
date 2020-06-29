@extends('adminlte::page')

@section('title', "Cadastrar Nova Mesa")

@section('content_header')
<div class="container">
    <h1>Cadastrar Nova Mesa </h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.store') }}" class="form" method="POST">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label for="identify">Identificador da mesa:</label>
                    <input type="text" name="identify" class="form-control" placeholder="Identificador da mesa:" value="{{ old('identify') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{ old('description') }}">
                </div>
                
              
             
                
            

                <div class="form-group">
                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection