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
            {{-- Header + ปุ่ม --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ข้อมูลซัพพลายเออร์</h5>
                    <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createSupplierModal">
                        <i class="ti ti-plus me-1"></i> เพิ่มซัพพลายเออร์
                    </a>
                </div>
            </div>

            {{-- Filter: Supplier --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">วันที่เริ่มต้น</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">วันที่สิ้นสุด</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ชื่อซัพพลายเออร์</label>
                                <input type="text" name="supplier_name" class="form-control"
                                    placeholder="เช่น หจก.วัสดุไทย" value="{{ request('supplier_name') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">เลขที่เอกสารอ้างอิง</label>
                                <input type="text" name="reference_no" class="form-control" placeholder="PO-2025-001"
                                    value="{{ request('reference_no') }}">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">สาขา</label>
                                <select class="form-select" name="branch_id">
                                    <option value="">-- ทุกสาขา --</option>
                                    <option value="1" {{ request('branch_id') == '1' ? 'selected' : '' }}>กรุงเทพ
                                    </option>
                                    <option value="2" {{ request('branch_id') == '2' ? 'selected' : '' }}>เชียงใหม่
                                    </option>
                                    <option value="3" {{ request('branch_id') == '3' ? 'selected' : '' }}>ขอนแก่น
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ผู้รับผิดชอบ</label>
                                <select name="created_by" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    @foreach ($users ?? [] as $user)
                                        <option value="{{ $user->id }}"
                                            {{ request('created_by') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
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

            {{-- Table: Supplier --}}
            <div class="card mb-3">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>ชื่อซัพพลายเออร์</th>
                                <th>ประเภท</th>
                                <th>สาขา</th>
                                <th>เบอร์โทร</th>
                                <th>อีเมล</th>
                                <th>จังหวัด</th>
                                <th>สินค้า</th>
                                <th>วันที่เพิ่ม</th>
                                <th>ผู้รับผิดชอบ</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ตัวอย่างข้อมูล --}}
                            <tr>
                                <td>1</td>
                                <td>บริษัท เอ็นจิเนียริ่งซัพพลาย</td>
                                <td>อุปกรณ์</td>
                                <td>กรุงเทพ</td>
                                <td>02-222-1234</td>
                                <td>contact@supply.com</td>
                                <td>กรุงเทพฯ</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#supplierProductsModal"
                                        onclick="loadSupplierProducts('บริษัท เอ็นจิเนียริ่งซัพพลาย')">
                                        3 รายการ
                                    </a>
                                </td>
                                <td>2025-07-25</td>
                                <td>คุณสมศักดิ์</td>
                                <td><span class="badge bg-success" style="font-size: 13px">เปิดใช้งาน</span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>หจก. วัสดุอะไหล่ไทย</td>
                                <td>อะไหล่</td>
                                <td>เชียงใหม่</td>
                                <td>081-456-7890</td>
                                <td>-</td>
                                <td>เชียงใหม่</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-info">
                                        5 รายการ
                                    </a>
                                </td>
                                <td>2025-07-24</td>
                                <td>คุณอรพิน</td>
                                <td><span class="badge bg-secondary" style="font-size: 13px">ปิดใช้งาน</span></td>
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

    {{-- Modal: เพิ่มซัพพลายเออร์ --}}
    <div class="modal fade" id="createSupplierModal" tabindex="-1" aria-labelledby="createSupplierModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form id="supplierForm" method="POST" action="{{ url('admin/suppliers') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSupplierModalLabel">เพิ่มซัพพลายเออร์ใหม่</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>

                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row g-3">
                            {{-- ข้อมูลพื้นฐาน --}}
                            <div class="col-md-6">
                                <label class="form-label">ชื่อซัพพลายเออร์</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">ประเภท</label>
                                <select name="type" class="form-select" required>
                                    <option value="">-- เลือกประเภท --</option>
                                    <option value="equipment">อุปกรณ์</option>
                                    <option value="spare">อะไหล่</option>
                                    <option value="material">วัสดุ</option>
                                </select>
                            </div>

                            {{-- ข้อมูลติดต่อ --}}
                            <div class="col-md-6">
                                <label class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">อีเมล</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">จังหวัด</label>
                                <input type="text" name="province" class="form-control">
                            </div>

                            {{-- ข้อมูลระบบ --}}
                            <div class="col-md-6">
                                <label class="form-label">สาขา</label>
                                <select name="branch_id" class="form-select">
                                    <option value="">-- เลือกสาขา --</option>
                                    <option value="1">กรุงเทพ</option>
                                    <option value="2">เชียงใหม่</option>
                                    <option value="3">ขอนแก่น</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">ผู้รับผิดชอบ</label>
                                <select name="created_by" class="form-select">
                                    <option value="">-- เลือกผู้รับผิดชอบ --</option>
                                    @foreach ($users ?? [] as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">สถานะ</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" value="active"
                                        checked>
                                    <label class="form-check-label">เปิดใช้งาน</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" value="inactive">
                                    <label class="form-check-label">ปิดใช้งาน</label>
                                </div>
                            </div>

                            <div class="col-md-12">
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

    {{-- Modal ดูสินค้าของ Supplier --}}
    <div class="modal fade" id="supplierProductsModal" tabindex="-1" aria-labelledby="supplierProductsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        สินค้าที่รับจาก: <span id="supplierName" style="font-size: 18px"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                </div>

                <div class="modal-body">
                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ประเภท</th>
                                    <th>หน่วย</th>
                                    <th>ราคาสั่งซื้อ</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- ตัวอย่าง mockup --}}
                                <tr>
                                    <td>PRD001</td>
                                    <td>เครื่องช่วยฟัง A</td>
                                    <td>อุปกรณ์</td>
                                    <td>ชิ้น</td>
                                    <td>9,900.00</td>
                                    <td><span class="badge bg-success" style="font-size: 13px">เปิดใช้งาน</span></td>
                                </tr>
                                <tr>
                                    <td>PRD002</td>
                                    <td>แบตเตอรี่เครื่องช่วยฟัง</td>
                                    <td>อะไหล่</td>
                                    <td>กล่อง</td>
                                    <td>120.00</td>
                                    <td><span class="badge bg-success" style="font-size: 13px">เปิดใช้งาน</span></td>
                                </tr>
                                <tr>
                                    <td>PRD003</td>
                                    <td>สายชาร์จเฉพาะรุ่น</td>
                                    <td>วัสดุ</td>
                                    <td>ชุด</td>
                                    <td>390.00</td>
                                    <td><span class="badge bg-secondary" style="font-size: 13px">ปิดใช้งาน</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.getElementById('supplierForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert("ส่งข้อมูลซัพพลายเออร์ไปหลังบ้าน (Mockup)");
            this.submit();
        });

        function loadSupplierProducts(supplierName) {
            document.getElementById('supplierName').textContent = supplierName;

            // TODO: หากคุณต้องการโหลดข้อมูลจริงจาก backend
            // คุณสามารถใช้ Ajax มาดึงข้อมูลและแสดงใน <tbody> แทน mock ได้
        }
    </script>
@endsection
