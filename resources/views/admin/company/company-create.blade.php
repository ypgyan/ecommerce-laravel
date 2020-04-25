@extends('layouts.app')

@section('content')
    <form class="container col-sm-6" method="POST" action="{{ route('company.store')}}">
        @csrf
        <div class="form-group ">
            <h2>Preencha os dados da Sua empresa</h2>
            <h5>Essas são as informações que os clientes visualizarão nos seus/seu produtos/serviço</h5>
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
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Coca Cola S.A/ Ricardo Eletricista..." required>
        </div>

        <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="comercial@coca.com" required>
        </div>

        <div class="form-group">
          <label for="description">Descrição da Empresa</label>
          <textarea class="form-control" name="description" id="description" rows="6"></textarea>
        </div>

        <div class="form-group">
            <label for="cnpj">CNPJ*</label>
            <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}" class="form-control" placeholder="83089218000191">
        </div>

        <div class="form-group">
        <label for="company_type"> Tipo de empresa* </label>
        <select class="form-control" name="company_type" id="company_type" required>
            <option value=""></option>
            <option value="varejo" {{ old('company_type') == 'varejo' ? 'selected' : ''  }}> Varejo </option>
            <option value="servico" {{ old('company_type') == 'servico' ? 'selected' : ''  }}> Serviços </option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary float-right">Salvar</button>
    </form>
@endsection
