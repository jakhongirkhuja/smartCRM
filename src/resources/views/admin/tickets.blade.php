@extends('layouts.layout')
@include('layouts.header')
@section('main')
    <div class="d-flex">
        <h2><a href="{{ route('tickets') }}">Список заявок</a></h2>
        @role('admin')
            <h2><a href="{{ route('statistics') }}">Статистика</a></h2>
        @endrole
    </div>

    <form method="GET" action="{{ route('tickets') }}" class="form-control d-flex">
        <input type="text" name="email" placeholder="Email" class="d-inline" value="{{ request('email') }}">
        <input type="text" name="phone" placeholder="Телефон" class="d-inline" value="{{ request('phone') }}">
        <select name="status">
            <option value="">Все статусы</option>
            <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Новые</option>
            <option value="progress" {{ request('status') == 'progress' ? 'selected' : '' }}>В работе</option>
            <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Обработанные</option>
        </select>
        <input type="date" name="from" value="{{ request('from') }}">
        <input type="date" name="to" value="{{ request('to') }}">
        <button type="submit">Фильтр</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Клиент</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Тема</th>
                <th>Статус</th>
                <th>Модератор</th>
                <th>Дата</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer->name }}</td>
                    <td>{{ $ticket->customer->email }}</td>
                    <td>{{ $ticket->customer->phone }}</td>
                    <td>{{ $ticket->theme }}</td>
                    <td>{{ $ticket->status_change }}</td>
                    <td>{{ $ticket->user?->name ?? 'Не обработан' }}</td>
                    <td>{{ $ticket->created_at->format('d.m.Y h:i') }}</td>
                    <td><a href="{{ route('ticketEach', $ticket) }}">Открыть</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}
@endsection
