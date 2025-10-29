@extends('layouts.layout')
@include('layouts.header')
@section('main')
    <h2>Заявка -{{ $ticket->id }}</h2>


    <p><b>Клиент:</b> {{ $ticket->customer->name }}</p>
    <p><b>Email:</b> {{ $ticket->customer->email }}</p>
    <p><b>Телефон:</b> {{ $ticket->customer->phone }}</p>
    <p><b>Тема:</b> {{ $ticket->theme }}</p>
    <p><b>Сообщение:</b> {{ $ticket->message }}</p>
    <p><b>Статус:</b> {{ $ticket->status_change }}</p>

    @if ($ticket->media->count())
        <h4>Файлы:</h4>
        <div class="d-block">
            @foreach ($ticket->media as $file)
                <div><a href="{{ $file->getFullUrl() }}" download>{{ $file->file_name }}</a></div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('ticketStatus', $ticket) }}">
        @csrf
        <select name="status">
            <option value="new" {{ $ticket->status == 'new' ? 'selected' : '' }}>Новая</option>
            <option value="progress" {{ $ticket->status == 'progress' ? 'selected' : '' }}>В работе</option>
            <option value="done" {{ $ticket->status == 'done' ? 'selected' : '' }}>Обработана</option>
        </select>
        <button type="submit">Обновить статус</button>
    </form>


@endsection
