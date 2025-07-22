<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
    <title>Test Equipment | Daikin</title>
</head>
<style>
    .table th {
        text-transform: none;
        font-size: 13px;
        color: #fff !important;
        background-color: #0096e0;
    }

    .table td {
        padding-top: 14px;
        padding-bottom: 14px;
    }

    .custom-table {
        border-collapse: collapse;
        border: 1px solid #dee2e6;
    }

    .custom-table th {
        white-space: nowrap;
    }

    .custom-table th,
    .custom-table td {
        border-left: none;
        border-right: none;
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

    .custom-table tr {
        border-left: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
    }

    .container-title {
        padding: 16px 24px;
    }

    .title-text {
        align-self: center;
    }

    .btn.btn-primary:hover {
        background-color: #007fc2 !important;
        border-color: #007fc2 !important;
    }

    .btn-square {
        width: 46px;
        height: 40px;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 6px;
    }

    .swal2-popup.rounded-alert {
        border-radius: 20px !important;
    }
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
                                        <h6 class="mb-0 title-text">Test Equipment</h6>
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

                                            <!-- Create New Equipment Button -->
                                            <div class="col-md-4 d-flex align-items-end justify-content-end">
                                                <a href="{{ url('admin/test-equipment/create') }}"
                                                    class="btn btn-primary buttons-collection waves-effect waves-light">
                                                    <i class="ti ti-plus me-1"></i> Create New Equipment
                                                </a>
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
                                                        <th>No.</th>
                                                        <th>ID</th>
                                                        <th>Item Type</th>
                                                        <th>Manufacturer</th>
                                                        <th>Model</th>
                                                        <th>DSN Name</th>
                                                        <th>S/N</th>
                                                        <th>Label</th>
                                                        <th>Purchase Date</th>
                                                        <th>Warr. Rem. days</th>
                                                        <th>User</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($equipments as $index => $equipment)
                                                        <tr class="text-center align-middle">
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $equipment->id }}</td>
                                                            <td>{{ $equipment->item_type }}</td>
                                                            <td>{{ $equipment->manufacturer }}</td>
                                                            <td>{{ $equipment->model }}</td>
                                                            <td>{{ $equipment->dsn_name }}</td>
                                                            <td>{{ $equipment->serial_no }}</td>
                                                            <td>{{ $equipment->label }}</td>
                                                            <td>
                                                                {{ $equipment->purchase_date ? \Carbon\Carbon::parse($equipment->purchase_date)->format('d/m/Y') : '-' }}
                                                            </td>
                                                            <td>{{ $equipment->warranty_remain }}</td>
                                                            <td>{{ $equipment->user }}</td>
                                                            <td>
                                                                {{-- Action buttons --}}
                                                                <div class="d-flex gap-1">
                                                                    {{-- Edit item --}}
                                                                    <a href="{{ route('test-equipment.edit', $equipment->id) }}"
                                                                        class="btn btn-sm btn-square"
                                                                        style="background-color: #f5ad26; color: #fff;">
                                                                        <i class="ti ti-pencil"></i>
                                                                    </a>

                                                                    {{-- Delete item --}}
                                                                    <form
                                                                        action="{{ route('test-equipment.destroy', $equipment->id) }}"
                                                                        method="POST" class="delete-form">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-sm delete-btn btn-square"
                                                                            style="background-color: #ff3239; color: #fff;">
                                                                            <i class="ti ti-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="12" class="text-center">No data available
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
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

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    position: 'center',
                    customClass: {
                        popup: 'rounded-alert'
                    }
                });
            });
        </script>
    @endif

    @if (session('deleted'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: '{{ session('deleted') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    position: 'center',
                    customClass: {
                        popup: 'rounded-alert'
                    },
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'ยืนยันการลบรายการ',
                        text: "ลบแล้วไม่สามารถกู้คืนได้!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'ตกลง',
                        cancelButtonText: 'ยกเลิก',
                        customClass: {
                            popup: 'rounded-alert'
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            btn.closest('form').submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
