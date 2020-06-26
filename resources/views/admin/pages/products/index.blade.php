@extends('adminlte::page')

@section('title', "Produtos")

@section('content_header')
<a href="{{ route('products.create') }}" class="btn btn-dark btn-block">
    Adicionar Produtos <i class="fas fa-plus-square"></i>
</a>
<div class="container">
    

    <h1>
        Produtos     
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>
</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('products.search') }}" method="POST" class="form form-inline">
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
                        <th>Titulo</th>                      
                        <th style="width:290px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            {{-- <img src="{{ url("storage/{$product->image}") }}" alt="">  --}}
                            <img src="{{ url("storage/{$product->image}") }}" alt="" style="max-width: 90px;"> 
                            
                        </td>
                        <td>{{$product->title}}</td>                        
                        <td style="width:150px;">
                            <a href="{{ route('products.categories', $product->id) }}" class="btn btn-info" title="Categorias">
                                <i class="fas fa-layer-group"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning">Ver</a>                            
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
            

        </div>
    </div>
@endsection