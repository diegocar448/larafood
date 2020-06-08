@extends('adminlte::page')

@section('title', "Planos do perfil ")

@section('content_header')

<div class="container">
    

    <h1>
        Planos do perfil <b> {{ $profile->name }} </b>        
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.plans', $profile->id) }}">Planos</a></li>
    </ol>
</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf                
                <input type="text" name="filter" placeholder="Busca" class="form-control" value="{{ $filters["filter"] ?? ''}}">
                <button type="submit" class="btn btn-dark">Buscar</button>                
            </form>
            @if (session('sucesso'))
                    <div class="alert alert-success">
                        {{ session('sucesso') }}
                    </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="cardy-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>                      
                        <th style="width:250px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                    <tr>
                        <td>{{$plan->name}}</td>                    
                        <td style="width:150px;">
                            <a href="{{ route('plan.profile.detach', [$plan->id, $profile->id]) }}" class="btn btn-info">Desvincular</a>                           
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