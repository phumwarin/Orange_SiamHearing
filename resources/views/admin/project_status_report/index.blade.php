<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
    <title>Project status Report | Daikin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/css/materialdesignicons.min.css">

    {{-- Load styles from: public\css\project-status-report.css --}}
    <link rel="stylesheet" href="{{ asset('css/project-status-report.css') }}">
</head>
<style>

</style>

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
                                    <div class="card-header d-flex justify-content-between container-title">
                                        <h6 class="mb-0 title-text">Project Table and TimeLine</h6>
                                    </div>
                                </div>

                                <!-- Status Boxes -->
                                <div class="row h-auto mb-3">
                                    <div class="col-md-3">
                                        <div class="card-timeline-1">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <span class="mdi mdi-cloud-check"></span>
                                                </div>
                                                <div class="d-flex flex-column align-items-end">
                                                    <small>Amount 4</small>
                                                    <h2 class="mb-0 card-percent-1">29%</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-timeline-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <i class="fa-solid fa-triangle-exclamation text-icon"></i>
                                                </div>
                                                <div class="d-flex flex-column align-items-end">
                                                    <small>Amount 2</small>
                                                    <h2 class="mb-0 card-percent-2">14%</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-timeline-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <i class="fa-solid fa-square-poll-vertical text-icon"></i>
                                                </div>
                                                <div class="d-flex flex-column align-items-end">
                                                    <small>Amount 2</small>
                                                    <h2 class="mb-0 card-percent-3">14%</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-timeline-4">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <i class="fa-solid fa-list-check"></i>
                                                </div>
                                                <div class="d-flex flex-column align-items-end">
                                                    <small>Amount 6</small>
                                                    <h2 class="mb-0 card-percent-4">43%</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- EMC Budget -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row align-items-center gx-3">
                                            <!-- Budget Title + Edit -->
                                            <div class="col-md-3">
                                                <h6 class="mb-3">EMC Calibration Budget</h6>
                                                <button type="button" class="btn btn-primary w-60">Edit</button>
                                            </div>

                                            <!-- Project -->
                                            <div class="col-md-3">
                                                <div class="text-start card-budget">
                                                    <small>Project</small>
                                                    <h2 class="mb-0 num-budget">1,000,000</h2>
                                                </div>
                                            </div>

                                            <!-- Actual -->
                                            <div class="col-md-3">
                                                <div class="text-start card-budget">
                                                    <small>Actual</small>
                                                    <h2 class="mb-0 num-budget">880,000</h2>
                                                </div>
                                            </div>

                                            <!-- Remainder -->
                                            <div class="col-md-3">
                                                <div class="text-start card-budget">
                                                    <small>Remainder</small>
                                                    <h2 class="mb-0 num-budget">120,000</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <!-- Month List -->
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label">Month</label>
                                                <select class="form-select">
                                                    <option value="">Select Month</option>
                                                    @foreach ([
                                                            '01' => 'January',
                                                            '02' => 'February',
                                                            '03' => 'March',
                                                            '04' => 'April',
                                                            '05' => 'May',
                                                            '06' => 'June',
                                                            '07' => 'July',
                                                            '08' => 'August',
                                                            '09' => 'September',
                                                            '10' => 'October',
                                                            '11' => 'November',
                                                            '12' => 'December',
                                                        ] as $key => $month)
                                                        <option value="{{ $key }}">{{ $month }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Year List -->
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label">Year</label>
                                                <select class="form-select">
                                                    <option value="">Select Year</option>
                                                    @for ($year = date('Y'); $year >= 2000; $year--)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- Textfield -->
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label">Keyword</label>
                                                <input type="text" class="form-control" placeholder="Keyword">
                                            </div>

                                            <!-- Search Button -->
                                            <div class="col-md-3 d-flex align-items-end mb-2">
                                                <button type="button" class="btn btn-primary w-100">
                                                    <i class="ti ti-search me-1"></i> Search
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Table --}}
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered custom-table">
                                                <thead class="table-light">
                                                    <tr class="text-center align-middle">
                                                        <th>Item</th>
                                                        <th>Project Name</th>
                                                        <th>Owner</th>
                                                        <th>Begin</th>
                                                        <th>Finish</th>
                                                        <th># of DAYS</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center align-middle">
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Test 1</td>
                                                        <td>ADS</td>
                                                        <td>5-May</td>
                                                        <td>6-May</td>
                                                        <td>1</td>
                                                        <td><span class="badge badge-status"
                                                                style="background: #16d904">Complete</span>
                                                        </td>
                                                        <td><button class="btn btn-info btn-square"><i
                                                                    class="ti ti-eye text-white"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Test 2</td>
                                                        <td>MUD</td>
                                                        <td>7-May</td>
                                                        <td>12-May</td>
                                                        <td>5</td>
                                                        <td><span class="badge badge-status"
                                                                style="background: #16d904">Complete</span>
                                                        </td>
                                                        <td><button class="btn btn-info btn-square"><i
                                                                    class="ti ti-eye text-white"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Test 3</td>
                                                        <td>UYR</td>
                                                        <td>13-May</td>
                                                        <td>20-May</td>
                                                        <td>7</td>
                                                        <td><span class="badge badge-status"
                                                                style="background: #16d904">Complete</span>
                                                        </td>
                                                        <td><button class="btn btn-info btn-square"><i
                                                                    class="ti ti-eye text-white"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Test 4</td>
                                                        <td>ADS</td>
                                                        <td>23-May</td>
                                                        <td>27-May</td>
                                                        <td>4</td>
                                                        <td><span class="badge badge-status"
                                                                style="background: #ff0000">Complete</span>
                                                        </td>
                                                        <td><button class="btn btn-info btn-square"><i
                                                                    class="ti ti-eye text-white"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Test 5</td>
                                                        <td>UYR</td>
                                                        <td>1-Jun</td>
                                                        <td>5-Jun</td>
                                                        <td>4</td>
                                                        <td><span class="badge badge-status"
                                                                style="background: #ffab3d">Complete</span>
                                                        </td>
                                                        <td><button class="btn btn-info btn-square"><i
                                                                    class="ti ti-eye text-white"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Test 6</td>
                                                        <td>ADS</td>
                                                        <td>26-Jun</td>
                                                        <td>29-Jun</td>
                                                        <td>3</td>
                                                        <td><span class="badge badge-status"
                                                                style="background: #b2b2b2">Complete</span>
                                                        </td>
                                                        <td><button class="btn btn-info btn-square"><i
                                                                    class="ti ti-eye text-white"></i></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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

</body>

</html>
