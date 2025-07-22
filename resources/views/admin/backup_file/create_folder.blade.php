<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('admin/layout/inc_header')
    <title>Backup File | Daikin</title>
</head>

<style>
    .container-title {
        padding: 16px 24px;
    }

    .title-text {
        align-self: center;
    }

    .form-label {
        font-weight: 450;
    }

    .swal2-popup.rounded-alert {
        border-radius: 20px !important;
    }
</style>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div class="layout-container">
                @include('admin/layout/inc_sidemenu')
                <div class="layout-page">
                    @include('admin/layout/inc_topmenu')
                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row ">
                                <div class="col-sm-12">
                                    <form action="{{ route('backup-file.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $parentId }}">

                                        <!-- Header -->
                                        <div class="card mb-3">
                                            <div
                                                class="card-header d-flex justify-content-between container-title">
                                                <h6 class="mb-0 title-text">Create Folder Backup File</h6>
                                                <div>
                                                    <button type="button" id="confirmSubmitBtn" class="btn btn-primary">
                                                        <span><i class="fa-regular fa-floppy-disk me-2"></i>Save</span>
                                                    </button>
                                                    <a href="{{ route('backup-file.index', ['parentId' => $parentId]) }}"
                                                        class="btn btn-secondary ms-2">
                                                        <i class="ti ti-arrow-left me-1"></i>Back
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Input -->
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="folder_name" class="form-label">Folder name</label>
                                                        <input type="text" class="form-control" id="folder_name"
                                                            name="folder_name" placeholder="Enter folder name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @include('admin/layout/inc_footer')
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
            <div class="drag-target"></div>
        </div>
    </div>
    @include('admin/layout/inc_js')
</body>

<script>
    // Sweet alert
    document.addEventListener('DOMContentLoaded', function () {
        const confirmBtn = document.getElementById('confirmSubmitBtn');

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function (e) {
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

</html>