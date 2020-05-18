@extends('adminlte::page')

@section('title', "Cadastrar Novo Plano")

@section('content_header')
<div class="container">
    <h1>Cadastrar Novo Plano </h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.store') }}" class="form" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:">
                </div>
                
                <div class="form-group">
                    <label for="price">Preço:</label>
                    <input type="text" name="price" class="form-control" placeholder="Preço:">
                </div>
                
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" class="form-control" placeholder="Descrição:">
                </div>

                <div class="form-group">
                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection