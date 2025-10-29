<header class="d-flex">
    @auth
        <h2>Админ-панель</h2>
    @endauth
    <div>
        @auth
            <span>👤 {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="margin-left: 10px;">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}">Войти</a>
        @endauth
    </div>
</header>
