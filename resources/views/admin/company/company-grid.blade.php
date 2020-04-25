@extends('layouts.app')

@section('content')
    <div class="container">
        @include('admin.message')
        <div class="card">
            <div class="card-header">
                <h2>Empresas</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Tipo</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($companies as $company)
                        <tr>
                          <td>{{ $company->id }}</td>
                          <td>{{ $company->name }}</td>
                          <td>{{ $company->email }}</td>
                          <td>{{ $company->cnpj }}</td>
                          <td>{{ strtoupper($company->company_type) }}</td>
                        </tr>
                        @endforeach
                        {{ $companies->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
