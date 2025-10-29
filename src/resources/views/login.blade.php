@extends('layouts.layout')
@include('layouts.header')

@section('main')
    @if ($errors->any())
        <div style="color: red;">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="{{ route('loginPost') }}" class="form-control">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label>Пароль:</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Войти</button>
    </form>
@endsection
