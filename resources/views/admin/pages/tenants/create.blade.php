@extends('adminlte::page')

@section('title', "Cadastrar Novo Produto")

@section('content_header')
<div class="container">
    <h1>Cadastrar Novo Produto </h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">* Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="logo">* Logo:</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">* E-mail:</label>
                    <input type="email" name="email" class="form-control" placeholder="E-mail:" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="cnpj">* CNPJ:</label>
                    <input type="number" name="cnpj" class="form-control" placeholder="CNPJ:" value="{{ old('cnpj') }}">
                </div>
                <div class="form-group">
                    <label for="active">* Ativo?</label>
                    <select name="active" class="form-control">
                        <option value="Y" @if(old("active") == "Y") selected="selected" @endif>SIM</option>
                        <option value="N" @if(old("active") == "N") selected="selected" @endif>NÃo</option>
                    </select>
                </div>
                <hr>
                
                <h3>Assinatura</h3>                
                <div class="form-group">
                    <label for="">Data Assinatura (início):</label>
                    <input type="date" name="subscription" class="form-control" placeholder="Data Assinatura:" value="{{ old('subscription') }}">
                </div>

                <div class="form-group">
                    <label for="">Expira (final):</label>
                    <input type="date" name="expires_at" class="form-control" placeholder="Expira:" value="{{ old('expires_at') }}">
                </div>
                <div class="form-group">
                    <label for="">Identificador:</label>
                    <input type="text" name="subscription_id" class="form-control" placeholder="Identificador:" value="{{ old('subcription_id') }}">
                </div>

                <div class="form-group">
                    <label for="">* Assinatura Ativa? </label>
                    <select name="subscription_active" class="form-control">
                        <option value="1" @if(old("subscription_active") == "Y") selected="selected" @endif>SIM</option>
                        <option value="0" @if(old("subscription_active") == "N") selected="selected" @endif>NÃo</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="">* Assinatura Cancelada?? </label>
                    <select name="subscription_suspended" class="form-control">
                        <option value="1" @if(old("subscription_suspended") == "Y") selected="selected" @endif>SIM</option>
                        <option value="0" @if(old("subscription_suspended") == "N") selected="selected" @endif>NÃo</option>
                    </select>
                </div>

             
                
            

                <div class="form-group">
                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection