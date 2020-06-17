@extends('adminlte::page')

@section('title', "Cadastrar Novo Usuário")

@section('content_header')
<div class="container">
    <h1>Cadastrar Novo Usuário </h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" class="form" method="POST">
                @csrf

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
                    <label for="price">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email:" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" class="form-control" placeholder="Senha:" value="{{ old('password') }}">
                </div>
                
            

                <div class="form-group">
                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection