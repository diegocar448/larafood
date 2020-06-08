@extends('adminlte::page')

@section('title', "Planos")

@section('content_header')
<a href="{{ route('plans.create') }}" class="btn btn-dark btn-block">
    Adicionar registro <i class="fas fa-plus-square"></i>
</a>
<div class="container">
    

    <h1>
        Planos     
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>
</div>
@stop

@section("content")
    

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
                        <th style="width:290px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                    <tr>
                        <td>{{$plan->name}}</td>
                        <td>{{number_format($plan->price, 2, ",", ".")}}</td>
                        <td style="width:150px;">
                            <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">Ver</a>
                            <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-danger">Detalhes</a>
                            <a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-warning">                            
                                <i class="fas fa-address-book"></i>
                            </a>
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