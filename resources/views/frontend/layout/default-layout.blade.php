<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('frontend.layout.head')

<body class="d-flex flex-column">

@include('frontend.layout.menu')

<div class="container flex-grow-1 py-5">
    @yield('content')
</div>

@include('frontend.layout.footer')

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
</body>
</html>
