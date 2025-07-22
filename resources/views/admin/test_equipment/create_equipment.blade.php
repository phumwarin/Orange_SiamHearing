<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Global CSS & JS Assets -->
    @include('admin/layout/inc_header')
    <title>Create New Equipment | Daikin</title>
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

    .btn.btn-primary:focus {
        background-color: #007fc2 !important;
        border-color: #007fc2 !important;
    }

    .form-label {
        font-weight: 450;
    }

    .swal2-popup.rounded-alert {
        border-radius: 20px !important;
    }
</style>

<body>
    <!-- Layout Wrapper (Overall Page Container) -->
    <div class="layout-wrapper layout-content-navbar">

        <!-- Main Layout Container (Split Sidebar + Content) -->
        <div class="layout-container">

            <!-- Sidebar Menu (Left Navigation) -->
            @include('admin/layout/inc_sidemenu')

            <!-- Main Content Area (Right Panel) -->
            <div class="layout-page">

                <!-- Top Navigation Bar -->
                @include('admin/layout/inc_topmenu')

                <!-- Main Content Wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <form method="POST"
                            action="{{ isset($equipment) ? url('admin/test-equipment/' . $equipment->id) : url('admin/test-equipment') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($equipment))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-sm-12">
                                    {{-- Breadcrumb & Back Button --}}
                                    <div class="card mb-3">
                                        <div class="card-header d-flex justify-content-between container-title">
                                            <h6 class="mb-0 title-text">
                                                <a href="{{ url('admin/test-equipment') }}"
                                                    class="text-decoration-none text-dark">
                                                    Test Equipment
                                                </a>
                                                <span class="text-muted"> / </span>
                                                <span style="color: #0096e0;">
                                                    {{ isset($equipment) ? 'Edit Equipment' : 'Create New Equipment' }}
                                                </span>
                                            </h6>

                                            <!-- Save Button -->
                                            <div>
                                                <button type="button" class="btn btn-primary" id="confirmSubmitBtn">
                                                    <span><i class="fa-regular fa-floppy-disk me-2"></i>Save</span>
                                                </button>
                                                <a href="{{ url('admin/test-equipment') }}"
                                                    class="btn btn-secondary ms-2">
                                                    <i class="ti ti-arrow-left me-1"></i>Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Main Form Card -->
                                    <div class="card mb-3">
                                        <div class="card-body">

                                            <!-- Section Title -->
                                            <div class="row mb-5">
                                                <div class="col-md-12">
                                                    <label class="fw-bold mb-3">
                                                        {{ isset($equipment) ? 'EDIT TEST EQUIPMENT' : 'CREATE NEW TEST EQUIPMENT' }}
                                                    </label>
                                                </div>

                                                <!-- Description -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" class="form-control" name="description"
                                                        value="{{ old('description', $equipment->description ?? '') }}">
                                                </div>

                                                <!-- Asset Type -->
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Asset Type</label>
                                                    <select class="form-select" name="asset_type">
                                                        <option value="">เลือก Asset Type</option>
                                                        <option value="Type A" @selected(old('asset_type', $equipment->item_type ?? '') == 'Type A')>Type A
                                                        </option>
                                                        <option value="Type B" @selected(old('asset_type', $equipment->item_type ?? '') == 'Type B')>Type B
                                                        </option>
                                                    </select>
                                                </div>

                                                <!-- Location -->
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Location</label>
                                                    <select class="form-select" name="location">
                                                        <option value="">เลือก Location</option>
                                                        <option value="Lab A" @selected(old('location', $equipment->location ?? '') == 'Lab A')>Lab A
                                                        </option>
                                                        <option value="Lab B" @selected(old('location', $equipment->location ?? '') == 'Lab B')>Lab B
                                                        </option>
                                                    </select>
                                                </div>

                                                <!-- Manufacturer -->
                                                <div class="col-md-4">
                                                    <label class="form-label">Manufacturer</label>
                                                    <input type="text" class="form-control" name="manufacturer"
                                                        value="{{ old('manufacturer', $equipment->manufacturer ?? '') }}">
                                                </div>

                                                <!-- Brand -->
                                                <div class="col-md-4">
                                                    <label class="form-label">Brand</label>
                                                    <input type="text" class="form-control" name="brand"
                                                        value="{{ old('brand', $equipment->brand ?? '') }}">
                                                </div>

                                                <!-- Model -->
                                                <div class="col-md-4">
                                                    <label class="form-label">Model</label>
                                                    <input type="text" class="form-control" name="model"
                                                        value="{{ old('model', $equipment->model ?? '') }}">
                                                </div>
                                            </div>

                                            <!-- Barcode -->
                                            <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <label class="fw-bold mb-3">ASSET NUMBER</label>
                                                    <div class="mb-2">
                                                        <label class="form-label">Barcode</label>
                                                        <input type="text" class="form-control" name="barcode"
                                                            value="{{ old('barcode', $equipment->barcode ?? '') }}">
                                                    </div>

                                                    <!-- Radio Buttons -->
                                                    <div class="d-flex gap-4 mt-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="barcode_mode" id="autoMode" value="auto"
                                                                {{ old('barcode_mode', 'auto') == 'auto' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="autoMode"
                                                                style="font-size: 13px;">Automatic</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="barcode_mode" id="manualMode" value="manual"
                                                                {{ old('barcode_mode') == 'manual' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="manualMode"
                                                                style="font-size: 13px;">Manual</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Additional Fields -->
                                            <div class="row mb-5">
                                                <!-- DESCRIPTION -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="fw-bold mb-3">DESCRIPTION</label>
                                                    <textarea class="form-control" name="description" rows="2">{{ old('description', $equipment->description ?? '') }}</textarea>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Fix Asset.</label>
                                                    <input type="text" class="form-control" name="fix_asset"
                                                        value="{{ old('fix_asset', $equipment->fix_asset ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Supplier Name</label>
                                                    <input type="text" class="form-control" name="supplier_name"
                                                        value="{{ old('supplier_name', $equipment->supplier_name ?? '') }}">
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Equipment Name</label>
                                                    <input type="text" class="form-control" name="equipment_name"
                                                        value="{{ old('equipment_name', $equipment->equipment_name ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Price (THB)</label>
                                                    <input type="number" class="form-control" name="price"
                                                        value="{{ old('price', $equipment->price ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Brand</label>
                                                    <input type="text" class="form-control" name="brand"
                                                        value="{{ old('brand', $equipment->brand ?? '') }}">
                                                </div>

                                                <!-- Model Name / Calibration -->
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Model Name</label>
                                                    <input type="text" class="form-control" name="model_name"
                                                        value="{{ old('model_name', $equipment->model_name ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Calibration date</label>
                                                    <input type="date" class="form-control"
                                                        name="calibration_date"
                                                        value="{{ old('calibration_date', $equipment->calibration_date ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Calibration due date</label>
                                                    <input type="date" class="form-control"
                                                        name="calibration_due_date"
                                                        value="{{ old('calibration_due_date', $equipment->calibration_due_date ?? '') }}">
                                                </div>

                                                <!-- Serial / Cert / Alert -->
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Serial No.</label>
                                                    <input type="text" class="form-control" name="serial_no"
                                                        value="{{ old('serial_no', $equipment->serial_no ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Calibration certificate</label>
                                                    <input type="text" class="form-control"
                                                        name="calibration_certificate"
                                                        value="{{ old('calibration_certificate', $equipment->calibration_certificate ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Alert (Before)</label>
                                                    <select class="form-select" name="alert_before">
                                                        <option value="">กรุณาเลือก</option>
                                                        <option value="7" @selected(old('alert_before', $equipment->alert_before ?? '') == '7')>7 วัน
                                                        </option>
                                                        <option value="14" @selected(old('alert_before', $equipment->alert_before ?? '') == '14')>14 วัน
                                                        </option>
                                                        <option value="30" @selected(old('alert_before', $equipment->alert_before ?? '') == '30')>30 วัน
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">EMC Tag No.</label>
                                                        <input type="text" class="form-control" name="emc_tag_no"
                                                            value="{{ old('emc_tag_no', $equipment->emc_tag_no ?? '') }}">
                                                    </div>
                                                </div>

                                                <!-- Picture -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Picture</label>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <input type="file" class="d-none" id="pictureInput"
                                                                name="picture" accept="image/png, image/jpeg">
                                                            <button type="button" class="btn btn-primary"
                                                                onclick="document.getElementById('pictureInput').click();">
                                                                <i class="ti ti-upload me-2"></i> Upload file
                                                            </button>
                                                            <small class="text-muted">แนะนำไฟล์เป็น (jpg/png)</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Footer Section -->
                        @include('admin/layout/inc_footer')

                        <!-- Overlay Behind Content (for Modals or Menus) -->
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay Menu Trigger for Small Devices -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target for Mobile Slide-in Menu -->
        <div class="drag-target"></div>
    </div>

    <!-- Global JavaScript Inclusions -->
    @include('admin/layout/inc_js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const confirmBtn = document.getElementById('confirmSubmitBtn');

            if (confirmBtn) {
                confirmBtn.addEventListener('click', function() {
                    Swal.fire({
                        title: 'ยืนยันการบันทึก',
                        text: 'คุณต้องการบันทึกข้อมูลนี้ใช่หรือไม่?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'ตกลง',
                        cancelButtonText: 'ยกเลิก',
                        customClass: {
                            popup: 'rounded-alert'
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            confirmBtn.closest('form').submit();
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>
