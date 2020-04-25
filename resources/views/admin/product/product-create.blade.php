@extends('layouts.app')

@section('content')
    <form class="container col-sm-6" method="POST" action="{{ route('product.store')}}">
        @csrf
        <div class="form-group ">
            <h2>Adicione um novo Produto</h2>
            <br>
            <h5>Após criado o Produto <strong>não poderá</strong> ser editado</h5>
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
            <label for="name">Nome do produto*</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Bicicleta Aro 22">
        </div>

        <div class="form-row">
            <div class="form-group col-md-1">
                <label for="quantity">QTD*</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="form-control" placeholder="5">
            </div>
            <br>
            <div class="form-group col-md-3">
                <label for="price">Valor por Unidade*</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">R$</span>
                    </div>
                    <input type="text" name="price" id="price" value="{{ old('price') }}" class="form-control" placeholder="15,00">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Descrição do Produto*</label>
            <textarea class="form-control" name="description" id="description" placeholder="Bicicleta Azul com rodas..." rows="6"></textarea>
        </div>

        <button type="submit" class="btn btn-primary float-right">Salvar</button>
    </form>
@endsection
