@extends('adminlte::page')

@section('title', "Detalhes do Produto {$tenant->title}")

@section('content_header')
<div class="container">
    <h1>Detalhes do Produto <b>{{ $tenant->title }}</b></h1> 
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

     
                    
            {{-- <img style="max-width: 90px;" src="{{ url($tenant->logo) }}" alt=""> --}}
          
            <ul>
                <li>
                    <strong> Plano: </strong> {{ $tenant->plan->name }}
                </li>   

                <li>
                    <strong> Nome: </strong> {{ $tenant->name }}
                </li>                                                      
            
                <li>
                    <strong> URL: </strong> {{ $tenant->url }}
                </li>                                                      
            
                <li>
                    <strong> E-mail: </strong> {{ $tenant->email }}
                </li>                                                      
            
                <li>
                    <strong> CNPJ: </strong> {{ $tenant->cnpj }}
                </li>   

                <li>
                    <strong> Ativo: </strong> {{ $tenant->active == "Y" ? "SIM" : "NÃO"}}
                </li>                                                      
            </ul>
            <hr>
            <h3>Assinatura</h3>
            <ul>
                <li>
                    <strong> Data Assinatura: </strong> {{ $tenant->subcription }}
                </li>                                                          
                <li>
                    <strong> Data Expiração: </strong> {{ $tenant->expires_at }}
                </li>                                                          
                <li>
                    <strong> Identificador: </strong> {{ $tenant->subcription_id }} 
                </li>                                                          
                <li>
                    <strong> Ativo: </strong> {{ $tenant->subscription_active == "Y" ? "SIM" : "NÃO" }}
                </li>                                                          
                <li>
                    <strong> Cancelou? </strong> {{ $tenant->subscription_suspended == "Y" ? "SIM" : "NÃO" }}
                </li>                                                          
            </ul>



            {{-- <form action="{{ route("tenants.destroy", $tenant->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover Tenant" class="btn btn-danger">
            </form> --}}
        </div>
    </div>
@endsection