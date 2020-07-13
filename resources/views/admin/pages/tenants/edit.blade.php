@extends('adminlte::page')

@section('title', "Editar Tenant {$tenant->name}")

@section('content_header')
<div class="container">
    <h1>Editar Empresa {{ $tenant->name }}</h1>
</div>

@stop

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.update', $tenant->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">* Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $tenant->name }}">
                </div>
                <div class="form-group">
                    <label for="logo">* Logo:</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">* E-mail:</label>
                    <input type="email" name="email" class="form-control" placeholder="E-mail:" value="{{ $tenant->email }}">
                </div>
                <div class="form-group">
                    <label for="cnpj">* CNPJ:</label>
                    <input type="number" name="cnpj" class="form-control" placeholder="CNPJ:" value="{{ $tenant->cnpj }}">
                </div>
                <div class="form-group">
                    <label for="active">* Ativo?</label>
                    <select name="active" class="form-control">
                        <option value="Y" @if($tenant->active == "Y") selected="selected" @endif>SIM</option>
                        <option value="N" @if($tenant->active == "N") selected="selected" @endif>NÃo</option>
                    </select>
                </div>
                <hr>
                
                <h3>Assinatura</h3>                
                <div class="form-group">
                    <label for="">Data Assinatura (início):</label>
                    <input type="date" name="subscription" class="form-control" placeholder="Data Assinatura:" value="{{ $tenant->subscription }}">
                </div>

                <div class="form-group">
                    <label for="">Expira (final):</label>
                    <input type="date" name="expires_at" class="form-control" placeholder="Expira:" value="{{ $tenant->expires_at }}">
                </div>
                <div class="form-group">
                    <label for="">Identificador:</label>
                    <input type="text" name="subscription_id" class="form-control" placeholder="Identificador:" value="{{ $tenant->subscription_id }}">
                </div>

                <div class="form-group">
                    <label for="">* Assinatura Ativa? </label>
                    <select name="subscription_active" class="form-control">
                        <option value="1" @if($tenant->subscription_active == "Y") selected="selected" @endif>SIM</option>
                        <option value="0" @if($tenant->subscription_active == "N") selected="selected" @endif>NÃO</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="">* Assinatura Cancelada?? </label>
                    <select name="subscription_suspended" class="form-control">
                        <option value="1" @if($tenant->subscription_suspended == "Y") selected="selected" @endif>SIM</option>
                        <option value="0" @if($tenant->subscription_suspended == "N") selected="selected" @endif>NÃO</option>
                    </select>
                </div>
            

                <div class="form-group">
                    <input type="submit" value="Atualizar" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
@endsection