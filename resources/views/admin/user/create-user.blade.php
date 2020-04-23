@extends('layouts.app')

@section('content')
    <form class="container col-sm-6" method="POST" action="{{ route('user.store')}}">
        @csrf
        <div class="form-group ">
            <h2>Adicione um novo usuário</h2>
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
            <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" class="form-control" placeholder="Fulano da Silva Sauro">
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}" class="form-control" placeholder="12345678909">
        </div>

        <div class="form-group">
        <label for="user_type"> User type</label>
        <select class="form-control" name="user_type" id="user_type">
            <option value=""></option>
            <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : ''  }}>Admin</option>
            <option value="seller" {{ old('user_type') == 'seller' ? 'selected' : ''  }}>Seller</option>
            <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>User</option>
        </select>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="fulano@mail.com">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Insert your password">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password2" id="password2" class="form-control" placeholder="Re-type the same password">
        </div>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
