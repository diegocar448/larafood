@extends('adminlte::page')

@section('title', "Categorias")

@section('content_header')
<a href="{{ route('categories.create') }}" class="btn btn-dark btn-block">
    Adicionar Categoria <i class="fas fa-plus-square"></i>
</a>
<div class="container">
    

    <h1>
        Categorias     
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">Categorias</a></li>
    </ol>
</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('categories.search') }}" method="POST" class="form form-inline">
                @csrf                
                <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{old('filter')}}">
                <button type="submit" class="btn btn-dark">Buscar</button>                
            </form>
        </div>
        <div class="cardy-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th style="width:290px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->email}}</td>
                        <td style="width:150px;">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-warning">Ver</a>                            
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