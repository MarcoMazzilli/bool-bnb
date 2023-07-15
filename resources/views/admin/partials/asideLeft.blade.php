<aside class="p-3 bg-white shadow">
    <div class="logo">
        <h1>BoolBnb</h1>
    </div>

    <div class="txt-white my-5">

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
</aside>


