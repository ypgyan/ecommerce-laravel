@extends('layouts.app')

@section('content')
    <form class="container col-sm-6" method="POST" action="{{ route('company.update', $company->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group header">
            <h2>{{ $company->name }}</h2>
        </div>
        @include('admin.message')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br>
        <div class="form-group">
            <label for="name">Nome da Empresa*</label>
            <input type="text" name="name" id="name" value="{{ $company->name }}" class="form-control" placeholder="Coca Cola S.A/ Ricardo Eletricista..." required>
        </div>

        <div class="form-group">
          <label for="description">Descrição da Empresa</label>
          <textarea class="form-control" name="description" id="description" rows="6">{{ $company->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="email">Email*</label>
            <input type="label" readonly name="email" id="email" value="{{ $company->email }}" class="form-control" placeholder="83089218000191">
            <small id="helpId" class="text-muted">Para troca do Email é necessário entrar em contato com o administrador.</small>
        </div>

        <div class="form-group">
            <label for="cnpj">CNPJ*</label>
            <input type="label" readonly name="cnpj" id="cnpj" value="{{ $company->cnpj }}" class="form-control" placeholder="83089218000191">
            <small id="helpId" class="text-muted">Para troca de CNPJ  entrar em contato com o administrador.</small>
        </div>

        <div class="form-group">
        <label for="company_type"> Tipo de empresa* </label>
        <select class="form-control" name="company_type" id="company_type" required>
            <option value=""></option>
            <option value="varejo" {{ $company->company_type == 'varejo' ? 'selected' : ''  }}> Varejo </option>
            <option value="servico" {{ $company->company_type == 'servico' ? 'selected' : ''  }}> Serviços </option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary float-right">Atualizar</button>
    </form>
@endsection
