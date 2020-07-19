@extends('adminlte::page')

@section('title', "Editar o Cargo {$role->name}")

@section('content_header')
<div class="container">
    <h1>Editar Cargo</h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" class="form" method="POST">
                @csrf
                {{ method_field('PUT') }}

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('sucesso'))
                    <div class="alert alert-success">
                        {{ session('sucesso') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" value="{{$role->name ?? old('name')}}">
                </div>               
                
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" class="form-control" value="{{$role->description ?? old('description')}}">
                </div>

                <div class="form-group">
                    <input type="submit" value="Atualizar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection