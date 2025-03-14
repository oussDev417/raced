<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="header-left">
                    <button id="sidebar-toggle" class="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="breadcrumb-wrapper">
                        @yield('breadcrumb')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="header-right">
                    <div class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(auth()->user()->image)
                                <img src="{{ asset('storage/users/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="user-avatar">
                            @else
                                <img src="{{ asset('assets/images/default-avatar.png') }}" alt="{{ auth()->user()->name }}" class="user-avatar">
                            @endif
                            <span class="user-name">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.users.edit', auth()->user()) }}">
                                    <i class="fas fa-user"></i> Mon profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                                    <i class="fas fa-cog"></i> Paramètres
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header> 