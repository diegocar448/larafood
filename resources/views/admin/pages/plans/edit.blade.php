@extends('adminlte::page')

@section('title', "Editar o plano {$plan->name}")

@section('content_header')
<div class="container">
    <h1>Editar Plano </h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url) }}" class="form" method="POST">
                @csrf
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" value="{{$plan->name}}">
                </div>
                
                <div class="form-group">
                    <label for="price">Preço:</label>
                    <input type="text" name="price" class="form-control" value="{{$plan->price}}">
                </div>
                
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" class="form-control" value="{{$plan->description}}">
                </div>

                <div class="form-group">
                    <input type="submit" value="Atualizar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection