@extends('adminlte::page')

@section('title', "Planos")

@section('content_header')
<div class="container">
    <h1>Planos</h1> 
</div>
@stop

@section("content")
    <div class="container">
        <a href="{{ route('plans.create') }}" class="btn btn-dark">ADD</a>
    </div>

    <div class="card">

        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf                
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{old('filter')}}">
                <button type="submit" class="btn btn-dark">Buscar</button>                
            </form>
        </div>
        <div class="cardy-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th style="width:10px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                    <tr>
                        <td>{{$plan->name}}</td>
                        <td>{{number_format($plan->price, 2, ",", ".")}}</td>
                        <td style="width:10px;">
                            <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
            

        </div>
    </div>
@endsection