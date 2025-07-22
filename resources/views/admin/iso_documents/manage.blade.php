<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
    <title>ISO Documents | Daikin</title>

    {{-- Load styles from: public/css/iso-documents.css --}}
    <link rel="stylesheet" href="{{ asset('css/iso-documents.css') }}">
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
                                {{-- Breadcrumb & Back Button --}}
                                <div class="card mb-3">
                                    <div
                                        class="card-header d-flex justify-content-between align-items-center container-iso-document">
                                        <div class="iso-text">
                                            <h6 class="d-inline mb-0">
                                                <a href="{{ url('/admin/iso-documents') }}"
                                                    class="text-decoration-none text-dark">
                                                    ISO Documents
                                                </a>
                                            </h6>
                                            <span class="text-muted"> / </span>
                                            <span class="document-selected">{{ $label }}</span>
                                            <span class="text-muted"> / </span>
                                            <span class="text-dark">Action</span>
                                        </div>

                                        <a href="{{ url('/admin/iso-documents') }}" class="btn btn-secondary ms-2">
                                            <i class="ti ti-arrow-left me-1"></i>Back
                                        </a>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Search Input -->
                                            <div class="col-md-5">
                                                <input type="text" class="form-control">
                                            </div>

                                            <!-- Search Button -->
                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="button" class="btn btn-primary w-100">
                                                    <i class="ti ti-search me-1"></i> Search
                                                </button>
                                            </div>

                                            <!-- Add File Button -->
                                            <div class="col-md-4 d-flex align-items-end justify-content-end">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addFileModal">
                                                    <i class="ti ti-plus me-1"></i> Add file
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Table --}}
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered custom-table">
                                                <thead class="table-light">
                                                    <tr class="text-center align-middle">
                                                        <th>Item</th>
                                                        <th>Document Name</th>
                                                        <th>Issue Date</th>
                                                        <th>Effective Date</th>
                                                        <th>Revised Date</th>
                                                        <th>Approved by</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="10" class="text-center">No data available</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add File Modal -->
                                <div class="modal fade" id="addFileModal" tabindex="-1"
                                    aria-labelledby="addFileModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0 pb-0">
                                                <div
                                                    class="d-flex justify-content-between align-items-start w-100 mb-4 mt-2">
                                                    <div>
                                                        <h5 class="modal-title fw-bold" id="addFileModalLabel">ADD NEW
                                                            FILE</h5>
                                                    </div>
                                                    <button type="button"
                                                        class="position-absolute top-0 end-0 mt-3 me-3 border-0 bg-transparent"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="ti ti-x fs-4"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="modal-body py-0 mb-3">
                                                <label for="uploadFile" class="form-label">File</label>
                                                <div class="position-relative">
                                                    <label for="uploadFile"
                                                        class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"
                                                        style="cursor: pointer;">
                                                        <i class="ti ti-upload"></i>
                                                    </label>

                                                    <input type="file" class="form-control ps-5" id="uploadFile"
                                                        name="file">
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-center border-top-0">
                                                <button type="button" class="btn btn-secondary px-4"
                                                    data-bs-dismiss="modal">back</button>
                                                <button type="submit" class="btn btn-success px-4"
                                                    form="uploadFileForm">Add</button>
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
</body>

</html>
