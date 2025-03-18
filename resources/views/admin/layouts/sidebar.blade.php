<aside class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="RAONG" class="logo-img">
            <span class="logo-text">RACED ONG</span>
        </a>
        <button class="sidebar-close d-md-none">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="sidebar-user">
        <div class="user-info">
            @if(auth()->user()->image)
                <img src="{{ asset('storage/users/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="user-avatar">
            @else
                <img src="{{ asset('assets/images/default-avatar.png') }}" alt="{{ auth()->user()->name }}" class="user-avatar">
            @endif
            <div class="user-details">
                <h5 class="user-name">{{ auth()->user()->name }}</h5>
                <p class="user-role">Administrateur</p>
            </div>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav-list">
            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            
            <!-- STRUCTURE DU SITE -->
            <li class="nav-section-title">
                <span>Structure du site</span>
            </li>
            
            <!-- Pages -->
            <li class="nav-item {{ request()->routeIs('admin.pages.*') || request()->routeIs('admin.sections.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#pagesDropdown">
                    <i class="fas fa-file-alt"></i>
                    <span>Pages</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </a>
                <ul class="collapse nav-dropdown-list {{ request()->routeIs('admin.pages.*') || request()->routeIs('admin.sections.*') ? 'show' : '' }}" id="pagesDropdown">
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.pages.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-file"></i>
                            <span>Liste des pages</span>
                        </a>
                    </li>
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.sections.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.sections.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-puzzle-piece"></i>
                            <span>Types de sections</span>
                        </a>
                    </li>
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.generic_sections.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.generic_sections.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-puzzle-piece"></i>
                            <span>Sections génériques</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- Menus -->
            <li class="nav-item {{ request()->routeIs('admin.menus.*') || request()->routeIs('admin.menu_items.*') ? 'active' : '' }}">
                <a href="{{ route('admin.menus.index') }}" class="nav-link">
                    <i class="fas fa-bars"></i>
                    <span>Menus</span>
                </a>
            </li>
            
            <!-- CONTENU -->
            <li class="nav-section-title">
                <span>Contenu</span>
            </li>
            
            <!-- Actualités -->
            <li class="nav-item {{ request()->routeIs('admin.news-categories.*') || request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#newsDropdown">
                    <i class="fas fa-newspaper"></i>
                    <span>Actualités</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </a>
                <ul class="collapse nav-dropdown-list {{ request()->routeIs('admin.news-categories.*') || request()->routeIs('admin.news.*') ? 'show' : '' }}" id="newsDropdown">
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.news-categories.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.news-categories.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-tags"></i>
                            <span>Catégories</span>
                        </a>
                    </li>
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.news.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-newspaper"></i>
                            <span>Articles</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- Projets -->
            <li class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <a href="{{ route('admin.projects.index') }}" class="nav-link">
                    <i class="fas fa-project-diagram"></i>
                    <span>Projets</span>
                </a>
            </li>
            
            <!-- Rapports -->
            <li class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <a href="{{ route('admin.reports.index') }}" class="nav-link">
                    <i class="fas fa-file-pdf"></i>
                    <span>Rapports</span>
                </a>
            </li>
            
            <!-- Médias -->
            <li class="nav-item {{ request()->routeIs('admin.gallery.*') || request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#mediaDropdown">
                    <i class="fas fa-photo-video"></i>
                    <span>Médias</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </a>
                <ul class="collapse nav-dropdown-list {{ request()->routeIs('admin.gallery.*') || request()->routeIs('admin.sliders.*') ? 'show' : '' }}" id="mediaDropdown">
                    <!-- Sliders -->
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.sliders.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-images"></i>
                            <span>Sliders</span>
                        </a>
                    </li>
                    <!-- Galerie -->
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.gallery.index') || request()->routeIs('admin.gallery.create') || request()->routeIs('admin.gallery.edit') || request()->routeIs('admin.gallery.show') ? 'active' : '' }}">
                        <a href="{{ route('admin.gallery.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-image"></i>
                            <span>Images</span>
                        </a>
                    </li>
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.gallery.categories.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.gallery.categories.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-tags"></i>
                            <span>Catégories</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- ORGANISATION -->
            <li class="nav-section-title">
                <span>Organisation</span>
            </li>
            
            <!-- À propos -->
            <li class="nav-item {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <a href="{{ route('admin.about.edit') }}" class="nav-link">
                    <i class="fas fa-info-circle"></i>
                    <span>À propos</span>
                </a>
            </li>
            
            <!-- Équipe -->
            <li class="nav-item {{ request()->routeIs('admin.equipe-categories.*') || request()->routeIs('admin.equipes.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#equipeDropdown">
                    <i class="fas fa-user-friends"></i>
                    <span>Équipe</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </a>
                <ul class="collapse nav-dropdown-list {{ request()->routeIs('admin.equipe-categories.*') || request()->routeIs('admin.equipes.*') ? 'show' : '' }}" id="equipeDropdown">
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.equipe-categories.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.equipe-categories.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-tags"></i>
                            <span>Catégories</span>
                        </a>
                    </li>
                    <li class="nav-dropdown-item {{ request()->routeIs('admin.equipes.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.equipes.index') }}" class="nav-dropdown-link">
                            <i class="fas fa-users"></i>
                            <span>Membres</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- Témoignages -->
            <li class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link">
                    <i class="fas fa-comments"></i>
                    <span>Témoignages</span>
                </a>
            </li>

            <!-- Opportunités -->
            <li class="nav-item {{ request()->routeIs('admin.axes.*') ? 'active' : '' }}">
                <a href="{{ route('admin.axes.index') }}" class="nav-link">
                    <i class="fas fa-compass"></i>
                    <span>Opportunités</span>
                </a>
            </li>
            
            <!-- Statistiques -->
            <li class="nav-item {{ request()->routeIs('admin.stat-facts.*') ? 'active' : '' }}">
                <a href="{{ route('admin.stat-facts.index') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistiques</span>
                </a>
            </li>
            
            <!-- Partenaires -->
            <li class="nav-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                <a href="{{ route('admin.partners.index') }}" class="nav-link">
                    <i class="fas fa-handshake"></i>
                    <span>Partenaires</span>
                </a>
            </li>
            
            <!-- COMMUNICATION -->
            <li class="nav-section-title">
                <span>Communication</span>
            </li>
            
            <!-- Newsletters -->
            <li class="nav-item {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">
                <a href="{{ route('admin.newsletters.index') }}" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    <span>Newsletters</span>
                </a>
            </li>
            
            <!-- Bénévoles -->
            <li class="nav-item {{ request()->routeIs('admin.benevoles.*') ? 'active' : '' }}">
                <a href="{{ route('admin.benevoles.index') }}" class="nav-link">
                    <i class="fas fa-hands-helping"></i>
                    <span>Bénévoles</span>
                </a>
            </li>
            
            <!-- Messages -->
            <li class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                    <i class="fas fa-envelope-open-text"></i>
                    <span>Messages</span>
                </a>
            </li>
            
            <!-- ADMINISTRATION -->
            <li class="nav-section-title">
                <span>Administration</span>
            </li>
            
            <!-- Utilisateurs -->
            <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="fas fa-users-cog"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>
            
            <!-- Paramètres -->
            <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}" class="nav-link">
                    <i class="fas fa-cogs"></i>
                    <span>Paramètres</span>
                </a>
            </li>
        </ul>
    </nav>
</aside> 