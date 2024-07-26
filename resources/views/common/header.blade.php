<header class="header">
    <div class="header__wrap">
        @include('common.navigation')

        <p class="header__city"> Выбранный город: <span>{{ $locale_title ?? 'Город не выбран' }}</span></p>
    </div>
</header>
