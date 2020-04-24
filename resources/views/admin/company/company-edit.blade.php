@extends('layouts.app')

@section('content')
    <form class="container col-sm-6" method="POST" action="{{ route('company.update', $company->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group ">
            <h2>Atualização de dados do usuário</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="name">Nome da Empresa*</label>
            <input type="text" name="name" id="name" value="{{ $company->name }}" class="form-control" placeholder="Coca Cola S.A/ Ricardo Eletricista..." required>
        </div>

        <div class="form-group">
          <label for="description">Descrição da Empresa</label>
          <textarea class="form-control" name="description" id="description" rows="6">{{ $company->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="cnpj">CNPJ*</label>
            <input type="text" name="cnpj" id="cnpj" value="{{ $company->cnpj }}" class="form-control" placeholder="83089218000191">
        </div>

        <div class="form-group">
        <label for="company_type"> Tipo de empresa* </label>
        <select class="form-control" name="company_type" id="company_type" required>
            <option value=""></option>
            <option value="varejo" {{ $company->company_type == 'varejo' ? 'selected' : ''  }}> Varejo </option>
            <option value="servico" {{ $company->company_type == 'servico' ? 'selected' : ''  }}> Serviços </option>
        </select>
        </div>
        <div class="row">
            <div class="col-md-4">
                <br/>
                <label for="img_name"> Logo da empresa* </label>
                <input type="text" name="img_name" class="form-control" value="{{ $company->image}}" placeholder="Nome da Imagem">
            </div>
            <div class="col-md-12">
                <br/>
                <input type="file" class="image" name="image" value="">
            </div>
        </div>
        <a id='removeUser' data-user-id="{{ $company->id }}" class="btn btn-danger float-right">Delete</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
