<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
    <title>Project Visualization | Daikin</title>

    {{-- Load styles from: public\css\project-visualization.css --}}
    <link rel="stylesheet" href="{{ asset('css/project-visualization.css') }}">
</head>

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
                                        <h6 class="mb-0 title-text">Project Visualization</h6>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
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
                                    </div>
                                </div>

                                {{-- Table --}}
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end gap-2 mb-4">
                                            <div class="col-md-auto">
                                                <button id="btn-chart" type="button" class="btn btn-primary"
                                                    onclick="showChart()">
                                                    <i class="ti ti-chart-pie me-1"></i>Chart
                                                </button>
                                            </div>

                                            <div class="col-md-auto">
                                                <button id="btn-list" type="button" class="btn btn-secondary"
                                                    onclick="showList()">
                                                    <i class="fa-solid fa-list-ul me-1"></i> List
                                                </button>
                                            </div>
                                        </div>

                                        <div id="list-view">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered custom-table">
                                                    <thead class="table-light">
                                                        <tr class="text-center align-middle">
                                                            <th>No.</th>
                                                            <th>Project Leader</th>
                                                            <th>Project Name</th>
                                                            <th>Test sample Received</th>
                                                            <th>Starting Test</th>
                                                            <th>Problem issue / Countermeasure</th>
                                                            <th>Test Finished</th>
                                                            <th>Issue Test report</th>
                                                            <th>Test Report</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="align-middle text-start">
                                                            <td>1</td>
                                                            <td>Leader 1</td>
                                                            <td>Project A</td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="progress position-relative"
                                                                    style="height: 20px;">
                                                                    <div class="progress-bar progress-bar-custom"
                                                                        style="width: 100%;"></div>
                                                                    <span class="progress-label">100%</span>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-square"><i
                                                                        class="ti ti-download"></i></a></td>
                                                        </tr>

                                                        <tr class="align-middle text-start">
                                                            <td>2</td>
                                                            <td>Leader 2</td>
                                                            <td>Project B</td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-progress"></span><span
                                                                        class="text-progress">In Progress</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-progress"></span><span
                                                                        class="text-progress">In Progress</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-risk"></span><span
                                                                        class="text-risk">Risk</span></div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="progress position-relative"
                                                                    style="height: 20px;">
                                                                    <div class="progress-bar progress-bar-custom"
                                                                        style="width: 87%;"></div>
                                                                    <span class="progress-label">87%</span>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-square"><i
                                                                        class="ti ti-download"></i></a></td>
                                                        </tr>

                                                        <tr class="align-middle text-start">
                                                            <td>3</td>
                                                            <td>Leader 3</td>
                                                            <td>Project C</td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-risk"></span><span
                                                                        class="text-risk">Risk</span></div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-risk"></span><span
                                                                        class="text-risk">Risk</span></div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-progress"></span><span
                                                                        class="text-progress">In
                                                                        Progress</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-risk"></span><span
                                                                        class="text-risk">Risk</span></div>
                                                            </td>
                                                            <td>
                                                                <div class="progress position-relative"
                                                                    style="height: 20px;">
                                                                    <div class="progress-bar progress-bar-custom"
                                                                        style="width: 15%;"></div>
                                                                    <span class="progress-label">15%</span>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-square"><i
                                                                        class="ti ti-download"></i></a></td>
                                                        </tr>

                                                        <tr class="align-middle text-start">
                                                            <td>4</td>
                                                            <td>Leader 4</td>
                                                            <td>Project D</td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-risk"></span><span
                                                                        class="text-risk">Risk</span></div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-progress"></span><span
                                                                        class="text-progress">In
                                                                        Progress</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="progress position-relative"
                                                                    style="height: 20px;">
                                                                    <div class="progress-bar progress-bar-custom"
                                                                        style="width: 25%;"></div>
                                                                    <span class="progress-label">25%</span>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-square"><i
                                                                        class="ti ti-download"></i></a></td>
                                                        </tr>

                                                        <tr class="align-middle text-start">
                                                            <td>5</td>
                                                            <td>Leader 5</td>
                                                            <td>Project E</td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-progress"></span><span
                                                                        class="text-progress">In
                                                                        Progress</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-progress"></span><span
                                                                        class="text-progress">In
                                                                        Progress</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="progress position-relative"
                                                                    style="height: 20px;">
                                                                    <div class="progress-bar progress-bar-custom"
                                                                        style="width: 65%;"></div>
                                                                    <span class="progress-label">65%</span>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-square"><i
                                                                        class="ti ti-download"></i></a></td>
                                                        </tr>

                                                        <tr class="align-middle text-start">
                                                            <td>6</td>
                                                            <td>Leader 6</td>
                                                            <td>Project F</td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-risk"></span><span
                                                                        class="text-risk">Risk</span></div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-complete"></span><span
                                                                        class="text-complete">Complete</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="status"><span
                                                                        class="dot dot-risk"></span><span
                                                                        class="text-risk">Risk</span></div>
                                                            </td>
                                                            <td>
                                                                <div class="progress position-relative"
                                                                    style="height: 20px;">
                                                                    <div class="progress-bar progress-bar-custom"
                                                                        style="width: 34%;"></div>
                                                                    <span class="progress-label">34%</span>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-square"><i
                                                                        class="ti ti-download"></i></a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div id="chart-view" style="display: none;">
                                            <div class="mt-5">
                                                {{-- Chart --}}
                                                <div class="container-chart">
                                                    <!-- Chart Section -->
                                                    <div class="row mb-5">
                                                        <!-- Pie Chart -->
                                                        <div
                                                            class="col-md-6 chart-col chart-section chart-section-left">
                                                            <h6 class="chart-header">Overall Status Summary</h6>
                                                            <div class="chart-adjust">
                                                                <div class="chart-wrapper">
                                                                    <!-- Spinner สำหรับ Pie -->
                                                                    <div id="spinner-pie" class="chart-spinner">
                                                                        <div class="spinner-border text-primary"
                                                                            role="status">
                                                                            <span
                                                                                class="visually-hidden">Loading...</span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Canvas Chart -->
                                                                    <canvas id="pieChart"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Bar Chart -->
                                                        <div class="col-md-6 chart-section chart-col">
                                                            <h6 class="chart-header">Overall Status (Stage)</h6>
                                                            <div class="bar-adjust">
                                                                <div class="chart-wrapper">
                                                                    <!-- Spinner สำหรับ Bar -->
                                                                    <div id="spinner-bar" class="chart-spinner">
                                                                        <div class="spinner-border text-primary"
                                                                            role="status">
                                                                            <span
                                                                                class="visually-hidden">Loading...</span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Canvas Chart -->
                                                                    <canvas id="barChart"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- Table --}}
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered custom-table">
                                                            <thead class="table-light">
                                                                <tr class="text-center align-middle">
                                                                    <th>No.</th>
                                                                    <th>Project Name</th>
                                                                    <th>Project Manager</th>
                                                                    <th>Start</th>
                                                                    <th>Finish</th>
                                                                    <th>Work Status</th>
                                                                    <th>Status Reporting</th>
                                                                    <th>Test sample Received</th>
                                                                    <th>Starting Test</th>
                                                                    <th>Problem issue / Countermeasure</th>
                                                                    <th>Test Finished</th>
                                                                    <th>Issue Test report</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- 🟦 RA Product -->
                                                                <tr style="background-color: #bee4f7;">
                                                                    <td colspan="12" class="text-start fw-semibold"
                                                                        style="color: #0086C7; font-size: 14px">RA
                                                                        Product
                                                                    </td>
                                                                </tr>

                                                                <tr class="text-center align-middle">
                                                                    <td>1</td>
                                                                    <td>Project A</td>
                                                                    <td>Fname Lname</td>
                                                                    <td>2025/06/11</td>
                                                                    <td>2025/06/15</td>
                                                                    <td>Requested</td>
                                                                    <td>3/14/25</td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr class="text-center align-middle">
                                                                    <td>2</td>
                                                                    <td>Project B</td>
                                                                    <td>Fname Lname</td>
                                                                    <td>2025/06/11</td>
                                                                    <td>2025/06/15</td>
                                                                    <td>Active</td>
                                                                    <td>3/14/25</td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-progress"></span><span
                                                                                class="text-progress">Waiting</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-progress"></span><span
                                                                                class="text-progress">Waiting</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr class="text-center align-middle">
                                                                    <td>3</td>
                                                                    <td>Project C</td>
                                                                    <td>Fname Lname</td>
                                                                    <td>2025/06/11</td>
                                                                    <td>2025/06/15</td>
                                                                    <td>Active</td>
                                                                    <td>3/14/25</td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-progress"></span><span
                                                                                class="text-progress">Waiting</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
                                                                </tr>

                                                                <!-- 🟦 QA_SKY Product -->
                                                                <tr style="background-color: #bee4f7;">
                                                                    <td colspan="12" class="text-start fw-semibold"
                                                                        style="color: #0086C7; font-size: 14px">QA_SKY
                                                                        Product</td>
                                                                </tr>

                                                                <tr class="text-center align-middle">
                                                                    <td>1</td>
                                                                    <td>Project D</td>
                                                                    <td>Fname Lname</td>
                                                                    <td>2025/06/11</td>
                                                                    <td>2025/06/16</td>
                                                                    <td>Requested</td>
                                                                    <td>3/14/25</td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-progress"></span><span
                                                                                class="text-progress">Waiting</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr class="text-center align-middle">
                                                                    <td>2</td>
                                                                    <td>Project E</td>
                                                                    <td>Fname Lname</td>
                                                                    <td>2025/06/11</td>
                                                                    <td>2025/06/16</td>
                                                                    <td>Active</td>
                                                                    <td>3/14/25</td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-progress"></span><span
                                                                                class="text-progress">Waiting</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-progress"></span><span
                                                                                class="text-progress">Waiting</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-progress"></span><span
                                                                                class="text-progress">Waiting</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr class="text-center align-middle">
                                                                    <td>3</td>
                                                                    <td>Project F</td>
                                                                    <td>Fname Lname</td>
                                                                    <td>2025/06/11</td>
                                                                    <td>2025/06/16</td>
                                                                    <td>Requested</td>
                                                                    <td>3/14/25</td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-complete"></span><span
                                                                                class="text-complete">Approved</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="status"><span
                                                                                class="dot dot-risk"></span><span
                                                                                class="text-risk">Rejected</span></div>
                                                                    </td>
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
    </div>

    <!-- / Layout wrapper -->
    @include('admin/layout/inc_js')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let chartInitialized = false;

        function showList() {
            document.getElementById("list-view").style.display = "block";
            document.getElementById("chart-view").style.display = "none";
            toggleButtons("list");
        }

        function showChart() {
            document.getElementById("chart-view").style.display = "block";
            document.getElementById("list-view").style.display = "none";
            toggleButtons("chart");

            if (!chartInitialized) {
                // Show spinner
                document.getElementById("spinner-pie").style.display = "block";
                document.getElementById("spinner-bar").style.display = "block";

                setTimeout(() => {
                    requestAnimationFrame(() => {
                        renderCharts(); // Create chart
                        chartInitialized = true;

                        // Hide spinner
                        document.getElementById("spinner-pie").style.display = "none";
                        document.getElementById("spinner-bar").style.display = "none";
                    });
                }, 300);
            }
        }

        function toggleButtons(view) {
            const btnList = document.getElementById("btn-list");
            const btnChart = document.getElementById("btn-chart");

            if (view === "chart") {
                btnChart.classList.replace("btn-primary", "btn-secondary");
                btnList.classList.replace("btn-secondary", "btn-primary");
            } else {
                btnList.classList.replace("btn-primary", "btn-secondary");
                btnChart.classList.replace("btn-secondary", "btn-primary");
            }
        }

        function renderCharts() {
            const pieCtx = document.getElementById('pieChart');
            const barCtx = document.getElementById('barChart');

            if (!pieCtx || !barCtx) return;

            const legendLabelStyle = {
                usePointStyle: true,
                pointStyle: 'circle',
                boxWidth: 12,
                padding: 30
            };

            // ✅ Chart Pie
            new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Complete', 'In Progress', 'Risk'],
                    datasets: [{
                        data: [12, 5, 3],
                        backgroundColor: ['#00c24a', '#f0c800', '#c30f15']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: 0
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: legendLabelStyle
                        }
                    }
                }
            });

            // ✅ Chart Bar
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['RA Product', 'QA_SKY Product', 'VRV Product'],
                    datasets: [{
                            label: 'Complete',
                            data: [7, 5, 3],
                            backgroundColor: '#00c24a'
                        },
                        {
                            label: 'In Progress',
                            data: [5, 5, 3],
                            backgroundColor: '#f0c800'
                        },
                        {
                            label: 'Risk',
                            data: [2, 1, 2],
                            backgroundColor: '#c30f15'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: legendLabelStyle
                        }
                    }
                }
            });
        }
    </script>

</body>

</html>