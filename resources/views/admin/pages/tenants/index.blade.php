@extends('adminlte::page')

@section('title', "Empresa")

@section('content_header')

<div class="container">
    

    <h1>
        Empresas     
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.index') }}">Empresas</a></li>
    </ol>
</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('tenants.search') }}" method="POST" class="form form-inline">
                @csrf                
                <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{old('filter')}}">
                <button type="submit" class="btn btn-dark">Buscar</button>                
            </form>
        </div>
        <div class="cardy-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th style="max-width: 90px;">Imagem</th>
                        <th>Nome</th>                      
                        <th style="width:290px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                    <tr>
                        <td>
                            {{-- <img src="{{ url("storage/{$tenant->image}") }}" alt="">  --}}
                            <img src="{{ url("storage/{$tenant->logo}") }}" alt="" style="max-width: 90px;"> 
                            
                        </td>
                        <td>{{$tenant->name}}</td>                        
                        <td style="width:150px;">
                            {{-- <a href="{{ route('tenants.categories', $tenant->id) }}" class="btn btn-info" title="Categorias">
                                <i class="fas fa-layer-group"></i>
                            </a> --}}
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning">Ver</a>                            
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
            @endif
            

        </div>
    </div>
@endsection