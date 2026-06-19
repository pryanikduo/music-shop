@extends('layouts.admin')
@section('title', 'Тикеты поддержки')
@section('content')
<div class="card">
    <div class="card-header"><h3>Запросы в техподдержку</h3></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Тема</th><th>Email</th><th>Статус</th><th>Дата</th><th>Действия</th></tr></thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->support_ticket_id }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                    <td><a href="{{ route('admin.support-tickets.show', $ticket) }}" class="btn btn-sm btn-info">Открыть</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tickets->links() }}
    </div>
</div>
@endsection