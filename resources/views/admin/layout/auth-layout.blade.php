<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ url('') }}/assets/" data-template="vertical-menu-template">
<head>
    @include('admin.layout.inc_header')
    <link rel="stylesheet" href="{{ url('') }}/assets/vendor/css/pages/page-auth.css" />
</head>
<body>
    <div class="authentication-wrapper authentication-cover authentication-bg {{ request()->routeIs('register.index') ? 'register-mode' : '' }}">
        @yield('content')
    </div>

    <footer class="login-footer text-white d-flex justify-content-between align-items-center">
        <div>©DAIKIN INDUSTRIES, Ltd., 2025</div>
        <div><a href="javascript:void(0);" class="text-white">Privacy Policy</a></div>
    </footer>

    @include('admin.layout.inc_js')

    @yield('script')
</body>
</html>
