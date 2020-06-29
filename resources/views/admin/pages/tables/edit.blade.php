@extends('adminlte::page')

@section('title', "Editar Mesa {$table->name}")

@section('content_header')
<div class="container">
    <h1>Editar Mesa {{ $table->name }}</h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="POST">
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
                    <label for="identify">Identificador da Mesa:</label>
                    <input type="text" name="identify" class="form-control" placeholder="Identificador da mesa:" value="{{ $table->identify ?? old('identify') }}">
                </div>

                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{ $table->description ?? old('description') }}">
                </div>
                
                {{-- <div class="form-group">
                    <label for="description">Descrição:</label>
                    <br>
                    
                    <textarea class="form-control" name="description" cols="150" rows="5">
                        {{ $table->name ?? old('description') }}
                    </textarea>
                </div> --}}
            

                <div class="form-group">
                    <input type="submit" value="Atualizar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection