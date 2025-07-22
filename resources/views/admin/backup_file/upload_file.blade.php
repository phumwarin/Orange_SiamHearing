<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Global CSS & JS Assets -->
    @include('admin/layout/inc_header')
    <title>Backup File | Daikin</title>
</head>

<style>
    .title-text {
        align-self: center;
    }

    .upload-page input[type="file"]::file-selector-button {
        background-color: #dcdce0;
        border: none;
        padding: 10px 16px;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 12px;
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
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('backup-file.upload-file.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $parentId }}">

                                    <!-- Header -->
                                    <div class="card mb-3">
                                        <div class="card-header d-flex justify-content-between container-title">
                                            <h6 class="mb-0 title-text">Add file</h6>
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

                                    <!-- Upload Input -->
                                    <div class="upload-page">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="file_upload" class="form-label d-block mb-2">File</label>
                                                        <input type="file" id="file_upload" name="file_upload"
                                                            class="w-100" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer Section -->
                    @include('admin/layout/inc_footer')

                    <!-- Overlay Behind Content (for Modals or Menus) -->
                    <div class="content-backdrop fade"></div>
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
</body>

<script>
    // Sweet alert
    document.addEventListener('DOMContentLoaded', function () {
        const confirmBtn = document.getElementById('confirmSubmitBtn');

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function (e) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to proceed with this action?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, continue',
                    cancelButtonText: 'Cancel'
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
