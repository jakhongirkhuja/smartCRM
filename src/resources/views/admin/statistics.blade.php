@extends('layouts.layout')
@include('layouts.header')
@section('main')
    <div class="d-flex">
        <h2><a href="{{ route('tickets') }}">Список заявок</a></h2>
        <h2><a href="{{ route('statistics') }}">Статистика</a></h2>
    </div>
    <div>
        <div class="d-flex">
            <div>
                <h3>Сегодня</h3>
                <p id="today">0</p>
            </div>
            <div>
                <h3>Неделя</h3>
                <p id="week">0</p>
            </div>
            <div>
                <h3>Месяц</h3>
                <p id="month">0</p>
            </div>
        </div>
    </div>
    <script>
        async function fetchStats(params = {}) {
            const res = await fetch(`/api/tickets/statistics`);
            const data = await res.json();
            document.getElementById('today').textContent = data.today;
            document.getElementById('week').textContent = data.week;
            document.getElementById('month').textContent = data.month;
        }

        fetchStats();
    </script>
@endsection
