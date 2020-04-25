@extends('layouts.app')

@section('content')
    <div class="container">
        @include('admin.message')
        <div class="card">
            <div class="card-header">
                <h2>Produtos</h2>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <a href="{{ route('product.create') }}" class="btn btn-success card-text fa fa-plus"> Add Produto</a>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Estoque</th>
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $user)
                        <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->quantity }}</td>
                          <td>{{ $user->price }}</td>
                          <td>{{ $user->status }}</td>
                          <td>
                              <a href="{{ route('product.edit', [$user->id]) }}" class="btn btn-light">Visualizar</a>
                          </td>
                        </tr>
                        @endforeach
                        {{ $products->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
