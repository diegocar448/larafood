@extends('adminlte::page')

@section('title', "Detalhes do detalhe {$detail->name}")

@section('content_header')

<div class="container">
    

    <h1>
        Detalhes do detalhe {{$detail->name}}
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.show', $plan->url) }}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item "><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="active">Detalhe</a></li>
    </ol>
</div>
@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $detail->name }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form method="POST" action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Deletar o Detalhe {{ $detail->name }} do plano</button>
            </form>
        </div>
    </div>


@endsection