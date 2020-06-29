@extends('adminlte::page')

@section('title', "Mesas")

@section('content_header')
<a href="{{ route('tables.create') }}" class="btn btn-dark btn-block">
    Adicionar Mesa <i class="fas fa-plus-square"></i>
</a>
<div class="container">
    

    <h1>
        Mesas     
    </h1> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" >Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>
</div>
@stop

@section("content")
    

    <div class="card">

        <div class="card-header">
            <form action="{{ route('tables.search') }}" method="POST" class="form form-inline">
                @csrf                
                <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{old('filter')}}">
                <button type="submit" class="btn btn-dark">Buscar</button>                
            </form>
        </div>
        <div class="cardy-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Identidade</th>
                        <th>Descrição</th>
                        <th style="width:290px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                    <tr>
                        <td>{{$table->identify}}</td>
                        <td>{{$table->description}}</td>
                        <td style="width:150px;">
                            <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">Ver</a>                            
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if(isset($filters))
                {!! $tables->appends($filters)->links() !!}
            @else
                {!! $tables->links() !!}
            @endif
            

        </div>
    </div>
@endsection