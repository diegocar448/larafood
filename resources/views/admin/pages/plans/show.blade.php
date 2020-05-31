@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')
<div class="container">
    <h1>Detalhes do plano <b>{{ $plan->name }}</b></h1> 
</div>
@stop

@section("content")
    <div class="card">
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif

            <ul>
                <li>
                    <strong> Nome </strong> {{ $plan->name }}
                </li>
                <li>
                    <strong> URL </strong> {{ $plan->url }}
                </li>
                <li>
                    <strong> Preço </strong> {{ number_format($plan->price, 2, ",", ".") }}
                </li>
                <li>
                    <strong> Descrição </strong> {{ $plan->description }}
                </li>
            </ul>

            <form action="{{ route("plans.destroy", $plan->url) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover o Plano" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection