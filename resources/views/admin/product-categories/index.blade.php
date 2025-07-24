@extends('layouts.app')

@section('title', 'SiamHearing')

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

        .btn.btn-primary:hover {
            background-color: #007fc2 !important;
            border-color: #007fc2 !important;
        }

        .form-label {
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- Breadcrumb + ปุ่ม --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">หมวดสินค้า</h5>
                    <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createCategoryModal">
                        <i class="ti ti-plus me-1"></i> เพิ่มหมวดสินค้า
                    </a>
                </div>
            </div>

            {{-- Filter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">ชื่อหมวดหมู่</label>
                                <input type="text" name="name" class="form-control" placeholder="ค้นหาหมวดหมู่"
                                    value="{{ request('name') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">สถานะ</label>
                                <select name="status" class="form-select">
                                    <option value="">-- ทุกสถานะ --</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>เปิดใช้งาน
                                    </option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                        ปิดใช้งาน</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">ประเภทสินค้า</label>
                                <select name="type" class="form-select">
                                    <option value="">-- ทุกประเภท --</option>
                                    <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>ทั่วไป
                                    </option>
                                    <option value="special" {{ request('type') == 'special' ? 'selected' : '' }}>รุ่นพิเศษ
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label d-block">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary w-50">
                                        <i class="ti ti-search me-1"></i> ค้นหา
                                    </button>
                                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-50">
                                        <i class="ti ti-refresh me-1"></i> ล้างค่า
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table --}}
            <div class="card mb-3">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>ชื่อหมวดสินค้า</th>
                                <th>ประเภท</th>
                                <th>สถานะ</th>
                                <th>หมายเหตุ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ตัวอย่างข้อมูล (Dummy) --}}
                            <tr>
                                <td>1</td>
                                <td>อะไหล่</td>
                                <td>ทั่วไป</td>
                                <td><span class="badge bg-success" style="font-size: 13px">เปิดใช้งาน</span></td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>อุปกรณ์</td>
                                <td>รุ่นพิเศษ</td>
                                <td><span class="badge bg-secondary" style="font-size: 13px">เปิดใช้งาน</span></td>
                                <td>กลุ่มสินค้าหลัก</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal สำหรับเพิ่มหมวดสินค้า --}}
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form id="categoryForm" method="POST" action="{{ url('admin/product-categories') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCategoryModalLabel">เพิ่มหมวดสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">ชื่อหมวดสินค้า</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">ประเภทสินค้า</label>
                                <select name="type" class="form-select">
                                    <option value="">-- เลือกประเภท --</option>
                                    <option value="general">ทั่วไป</option>
                                    <option value="special">รุ่นพิเศษ</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">สถานะ</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="active" checked>
                                    <label class="form-check-label">เปิดใช้งาน</label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="status" value="inactive">
                                    <label class="form-check-label">ปิดใช้งาน</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">หมายเหตุ</label>
                                <textarea name="note" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-device-floppy me-1"></i> บันทึก
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('categoryForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert("ส่งข้อมูลไปหลังบ้าน (Mockup)");
            // TODO: ส่งด้วย fetch/ajax หรือให้ form submit ตามจริง
            this.submit();
        });
    </script>
@endsection
