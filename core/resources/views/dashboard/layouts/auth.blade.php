<!DOCTYPE html>
<html lang="{{ @Helper::currentLanguage()->code }}" dir="{{ @Helper::currentLanguage()->direction }}">
<head>
    @include('dashboard.layouts.head')
</head>
<body>
<div class="app auth_app" id="app">
    @yield('content')
</div>
@include('dashboard.layouts.foot')
</body>
</html>
