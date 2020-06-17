@extends('adminlte::page')

@section('title', "Editar o Usuário {$user->name}")

@section('content_header')
<div class="container">
    <h1>Editar Usuário </h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
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
                    <input type="text" name="name" class="form-control" value="{{$user->name ?? old('name')}}">
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" value="{{$user->email ?? old('email')}}">
                </div>
                
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" class="form-control" placeholder="Senha:" value="">
                </div>
            

                <div class="form-group">
                    <input type="submit" value="Atualizar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection