@extends('layouts.default')

@section('content')
    <div class="cities">
        @if($geoItems->isNotEmpty())

            <div class="cities__wrap">

                @foreach($geoItems as $country)

                    <div class="cities__column">
                        <p class="cities__item">{{ $country->title }}</p>

                        <div class="cities__areas">
                            @foreach($country->areas as $area)
                                <p class="cities__item">{{ $area->title }}</p>

                                @if($area->cities->isNotEmpty())
                                    <div class="cities__items">
                                        @foreach($area->cities as $city)
                                            <a href="{{ '/'.$city->slug }}" class="cities__item cities__link {{ $city->slug == ($locale_slug ?? null) ? '_active' : '' }}">{{ $city->title }}</a>
                                        @endforeach
                                    </div>
                                @endif

                            @endforeach
                        </div>
                    </div>

                @endforeach

            </div>

        @else
            Нет городов
        @endif
    </div>

@stop
