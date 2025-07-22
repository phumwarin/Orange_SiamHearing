<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
    <title>Backup File | Daikin</title>

    {{-- Load styles from: public\css\backup-file-index.css --}}
    <link rel="stylesheet" href="{{ asset('css/backup-file-index.css') }}">
</head>

@php
    use App\Models\BackupFolder;

    // ตรวจสอบระดับความลึกของโฟลเดอร์
    $depth = 0;
    $current = $parentId ? BackupFolder::find($parentId) : null;
    while ($current && $current->parent_id) {
        $depth++;
        $current = BackupFolder::find($current->parent_id);
    }

    // เช็คว่าอยู่ในโหมด Add File หรือไม่
    $isAddFileMode = $parentId && $depth >= 1;

    $buttonUrl = $isAddFileMode
        ? route('backup-file.upload-file', ['parent_id' => $parentId])
        : route('backup-file.create-folder', ['parent_id' => $parentId]);

    // ฟังก์ชันแปลงหน่วยของขนาดไฟล์ (bytes → KB/MB/GB)
    function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        if ($bytes <= 0) {
            return '0 B';
        }

        $pow = floor(log($bytes, 1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= 1 << 10 * $pow;

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    // สร้าง path โฟลเดอร์ (breadcrumbs)
    $path = [];
    $current = \App\Models\BackupFolder::find($parentId);
    while ($current) {
        $path[] = $current->name;
        $current = $current->parent;
    }
    $path = array_reverse($path);
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
                                    <div
                                        class="card-header d-flex justify-content-between align-items-center container-create-folder">
                                        <div class="backup-file-text">
                                            {{-- Breadcrumb --}}
                                            <h6 class="d-inline mb-0">
                                                <a href="{{ route('backup-file.index') }}"
                                                    class="text-decoration-none text-dark">Backup file</a>
                                            </h6>
                                            @if ($parentId)
                                                @php
                                                    $breadcrumbItems = [];
                                                    $current = \App\Models\BackupFolder::find($parentId);

                                                    while ($current) {
                                                        $breadcrumbItems[] = [
                                                            'name' => $current->name,
                                                            'id' => $current->id,
                                                            'parent_id' => $current->parent_id,
                                                        ];
                                                        $current = $current->parent;
                                                    }

                                                    $breadcrumbItems = array_reverse($breadcrumbItems);
                                                @endphp

                                                @foreach ($breadcrumbItems as $index => $item)
                                                    <span class="text-muted"> / </span>
                                                    @if ($index === count($breadcrumbItems) - 1)
                                                        <span class="folder-selected">{{ $item['name'] }}</span>
                                                    @else
                                                        <a href="{{ route('backup-file.index', ['parentId' => $item['id']]) }}"
                                                            class="text-decoration-none folder-selected">{{ $item['name'] }}</a>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="d-flex gap-2">
                                            {{-- Create & Add file button --}}
                                            <a href="{{ $buttonUrl }}"
                                                class="btn btn-primary buttons-collection waves-effect waves-light"
                                                tabindex="0" aria-controls="DataTables_Table_0">
                                                <span><i class="ti ti-plus me-1"></i>
                                                    {{ $isAddFileMode ? 'Add file' : 'Create new Folder' }}
                                                </span>
                                            </a>

                                            {{-- Back Button --}}
                                            @if ($parentId)
                                                @php
                                                    $current = \App\Models\BackupFolder::find($parentId);
                                                    $backToId = $current->parent_id ?? null;
                                                @endphp

                                                <a href="{{ $backToId ? route('backup-file.index', ['parentId' => $backToId]) : route('backup-file.index') }}"
                                                    class="btn btn-secondary">
                                                    <i class="ti ti-arrow-left me-1"></i>Back
                                                </a>
                                            @endif
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
                                                        @if ($folders->count() > 0 || !isset($files) || $files->count() == 0)
                                                            <th>Folder Name</th>
                                                            <th>Date Modified</th>
                                                            <th>Action</th>
                                                        @elseif (isset($files) && $files->count() > 0)
                                                            <th>File Name</th>
                                                            <th>Date Modified</th>
                                                            <th>Type</th>
                                                            <th>Size</th>
                                                            <th>Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($folders as $index => $folder)
                                                        <tr class="text-center align-middle">
                                                            <td>{{ $folders->firstItem() + $index }}</td>
                                                            <td class="text-start">{{ $folder->name }}</td>
                                                            <td>{{ $folder->updated_at->format('d M Y') }}</td>
                                                            <td>
                                                                @php
                                                                    $isFirstLevel =
                                                                        $folder->parent &&
                                                                        $folder->parent->parent_id === null;
                                                                @endphp
                                                                <a href="{{ route('backup-file.index', ['parentId' => $folder->id]) }}"
                                                                    class="btn btn-sm btn-square"
                                                                    style="background-color: {{ $isFirstLevel ? '#ffab3e' : '#0cbfc2' }}; color: white;">
                                                                    <i class="ti ti-file-export"></i>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                    @empty
                                                        @forelse ($files as $index => $file)
                                                            <tr class="text-center align-middle">
                                                                <td>{{ $files->firstItem() + $index }}</td>
                                                                <td class="text-start">{{ $file->file_name }}</td>
                                                                <td>{{ $file->updated_at->format('d M Y') }}</td>
                                                                <td>
                                                                    @php
                                                                        $mime = $file->file_type;
                                                                        $map = [
                                                                            'application/pdf' => 'PDF',
                                                                            'application/msword' => 'Word',
                                                                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' =>
                                                                                'Word',
                                                                            'application/vnd.ms-excel' => 'Excel',
                                                                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' =>
                                                                                'Excel',
                                                                            'image/png' => 'PNG',
                                                                            'image/jpeg' => 'JPG',
                                                                            'video/mp4' => 'MP4',
                                                                        ];
                                                                    @endphp

                                                                    {{ $map[$mime] ?? ($mime ?? '-') }}
                                                                </td>
                                                                <td>{{ formatBytes($file->file_size) }}</td>
                                                                <td>
                                                                    <a href="{{ asset('storage/' . $file->file_path) }}"
                                                                        class="btn btn-sm btn-square" target="_blank"
                                                                        style="background-color: #0cbfc2; color: white;">
                                                                        <i class="ti ti-eye"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center">No data available
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    @endforelse
                                                </tbody>
                                            </table>

                                            {{-- Pagination --}}
                                            <div class="paginate-containter">
                                                @if ($folders->count() > 0)
                                                    <label>
                                                        Showing {{ $folders->firstItem() }} to
                                                        {{ $folders->lastItem() }} of {{ $folders->total() }} folders
                                                    </label>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        {{ $folders->withQueryString()->links() }}
                                                    </div>
                                                @elseif (isset($files) && $files->count() > 0)
                                                    <label>
                                                        Showing {{ $files->firstItem() }} to {{ $files->lastItem() }}
                                                        of {{ $files->total() }} files
                                                    </label>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        {{ $files->withQueryString()->links() }}
                                                    </div>
                                                @endif
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

    {{-- Sweet Alert --}}
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
                    },
                });
            });
        </script>
    @endif
</body>

</html>
