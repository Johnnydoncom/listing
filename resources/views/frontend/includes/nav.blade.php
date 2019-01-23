<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 .align-items-end" id="frontend-navbar">
    <div id="pg-hdr-foot"></div>
    <div class="container">
    <a href="{{ route('frontend.index') }}" class="navbar-brand">
        <img id="logo" class="d-inline-block mr-1" src="{{ asset('img/logo2.png') }}" alt="{{ app_name() }}">
    </a>

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

             {{--@if(config('locale.status') && count(config('locale.languages')) > 1)--}}
                {{--<li class="nav-item dropdown">--}}
                    {{--<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"--}}
                       {{--aria-haspopup="true" aria-expanded="false">@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</a>--}}

                    {{--@include('includes.partials.lang')--}}
                {{--</li>--}}
            {{--@endif--}}
            <li class="nav-item"><a href="{{route('frontend.index')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.index')) }}">Home</a></li>

            <li class="nav-item"><a href="{{route('frontend.cars-for-sale')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.cars-for-sale')) }}">Cars For Sale</a></li>
            <li class="nav-item"><a href="{{route('frontend.news')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.news')) }}">News</a></li>

            @auth
                <li class="nav-item"><a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}">@lang('navs.frontend.dashboard')</a></li>
            @endauth

           <!--  <li class="nav-item"><a href="{{route('frontend.contact')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.contact')) }}">@lang('navs.frontend.contact')</a></li> -->
        </ul>

        <form class="form-inline mx-2" method="get" action="{{ route('frontend.general.search') }}">
            <div class="input-group">
                <input class="form-control form-control-sm" name="q" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                 <button class="btn btn-outline-primary btn-sm my-sm-0" type="submit"><i class="fa fa-search"></i></button>
             </div>
            </div>  
        </form>

           <ul class="navbar-nav border-left-1">
            @guest
                <li class="nav-item"><a href="{{route('frontend.auth.login')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.login')) }}">@lang('navs.frontend.login')</a></li>

                @if(config('access.registration'))
                    <li class="nav-item"><a href="{{route('frontend.auth.register')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.register')) }}">@lang('navs.frontend.register')</a></li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"><span class="fa fa-user"></span>&nbsp;{{ $logged_in_user->name }}</a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                        @can('view backend')
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                        @endcan

                        <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.account')) }}">@lang('navs.frontend.user.account')</a>
                        <a href="{{ route('frontend.user.message.index') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.message.index')) }}">Messages</a>
                        <a href="{{ route('frontend.user.account.listing.index') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.account.listing.index')) }}">My Listings</a>
                        <a href="{{ route('frontend.user.account.news.index') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.account.news.index')) }}">My News Posts</a>
                        <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>
                    </div>
                </li>
            @endguest
           </ul>

    </div>
</div>
</nav>
