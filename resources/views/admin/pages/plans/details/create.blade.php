@extends('adminlte::page')

@section('title', "Adicionar novo detalhe ao plano {$plan->name}")

@section('content_header')
{{-- <a href="{{ route('plans.create') }}" class="btn btn-dark btn-block">
    Detalhes do Plano {{ $plan->name }}
</a> --}}
<div class="container">
    

    <h1>
        Adicionar novo detalhe ao plano {{$plan->name}}
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.show', $plan->url) }}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item "><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.create', $plan->url) }}" class="active">Novo</a></li>
    </ol>
</div>
@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('details.plan.store', $plan->url) }}">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="">Nome:</label>
                    <input type="text" name="name" placeholder="Nome" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block">Enviar</button>
                </div>
            </form>
        </div>
    </div>


@endsection