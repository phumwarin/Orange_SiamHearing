<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
    <title>Lab Availability | Daikin</title>

    {{-- Load styles from: public\css\lab-availability-index.css --}}
    <link rel="stylesheet" href="{{ asset('css/lab-availability-index.css') }}">
</head>

@php
    $currentMonth = now()->month;
    $currentYear = now()->year;
@endphp

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin/layout/inc_sidemenu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('admin/layout/inc_topmenu')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between container-chamber">
                                        <h6 class="mb-0 chamber-text">Chamber</h6>
                                        <button class="btn btn-primary buttons-collection waves-effect waves-light"
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button"
                                            aria-haspopup="dialog" aria-expanded="false" data-bs-toggle="modal"
                                            data-bs-target="#addserviceModal">
                                            <span><i class="ti ti-plus me-1"></i>Create a new job</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="card mb-3 mt-4">
                                    <div class="card-body">
                                        <!-- Nav tabs (main) -->
                                        <ul class="nav nav-tabs mb-3" id="labTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="calendar-tab" data-bs-toggle="tab"
                                                    data-bs-target="#calendar-tab-pane" type="button" role="tab"
                                                    aria-controls="calendar-tab-pane" aria-selected="true">
                                                    Calendar lab Booking EMC Chamber Room
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="request-tab" data-bs-toggle="tab"
                                                    data-bs-target="#request" type="button" role="tab"
                                                    aria-controls="request" aria-selected="false">
                                                    Test Request
                                                </button>
                                            </li>
                                        </ul>

                                        <!-- Tab content -->
                                        <div class="tab-content" id="labTabsContent">
                                            <!--  Calendar Tab -->
                                            <div class="tab-pane fade show active" id="calendar-tab-pane"
                                                role="tabpanel" aria-labelledby="calendar-tab">

                                                {{-- Filter: Month & Year --}}
                                                <div id="calendarFilter" class="row g-3 mb-3 align-items-end">
                                                    <!-- Month Select -->
                                                    <div class="col-3 mb-3">
                                                        <label for="selectMonth" class="form-label">Month</label>
                                                        <select id="selectMonth" class="form-select">
                                                            @for ($m = 1; $m <= 12; $m++)
                                                                <option value="{{ $m }}"
                                                                    {{ $m == $currentMonth ? 'selected' : '' }}>
                                                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>

                                                    <!-- Year Select -->
                                                    <div class="col-3 mb-3">
                                                        <label for="selectYear" class="form-label">Year</label>
                                                        <select id="selectYear" class="form-select">
                                                            @for ($year = now()->year; $year >= 2020; $year--)
                                                                <option value="{{ $year }}"
                                                                    {{ $year == $currentYear ? 'selected' : '' }}>
                                                                    {{ $year }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- FullCalendar -->
                                                <div id="calendar"></div>
                                            </div>

                                            <!-- Test Request Tab -->
                                            <div class="tab-pane fade" id="request" role="tabpanel"
                                                aria-labelledby="request-tab">
                                                <!-- Sub-tabs for Test Request -->
                                                <ul class="nav nav-tabs mb-3" id="testRequestSubTabs" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="list-tab"
                                                            data-bs-toggle="tab" data-bs-target="#list" type="button"
                                                            role="tab" aria-controls="list" aria-selected="true">
                                                            <span class="tab-label">List</span>
                                                        </button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="schedule-tab" data-bs-toggle="tab"
                                                            data-bs-target="#schedule" type="button" role="tab"
                                                            aria-controls="schedule" aria-selected="false">
                                                            <span class="tab-label">Schedule</span>
                                                        </button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="all-tab" data-bs-toggle="tab"
                                                            data-bs-target="#all" type="button" role="tab"
                                                            aria-controls="all" aria-selected="false">
                                                            <span class="tab-label">All</span>
                                                        </button>
                                                    </li>
                                                </ul>

                                                <!-- Sub-tab Content -->
                                                <div class="tab-content px-0" id="testRequestSubTabContent">
                                                    <div class="tab-pane fade show active" id="list"
                                                        role="tabpanel" aria-labelledby="list-tab">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-hover table-bordered custom-table">
                                                                <thead class="table-light">
                                                                    <tr class="text-center align-middle">
                                                                        <th>Project</th>
                                                                        <th>Purpose</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="10" class="text-center">No data
                                                                            available</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="schedule" role="tabpanel"
                                                        aria-labelledby="schedule-tab">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-hover table-bordered custom-table">
                                                                <thead class="table-light">
                                                                    <tr class="text-center align-middle">
                                                                        <th>Test date request</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="10" class="text-center">No data
                                                                            available</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="all" role="tabpanel"
                                                        aria-labelledby="all-tab">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-hover table-bordered custom-table">
                                                                <thead class="table-light">
                                                                    <tr class="text-center align-middle">
                                                                        <th>Project</th>
                                                                        <th>Purpose</th>
                                                                        <th>Request from</th>
                                                                        <th>Test date request</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="10" class="text-center">No data
                                                                            available</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin/layout/inc_footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    <!-- / Layout wrapper -->
    @include('admin/layout/inc_js')
    <script src="{{ asset('dist/js/app.js') }}"></script>
</body>

</html>
