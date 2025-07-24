@extends('layouts.app')

@section('title', 'ข้อมูลผู้ใช้และสิทธิ์ | Siam Hearing')

@push('styles')
    <style>
        .table td,
        .table th {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
            text-transform: none;
        }

        .form-label {
            font-size: 14px;
        }

        .badge-font-size {
            font-size: 13px;
        }

        .permission-box {
            border: 1px solid #dbdade;
            background: #f9f9f9;
            border-radius: 6px;
            padding: 14px 16px;
        }

        .btn.btn-primary:hover,
        .btn.btn-primary:focus {
            background-color: #007fc2 !important;
            border-color: #007fc2 !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- Breadcrumb --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ข้อมูลผู้ใช้และสิทธิ์</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreateUser">
                        <i class="ti ti-plus me-1"></i> เพิ่มผู้ใช้ใหม่
                    </button>

                </div>
            </div>

            {{-- Filter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="{{ route('users.index') }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="keyword" class="form-label">ชื่อผู้ใช้ / อีเมล</label>
                                <input type="text" class="form-control" id="keyword" name="keyword"
                                    value="{{ request('keyword') }}" placeholder="ค้นหาชื่อผู้ใช้หรืออีเมล...">
                            </div>

                            <div class="col-md-3">
                                <label for="role" class="form-label">บทบาท (Role)</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="sales" {{ request('role') == 'sales' ? 'selected' : '' }}>เจ้าหน้าที่ขาย
                                    </option>
                                    <option value="stock" {{ request('role') == 'stock' ? 'selected' : '' }}>
                                        เจ้าหน้าที่คลัง</option>
                                    <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>ผู้บริหาร
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="status" class="form-label">สถานะ</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>เปิดใช้งาน
                                    </option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                        ปิดใช้งาน</option>
                                </select>
                            </div>

                            <div class="col-md-3 d-flex justify-content-end gap-2">
                                <button class="btn btn-primary" type="submit">
                                    <i class="ti ti-search me-1"></i> ค้นหา
                                </button>
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-refresh me-1"></i> ล้างค่า
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Users Table --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>ชื่อผู้ใช้</th>
                                    <th>อีเมล</th>
                                    <th>บทบาท (Role)</th>
                                    <th>สิทธิ์การเข้าถึง (Permissions)</th>
                                    <th>สถานะ</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 🔁 ตัวอย่างรายการ dummy --}}
                                <tr>
                                    <td>1</td>
                                    <td>สมชาย ใจดี</td>
                                    <td>somchai@example.com</td>
                                    <td><span class="badge bg-label-danger badge-font-size">Admin</span></td>
                                    <td>
                                        <span class="badge bg-secondary badge-font-size">ดูข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">เพิ่มข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">แก้ไขข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">ลบข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">อนุมัติข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">เข้าถึง Dashboard</span>
                                    </td>
                                    <td><span class="badge bg-success badge-font-size">เปิดใช้งาน</span></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"><i
                                                class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger"><i
                                                class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>จารุวรรณ พนักงาน</td>
                                    <td>jaruwan@example.com</td>
                                    <td><span class="badge bg-label-info badge-font-size">เจ้าหน้าที่ขาย</span></td>
                                    <td>
                                        <span class="badge bg-secondary badge-font-size">ดูข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">เพิ่มข้อมูล</span>
                                    </td>
                                    <td><span class="badge bg-success badge-font-size">เปิดใช้งาน</span></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"><i
                                                class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger"><i
                                                class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>อนงค์นาถ คลังสินค้า</td>
                                    <td>anong@example.com</td>
                                    <td><span class="badge bg-label-warning badge-font-size">เจ้าหน้าที่คลัง</span></td>
                                    <td>
                                        <span class="badge bg-secondary badge-font-size">ดูข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">เพิ่มข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">ลบข้อมูล</span>
                                    </td>
                                    <td><span class="badge bg-success badge-font-size">เปิดใช้งาน</span></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"><i
                                                class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger"><i
                                                class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>วิชัย ผู้บริหาร</td>
                                    <td>wichai@example.com</td>
                                    <td><span class="badge bg-label-success badge-font-size">ผู้บริหาร</span></td>
                                    <td>
                                        <span class="badge bg-secondary badge-font-size">ดูข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">ส่งออกข้อมูล</span>
                                        <span class="badge bg-secondary badge-font-size">เข้าถึง Dashboard</span>
                                        <span class="badge bg-secondary badge-font-size">เข้าถึงข้อมูลทุกสาขา</span>
                                    </td>
                                    <td><span class="badge bg-success badge-font-size">เปิดใช้งาน</span></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"><i
                                                class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger"><i
                                                class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>ปวีณา ชั่วคราว</td>
                                    <td>paweena@example.com</td>
                                    <td><span class="badge bg-label-info badge-font-size">เจ้าหน้าที่ขาย</span></td>
                                    <td>
                                        <span class="badge bg-secondary badge-font-size">ดูข้อมูล</span>
                                    </td>
                                    <td><span class="badge bg-danger badge-font-size">ปิดใช้งาน</span></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"><i
                                                class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger"><i
                                                class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: เพิ่มผู้ใช้ใหม่ --}}
    <div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateUserLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                {{-- <form action="{{ route('users.store') }}" method="POST"> --}}
                <form action="javascript:void(0)" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateUserLabel">เพิ่มผู้ใช้ใหม่</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">ชื่อ-นามสกุล</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">อีเมล</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">รหัสผ่าน</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">บทบาท (Role)</label>
                                <select name="role" class="form-select" required>
                                    <option value="" disabled selected>-- เลือกบทบาท --</option>
                                    <option value="admin">Admin</option>
                                    <option value="sales">เจ้าหน้าที่ขาย</option>
                                    <option value="stock">เจ้าหน้าที่คลัง</option>
                                    <option value="manager">ผู้บริหาร</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">สถานะ</label>
                                <select name="status" class="form-select" required>
                                    <option value="active">เปิดใช้งาน</option>
                                    <option value="inactive">ปิดใช้งาน</option>
                                </select>
                            </div>

                            @php
                                $permissions = [
                                    'view' => 'ดูข้อมูล',
                                    'create' => 'เพิ่มข้อมูล',
                                    'edit' => 'แก้ไขข้อมูล',
                                    'delete' => 'ลบข้อมูล',
                                    'export' => 'ส่งออกข้อมูล',
                                    'approve' => 'อนุมัติข้อมูล',
                                    'dashboard' => 'เข้าถึง Dashboard',
                                    'branch-access' => 'เข้าถึงข้อมูลทุกสาขา',
                                ];

                                $groupedPermissions = [
                                    'สิทธิ์พื้นฐาน' => [
                                        'view' => 'ดูข้อมูล',
                                        'create' => 'เพิ่มข้อมูล',
                                        'edit' => 'แก้ไขข้อมูล',
                                    ],
                                    'สิทธิ์ระดับสูง' => [
                                        'delete' => 'ลบข้อมูล',
                                        'export' => 'ส่งออกข้อมูล',
                                        'approve' => 'อนุมัติข้อมูล',
                                    ],
                                    'สิทธิ์การเข้าถึงภาพรวม/สาขา' => [
                                        'dashboard' => 'เข้าถึง Dashboard',
                                        'branch_access' => 'เข้าถึงข้อมูลทุกสาขา',
                                    ],
                                ];
                            @endphp

                            <div class="col-md-12">
                                <label class="form-label">สิทธิ์การเข้าถึง (Permissions)</label>
                                @php
                                    $groupedPermissions = [
                                        'สิทธิ์พื้นฐาน' => [
                                            'view' => 'ดูข้อมูล',
                                            'create' => 'เพิ่มข้อมูล',
                                            'edit' => 'แก้ไขข้อมูล',
                                        ],
                                        'สิทธิ์ระดับสูง' => [
                                            'delete' => 'ลบข้อมูล',
                                            'export' => 'ส่งออกข้อมูล',
                                            'approve' => 'อนุมัติข้อมูล',
                                        ],
                                        'สิทธิ์การเข้าถึงภาพรวม/สาขา' => [
                                            'dashboard' => 'เข้าถึง Dashboard',
                                            'branch_access' => 'เข้าถึงข้อมูลทุกสาขา',
                                        ],
                                    ];
                                @endphp

                                <div class="permission-box">
                                    @foreach ($groupedPermissions as $groupLabel => $permissions)
                                        <div class="mb-2">
                                            <p class="fw-semibold mb-2">{{ $groupLabel }}</p>
                                            <div class="row">
                                                @foreach ($permissions as $key => $label)
                                                    <div class="col-md-4 col-sm-6 mb-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="permissions[]" value="{{ $key }}"
                                                                id="perm-{{ $key }}">
                                                            <label class="form-check-label"
                                                                for="perm-{{ $key }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">
                            <i class="ti ti-device-floppy me-1"></i> บันทึก
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // script สำหรับการลบ / table toggle สามารถเพิ่มทีหลัง
    </script>
@endpush
