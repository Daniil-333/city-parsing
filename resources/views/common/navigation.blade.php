<nav class="menu">
    <a href="{{ route('main') }}" class="menu__link {{ request()->routeIs('main') ? '_active' : '' }}">Главная</a>

    <a href="{{ route('about') }}" class="menu__link {{ request()->routeIs('about') ? '_active' : '' }}">О нас</a>

    <a href="{{ route('news') }}" class="menu__link {{ request()->routeIs('news') ? '_active' : '' }}">Новости</a>
</nav>
