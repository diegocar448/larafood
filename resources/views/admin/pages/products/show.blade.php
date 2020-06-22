@extends('adminlte::page')

@section('title', "Detalhes do Produto {$product->title}")

@section('content_header')
<div class="container">
    <h1>Detalhes do Produto <b>{{ $product->title }}</b></h1> 
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

     
                    
            <img style="max-width: 90px;" src="{{ url($product->image) }}" alt="">
          
            <ul>
                <li>
                    <strong> Titulo: </strong> {{ $product->title }}
                </li>                                                      
            </ul>
            <ul>
                <li>
                    <strong> Flag: </strong> {{ $product->flag }}
                </li>                                                      
            </ul>
            <ul>
                <li>
                    <strong> Descrição: </strong> {{ $product->description }}
                </li>                                                      
            </ul>

            <form action="{{ route("products.destroy", $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Remover Produto" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection