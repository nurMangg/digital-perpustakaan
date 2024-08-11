@props(['menuItems', 'active'])

<nav id="sidebar" class="active">
    <div class="sidebar-header">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="bootraper logo" class="app-logo">
    </div>
    <ul class="list-unstyled components text-secondary">
        @foreach($menuItems as $item)
            <li class="{{ $active == $item['route'] ? 'active' : '' }}">
                <a href="{{ route($item['route']) }}">
                    <i class="{{ $item['icon'] }}"></i> {{ $item['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
