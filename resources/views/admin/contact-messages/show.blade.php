@extends('layouts.admin')
@section('title', 'Сообщение #'.$contactMessage->contact_mess_id)
@section('content')
<div class="card">
    <div class="card-header"><h3>Сообщение от {{ $contactMessage->name }}</h3></div>
    <div class="card-body">
        <p><strong>Имя:</strong> {{ $contactMessage->name }}</p>
        <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
        <p><strong>Телефон:</strong> {{ $contactMessage->phone ?: '—' }}</p>
        <p><strong>Дата:</strong> {{ $contactMessage->created_at->format('d.m.Y H:i') }}</p>
        <hr>
        <p><strong>Сообщение:</strong></p>
        <p>{{ nl2br(e($contactMessage->message)) }}</p>
        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">Назад</a>
    </div>
</div>
@endsection