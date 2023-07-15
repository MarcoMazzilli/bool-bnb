<aside class="h-100 shadow">

    {{-- LOGO --}}
    <div class="logo">
        <h1>BoolBnb</h1>
    </div>

    {{-- MAIN LINK --}}
    <div class="links">

        <ul class="navbar-nav">
            <li class="nav-item {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('dashboard') }}">Dashboard home</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() === 'admin.apartments.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.apartments.index') }}">I miei appartamenti</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() === 'admin.apartments.create' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.apartments.create') }}">Aggiungi</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() === '#' ? 'active' : '' }}">
                <a class="nav-link" href="#">Inbox</a>
            </li>
        </ul>
    </div>

    {{-- LOG-OUT BUTTON --}}
    <div class="log-out-button text-center">
        <button type="submit" class="btn btn-logout">

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <span>Torna al sito pubblico</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </button>
    </div>
</aside>
