@extends('adminlte::page')

@section('title', "Perfis do plano ")

@section('content_header')

<div class="container">
    

    <h1>
        Perfis do plano <b> {{ $plan->name }} </b>
        <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-dark">Adicionar Novo Plano</a>
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles', $plan->id) }}">Perfis</a></li>
        {{-- <li class="breadcrumb-item active"><a href="{{ route('plans.profiles.available', $plan->id) }}">Disponiveis</a></li> --}}
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
                        <th style="width:50px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                    <tr>
                        <td>{{$profile->name}}</td>                    
                        <td style="width:150px;">
                            <a href="{{ route('plans.profile.detach', [$plan->id, $profile->id ]) }}" class="btn btn-danger">Desvincular</a>                           
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
            

        </div>
    </div>
@endsection