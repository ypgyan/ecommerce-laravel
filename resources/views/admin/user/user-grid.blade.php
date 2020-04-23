@extends('layouts.app')

@section('content')
    <div class="container">
        @include('admin.message')
        <div class="card">
            <div class="card-header">
                <h2>Users</h2>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <a href="{{ route('user.create') }}" class="btn btn-success card-text fa fa-plus"> Add User</a>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                        <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->cpf }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->user_type }}</td>
                          <td>
                              <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-light">Edit</a>
                          </td>
                        </tr>
                        @endforeach
                        {{ $users->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
