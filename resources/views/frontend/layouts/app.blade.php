<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Car Listing Website')">
        <meta name="author" content="@yield('meta_author', 'JohnnyBits')">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}

        @stack('after-styles')
    </head>
    <body>
        <div id="app">
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav')

            <div class="container content">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
            <div class="clearfix"></div>
            <footer id="footer"> <!-- Footer section -->
                <div class="stripe"></div>
                <div class="container pt-3 pb-3">
                    <div class="row">
                        <div class="col-4 col-md-4 mt-auto mb-auto">
                            <a href="{{ route('frontend.index') }}" class="navbar-brand">
                            <img id="logo-footer" class="d-inline-block mr-1" src="{{ asset('img/logo2.png') }}" alt="{{ app_name() }}">
                            </a> 
                        </div>
                        <div class="col-4 col-md-2">
                            <h5>ABOUT</h5>
                            <ul class="nav flex-column footer-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('frontend.contact') }}">Company</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('frontend.news') }}">Demographics</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-4 col-md-2">
                            <h5>HELP</h5>
                            <ul class="nav flex-column footer-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('frontend.contact') }}">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('frontend.news') }}">News</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 text-center text-sm-right align-items-start mt-3 mt-md-auto align-items-md-end">
                            <a href="{{ route('frontend.privacy') }}">Privacy Policy</a> | <a href="{{ route('frontend.terms') }}">Terms of Use</a>
                           <br>
                            &copy; <?php echo date('Y'); ?> <a href="{{ url('/') }}">Griptorque.org</a>. All rights reserved.
                        </div>
                    </div>
                </div>
                
            </footer>
        </div><!-- #app -->
        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}
        @stack('after-scripts')

        @include('includes.partials.ga')
    </body>
</html>
