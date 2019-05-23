<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>PMI - @yield('title')</title>
    @include('frontoffice.partials._htmlheader')
</head>
<body>
{{--navbar--}}
@include('frontoffice.partials._nav')
{{--content--}}
@yield('content')
{{--footer--}}
@include('frontoffice.partials._footer')
@include('frontoffice.partials._javascript')
</body>
</html>