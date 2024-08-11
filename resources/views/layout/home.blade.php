@php
    $menuItems = [
        ['name' => 'Dashboard', 'route' => 'index', 'icon' => 'fas fa-home'],
        ['name' => 'Buku', 'route' => 'buku.index', 'icon' => 'fas fa-book'],
    ];

    if (auth()->user()->isAdmin()) {
        $menuItems[] = ['name' => 'Kategori Buku', 'route' => 'kategori-buku.index', 'icon' => 'fas fa-table'];
    }

    $activeRoute = request()->route()->getName();
    $userName = auth()->user()->name;
@endphp

@include('layout.header-component')

<div class="wrapper">
    <x-sidebar :menuItems="$menuItems" :active="$activeRoute" />
    <div id="body" class="active">
        <!-- navbar navigation component -->
        <nav class="navbar navbar-expand-lg navbar-white bg-white">
            <button type="button" id="sidebarCollapse" class="btn btn-light">
                <i class="fas fa-bars"></i><span></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ms-auto">
                    
                    <li class="nav-item dropdown">
                        <div class="nav-dropdown">
                            <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <span>{{ $userName }}</span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                <ul class="nav-list">
                                    {{-- <li><a href="" class="dropdown-item"><i class="fas fa-address-card"></i> Profile</a></li>
                                    <li><a href="" class="dropdown-item"><i class="fas fa-envelope"></i> Messages</a></li>
                                    <li><a href="" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a></li>
                                    <div class="dropdown-divider"></div> --}}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                    <li>
                                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- end of navbar navigation -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 page-header">
                        <div class="page-pretitle">Overview</div>
                        <h2 class="page-title">{{ $title }}</h2>
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('layout.footer-component')
