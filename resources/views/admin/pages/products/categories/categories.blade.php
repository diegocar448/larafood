@extends('adminlte::page')

@section('title', "Categorias do produto")

@section('content_header')

<div class="container">
    

    <h1>
        Categorias do produto <b> {{ $product->title }} </b>
        <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-dark">Adicionar nova Categoria</a>
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories', $product->id) }}">Perfis</a></li>
        {{-- <li class="breadcrumb-item active"><a href="{{ route('products.categories.available', $product->id) }}">Disponiveis</a></li> --}}
    </ol>
</div>


@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('products.search') }}" method="POST" class="form form-inline">
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
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}} </td>                    
                        <td style="width:150px;">
                            <a href="{{ route('products.category.detach', [$product->id, $category->id ]) }}" class="btn btn-danger">Desvincular</a>                           
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">
            @if(isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
            

        </div>
    </div>
@endsection