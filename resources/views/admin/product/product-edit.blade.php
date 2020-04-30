@extends('layouts.app')

@section('content')
    <form class="container col-sm-6" method="POST" action="">
        @csrf
        @method('PATCH')
        <div class="form-group ">
            <h2>Atualização de dados do produto</h2>
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
            <input type="text" readonly name="name" id="name" value="{{ $product->name }}" class="form-control" placeholder="Bicicleta Aro 22">
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="quantity">QTD*</label>
                <input type="number" readonly name="quantity" id="quantity" value="{{ $product->quantity }}" class="form-control" placeholder="5">
            </div>
            <br>
            <div class="form-group col-md-3">
                <label for="price">Valor por Unidade*</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">R$</span>
                    </div>
                    <input type="text" readonly name="price" id="price" value="{{ $product->price }}" class="form-control" placeholder="15,00">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Descrição do Produto*</label>
            <textarea class="form-control" readonly name="description" id="description" placeholder="Bicicleta Azul com rodas..." rows="6">{{ $product->description }}</textarea>
        </div>
        <a id="removeButton" data-product-id="{{ $product->id }}" class="btn btn-danger float-right active">Delete</a>
    </form>
@endsection
