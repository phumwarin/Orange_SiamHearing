<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Custom Font for All System -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom-font.css') }}">

    <title>@yield('title', 'SiamHearing')</title>

    {{-- 🔽 ส่วนรวม CSS & Config --}}
    @include('admin.layout.inc_header')

    {{-- 🔽 ส่วน Switcher ต่าง ๆ (ใช้ตามต้องการ) --}}
    {{-- @include('admin.layout.components.main-color-switcher') --}}
    {{-- @include('admin.layout.components.dark-mode-switcher') --}}
    {{-- @include('admin.layout.components.mobile-menu') --}} {{-- สำหรับ mobile view --}}
    @stack('styles')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- 🔽 Side Menu --}}
            @include('admin.layout.inc_sidemenu')

            <div class="layout-page">

                {{-- 🔽 Top Menu --}}
                @include('admin.layout.inc_topmenu')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>

                    {{-- 🔽 Footer --}}
                    @include('admin.layout.inc_footer')

                    {{-- 🔽 Overlay --}}
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        {{-- 🔽 Drag target (mobile menu support) --}}
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>

    {{-- 🔽 Global JS --}}
    @include('admin.layout.inc_js')

    @yield('script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.querySelector(".menu-inner"); // ใช้ menu-inner แทน layout-menu
            const savedScroll = localStorage.getItem("sidebar-scroll");

            if (sidebar && savedScroll) {
                sidebar.scrollTop = parseInt(savedScroll);
            }

            if (sidebar) {
                sidebar.addEventListener("scroll", function() {
                    localStorage.setItem("sidebar-scroll", sidebar.scrollTop);
                });
            }
        });
    </script>
</body>

</html>
