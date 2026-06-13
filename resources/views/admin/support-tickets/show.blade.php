@extends('layouts.admin')
@section('title', 'Тикет #'.$supportTicket->support_ticket_id)
@section('content')
<div class="card">
    <div class="card-header"><h3>Тема: {{ $supportTicket->subject }}</h3></div>
    <div class="card-body">
        <p><strong>От:</strong> {{ $supportTicket->email }}</p>
        <p><strong>Статус:</strong> 
            <form action="{{ route('admin.support-tickets.update', $supportTicket) }}" method="POST" class="d-inline">
                @csrf @method('PUT')
                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm d-inline-block w-auto">
                    <option value="open" {{ $supportTicket->status == 'open' ? 'selected' : '' }}>Открыт</option>
                    <option value="in_progress" {{ $supportTicket->status == 'in_progress' ? 'selected' : '' }}>В работе</option>
                    <option value="closed" {{ $supportTicket->status == 'closed' ? 'selected' : '' }}>Закрыт</option>
                </select>
            </form>
        </p>
        <p><strong>Дата создания:</strong> {{ $supportTicket->created_at->format('d.m.Y H:i') }}</p>
        <hr>
        <p><strong>Сообщение пользователя:</strong></p>
        <p>{{ nl2br(e($supportTicket->message)) }}</p>
        <hr>
        <form action="{{ route('admin.support-tickets.update', $supportTicket) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Ответ администратора</label>
                <textarea name="admin_reply" class="form-control" rows="5">{{ $supportTicket->admin_reply }}</textarea>
            </div>
            <button type="submit" name="status" value="{{ $supportTicket->status }}" class="btn btn-primary">Сохранить ответ</button>
        </form>
        <a href="{{ route('admin.support-tickets.index') }}" class="btn btn-secondary mt-2">Назад</a>
    </div>
</div>
@endsection