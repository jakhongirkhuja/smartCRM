@extends('layouts.layout')
@include('layouts.header')
@section('main')
    <div class="d-flex">
        <h2><a href="{{ route('tickets') }}">Список заявок</a></h2>
        <h2><a href="{{ route('statistics') }}">Статистика</a></h2>
    </div>
    statistik
@endsection
