@extends('layouts.app')

@section('title', 'การเคลมสินค้า')

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
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ข้อมูลการเคลมสินค้า</h5>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#claimModal">
                        <i class="ti ti-plus me-1"></i> เพิ่มการเคลมสินค้า
                    </button>
                </div>
            </div>

            {{-- Filter --}}
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
                                <label class="form-label">เลขที่ใบเคลม</label>
                                <input type="text" name="claim_no" class="form-control" value="{{ request('claim_no') }}"
                                    placeholder="เช่น CLAIM-0001">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">รหัสสินค้า</label>
                                <input type="text" name="product_code" class="form-control"
                                    value="{{ request('product_code') }}" placeholder="เช่น PRD-001">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ชื่อสินค้า</label>
                                <input type="text" name="product_name" class="form-control"
                                    value="{{ request('product_name') }}" placeholder="ชื่อหรือรุ่นสินค้า">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">สถานะการเคลม</label>
                                <select name="status" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>รอตรวจสอบ
                                    </option>
                                    <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>
                                        อยู่ระหว่างเคลม</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                        เคลมสำเร็จ</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>ปฏิเสธ
                                    </option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        ยกเลิก</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">สาขา</label>
                                <select name="branch_id" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="1" {{ request('branch_id') == '1' ? 'selected' : '' }}>กรุงเทพ
                                    </option>
                                    <option value="2" {{ request('branch_id') == '2' ? 'selected' : '' }}>เชียงใหม่
                                    </option>
                                    <option value="3" {{ request('branch_id') == '3' ? 'selected' : '' }}>ขอนแก่น
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100 me-2">
                                    <i class="ti ti-search me-1"></i> ค้นหา
                                </button>
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-100">
                                    <i class="ti ti-refresh me-1"></i> ล้างค่า
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table --}}
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>วันที่เคลม</th>
                                <th>เลขที่ใบเคลม</th>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวน</th>
                                <th>เหตุผลการเคลม</th>
                                <th>สถานะ</th>
                                <th>สาขา</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- รอตรวจสอบ --}}
                            <tr>
                                <td>1</td>
                                <td>2025-07-23</td>
                                <td>CLAIM-0001</td>
                                <td>PRD-001</td>
                                <td>เครื่องช่วยฟังรุ่น A</td>
                                <td>2</td>
                                <td>เสียงไม่ดัง</td>
                                <td><span class="badge bg-warning" style="font-size: 13px">รอตรวจสอบ</span></td>
                                <td>กรุงเทพ</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            {{-- อยู่ระหว่างเคลม --}}
                            <tr>
                                <td>2</td>
                                <td>2025-07-22</td>
                                <td>CLAIM-0002</td>
                                <td>PRD-002</td>
                                <td>แบตเตอรี่เบอร์ 13</td>
                                <td>1</td>
                                <td>บวมจากการชาร์จ</td>
                                <td><span class="badge bg-primary" style="font-size: 13px">อยู่ระหว่างเคลม</span></td>
                                <td>เชียงใหม่</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            {{-- เคลมสำเร็จ --}}
                            <tr>
                                <td>3</td>
                                <td>2025-07-21</td>
                                <td>CLAIM-0003</td>
                                <td>PRD-003</td>
                                <td>สายชาร์จเครื่องช่วยฟัง</td>
                                <td>3</td>
                                <td>ใช้งานไม่ติด</td>
                                <td><span class="badge bg-success" style="font-size: 13px">เคลมสำเร็จ</span></td>
                                <td>ขอนแก่น</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            {{-- ปฏิเสธ --}}
                            <tr>
                                <td>4</td>
                                <td>2025-07-20</td>
                                <td>CLAIM-0004</td>
                                <td>PRD-004</td>
                                <td>ถ่านเครื่องช่วยฟัง</td>
                                <td>5</td>
                                <td>หมดอายุการเก็บรักษา</td>
                                <td><span class="badge bg-danger" style="font-size: 13px">ปฏิเสธ</span></td>
                                <td>กรุงเทพ</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            {{-- ยกเลิก --}}
                            <tr>
                                <td>5</td>
                                <td>2025-07-19</td>
                                <td>CLAIM-0005</td>
                                <td>PRD-005</td>
                                <td>อแดปเตอร์ชาร์จ</td>
                                <td>1</td>
                                <td>ลูกค้าขอยกเลิกเคลม</td>
                                <td><span class="badge bg-secondary" style="font-size: 13px">ยกเลิก</span></td>
                                <td>เชียงใหม่</td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal เพิ่มการเคลม --}}
    <div class="modal fade" id="claimModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form action="javascript:void(0)">
                    <div class="modal-header">
                        <h5 class="modal-title">เพิ่มข้อมูลการเคลมสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">วันที่เคลม</label>
                                <input type="date" name="claim_date" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">เลขที่ใบเคลม</label>
                                <input type="text" name="claim_no" class="form-control"
                                    placeholder="เช่น CLAIM-0006">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">สาขา</label>
                                <select name="branch_id" class="form-select">
                                    <option value="">-- เลือกสาขา --</option>
                                    <option value="1">กรุงเทพ</option>
                                    <option value="2">เชียงใหม่</option>
                                    <option value="3">ขอนแก่น</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">รหัสสินค้า</label>
                                <input type="text" name="product_code" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">ชื่อสินค้า</label>
                                <input type="text" name="product_name" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">จำนวน</label>
                                <input type="number" name="quantity" class="form-control" min="1">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">สถานะ</label>
                                <select name="status" class="form-select">
                                    <option value="pending">รอตรวจสอบ</option>
                                    <option value="in-progress">อยู่ระหว่างเคลม</option>
                                    <option value="approved">เคลมสำเร็จ</option>
                                    <option value="rejected">ปฏิเสธ</option>
                                    <option value="cancelled">ยกเลิก</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">เหตุผลการเคลม</label>
                                <textarea name="claim_reason" class="form-control" rows="3" placeholder="กรอกรายละเอียดการเคลม..."></textarea>
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
