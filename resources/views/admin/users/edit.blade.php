@extends('layouts.admin')
@section('title', 'Редактировать пользователя')
@section('content')
<div class="card">
    <div class="card-header"><h3>Редактировать: {{ $user->name }}</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Имя</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label>Роль</label>
                <select name="role" class="form-control">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Пользователь</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Администратор</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
</div>
@endsection