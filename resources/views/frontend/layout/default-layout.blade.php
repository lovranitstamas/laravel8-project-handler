<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('frontend.layout.head')

<body>

@include('frontend.layout.menu')


@yield('content')


@include('frontend.layout.footer')

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
