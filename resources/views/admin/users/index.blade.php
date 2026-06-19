@extends('layouts.admin')
@section('title', 'Пользователи')
@section('content')
<div class="card">
    <div class="card-header"><h3>Управление пользователями</h3></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr><th>ID</th><th>Имя</th><th>Email</th><th>Роль</th><th>Действия</th></tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role === 'admin' ? 'Администратор' : 'Пользователь' }}</td>
                    <td><a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Редактировать</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection