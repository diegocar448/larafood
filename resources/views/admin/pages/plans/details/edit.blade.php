@extends('adminlte::page')

@section('title', "Editar o detalher {$detail->name}")

@section('content_header')

<div class="container">
    

    <h1>
        Editar detalhe {{$detail->name}}
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.show', $plan->url) }}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item "><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="active">Editar</a></li>
    </ol>
</div>
@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('details.plan.update', [$plan->url, $detail->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Nome:</label>
                    <input type="text" name="name" placeholder="Nome" class="form-control" value="{{ $detail->name }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block">Enviar</button>
                </div>
            </form>
        </div>
    </div>


@endsection