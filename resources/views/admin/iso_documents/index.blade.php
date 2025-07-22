<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
    <title>ISO Documents | Daikin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/css/materialdesignicons.min.css">

    {{-- Load styles from: public\css\iso-documents-index.css --}}
    <link rel="stylesheet" href="{{ asset('css/iso-documents-index.css') }}">
</head>

@php
    // Array icon & menu
    $menus = [
        ['icon' => 'fas fa-paste', 'label' => 'QM-TM'],
        ['icon' => 'fas fa-flask', 'label' => 'Lab Organization'],
        ['icon' => 'fas fa-file-lines', 'label' => 'CTF Documents'],
        ['icon' => 'fas fa-list', 'label' => 'Master List'],
        ['icon' => 'fas fa-wrench', 'label' => 'Calibration'],
        ['icon' => 'mdi mdi-folder-cog-outline', 'label' => 'Document Control'],
        ['icon' => 'far fa-check-circle', 'label' => 'Audit'],
        ['icon' => 'fas fa-users', 'label' => 'Management Review'],
        ['icon' => 'fas fa-person', 'label' => 'Man Power and Training'],
        ['icon' => 'fas fa-user', 'label' => 'Customer Complain'],
        ['icon' => 'fas fa-shopping-cart', 'label' => 'Purchasing Service'],
        ['icon' => 'fas fa-gear', 'label' => 'NON-CR / CAR'],
        ['icon' => 'fas fa-spinner', 'label' => 'Uncertainty'],
        ['icon' => 'mdi mdi-format-float-right', 'label' => 'ISO Format'],
        ['icon' => 'fas fa-project-diagram', 'label' => 'Test Procedure / WI'],
        ['icon' => 'far fa-folder', 'label' => 'Interlab Test'],
        ['icon' => 'far fa-pen-to-square', 'label' => 'Subcontract'],
    ];

    $chunkedMenus = array_chunk($menus, 4);
@endphp

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin/layout/inc_sidemenu')
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin/layout/inc_topmenu')
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between container-iso-document">
                                        <h6 class="mb-0 iso-text">ISO Documents</h6>
                                    </div>
                                </div>

                                {{-- Search --}}
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <form method="GET">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="search"
                                                        placeholder="">
                                                </div>

                                                <div class="col-md-3 d-flex align-items-end">
                                                    <button type="button" class="btn btn-primary w-100">
                                                        <i class="ti ti-search me-1"></i> Search
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Loop menu form array --}}
                                <div class="card mb-3">
                                    <div class="card-body card-iso-menu">
                                        @foreach ($chunkedMenus as $row)
                                            <div class="row mb-3">
                                                @foreach ($row as $menu)
                                                    <div class="col-md-3">
                                                        <div class="bg-iso-item rounded p-3">
                                                            <div class="d-flex flex-column align-items-start gap-2">

                                                                <div
                                                                    class="bg-iso-icon text-white p-2 rounded iso-icon-size">
                                                                    <i class="{{ $menu['icon'] }}"></i>
                                                                </div>

                                                                <div
                                                                    class="d-flex align-items-center justify-content-between w-100">
                                                                    <span
                                                                        class="text-iso-menu">{{ $menu['label'] }}</span>
                                                                    <a
                                                                        href="{{ url('/admin/iso-documents/manage/' . \Str::slug($menu['label'], '_')) }}">
                                                                        <i class="fas fa-cog text-muted ms-2"></i>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    @include('admin/layout/inc_footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    <!-- / Layout wrapper -->
    @include('admin/layout/inc_js')
</body>

</html>