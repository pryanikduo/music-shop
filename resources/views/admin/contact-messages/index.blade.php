@extends('layouts.admin')
@section('title', 'Сообщения')
@section('content')
<div class="card">
    <div class="card-header"><h3>Сообщения из формы обратной связи</h3></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Имя</th><th>Email</th><th>Телефон</th><th>Сообщение</th><th>Прочитано</th><th>Дата</th><th>Действия</th></tr></thead>
            <tbody>
                @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->contact_mess_id }}</td>
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->phone }}</td>
                    <td>{{ Str::limit($msg->message, 50) }}</td>
                    <td>{{ $msg->is_read ? 'Да' : 'Нет' }}</td>
                    <td>{{ $msg->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('admin.contact-messages.show', $msg) }}" class="btn btn-sm btn-info">Просмотр</a>
                        <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Уд</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $messages->links() }}
    </div>
</div>
@endsection