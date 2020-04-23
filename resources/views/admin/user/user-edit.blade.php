@extends('layouts.app')

@section('content')
    <form class="container col-sm-6" method="POST" action="{{ route('user.update', $user->id)}}">
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
            <label for="user_name">Name</label>
            <input type="text" name="user_name" id="user_name" value="{{ $user->name }}" class="form-control" placeholder="Fulano da Silva Sauro">
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" value="{{ $user->cpf }}" class="form-control" placeholder="12345678909">
        </div>

        <div class="form-group">
            <label for="user_type"> User type</label>
            <select class="form-control" name="user_type" id="user_type">
                <option value=""></option>
                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : ''  }}>Admin</option>
                <option value="seller" {{ $user->user_type == 'seller' ? 'selected' : ''  }}>Seller</option>
                <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <a id='removeUser' data-user-id="{{ $user->id }}" class="btn btn-danger float-right">Delete</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
