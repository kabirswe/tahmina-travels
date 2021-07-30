<nav id="sidebarMenu" class="dashboard-sidebar">
    <div class="position-sticky pt-3">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
          <img src="{{ asset('images/admin/logo.svg') }}" class="navbar-brand-img" alt="...">
        </a>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link{{ Route::is('dashboard') ? ' active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">
                    <ion-icon name="albums-outline"></ion-icon>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('ticket.create') ? ' active' : '' }}" aria-current="page" href="{{ route('ticket.create') }}">
                    <ion-icon name="airplane-outline"></ion-icon>
                    Ticket
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">
                    <ion-icon name="document-outline"></ion-icon>
                    Payment Info User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">
                    <ion-icon name="document-outline"></ion-icon>
                    Next Flights
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">
                    <ion-icon name="document-outline"></ion-icon>
                    Profit
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">
                    <ion-icon name="document-outline"></ion-icon>
                    Payment Info Vendor
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('users.index', 'users.edit', 'users.show', 'users.create') ? ' active' : '' }}" href="{{ route('users.index') }}">
                    <ion-icon name="people-outline"></ion-icon>
                    Users list
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('place.index', 'place.edit', 'place.show', 'place.create') ? ' active' : '' }}" href="{{ route('place.index') }}">
                    <ion-icon name="people-outline"></ion-icon>
                    Dep/Des list
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('payment.type.index', 'payment.type.edit', 'payment.type.show', 'payment.type.create') ? ' active' : '' }}" href="{{ route('payment.type.index') }}">
                    <ion-icon name="people-outline"></ion-icon>
                    Patment Types
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('roles.index', 'roles.edit', 'roles.show', 'roles.create') ? ' active' : '' }}" href="{{ route('roles.edit', 1) }}">
                    <ion-icon name="people-outline"></ion-icon>
                    Users role
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('blockedUserList') ? ' active' : '' }}" href="{{ route('blockedUserList') }}">
                    <ion-icon name="people-outline"></ion-icon>
                    Unblock User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Route::is('user.logs') ? ' active' : '' }}" href="{{ route('user.logs') }}">
                    <ion-icon name="people-outline"></ion-icon>
                    Users logs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <ion-icon name="log-out-outline"></ion-icon>
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
