@extends('layouts.app')

@section('title', 'รายงานสินค้าคงเหลือ')

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

        .card-hover:hover {
            background-color: #f4f6f9;
            cursor: pointer;
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
        <div class="col-12">
            {{-- Header --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">รายงานสินค้าคงเหลือ</h5>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i> ย้อนกลับ
                    </a>
                </div>
            </div>

            {{-- Filter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">เลือกสาขา</label>
                                <select name="branch_id" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="1">สำนักงานใหญ่</option>
                                    <option value="2">สาขาเชียงใหม่</option>
                                    <option value="3">สาขาขอนแก่น</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">หมวดหมู่สินค้า</label>
                                <select name="category" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="hearing-aid">เครื่องช่วยฟัง</option>
                                    <option value="spare-part">อะไหล่</option>
                                    <option value="accessory">อุปกรณ์เสริม</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">ชื่อสินค้า / ยี่ห้อ / รุ่น</label>
                                <input type="text" name="keyword" class="form-control"
                                    placeholder="เช่น A1, Phonak, รุ่น X">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">LOT Number</label>
                                <input type="text" name="lot_number" class="form-control" placeholder="เช่น LOT-001">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">คงเหลือต่ำกว่า</label>
                                <input type="number" name="max_stock" class="form-control" placeholder="เช่น 100">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">คงเหลือมากกว่า</label>
                                <input type="number" name="min_stock" class="form-control" placeholder="เช่น 5">
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

            {{-- Table Content --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>หมวดสินค้า</th>
                                    <th>LOT</th>
                                    <th>วันที่รับเข้า</th>
                                    <th>หน่วย</th>
                                    <th>คงเหลือ</th>
                                    <th>ราคาทุน/หน่วย</th>
                                    <th>มูลค่าคงเหลือ</th>
                                    <th>สาขา</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 🔁 ตัวอย่างข้อมูล demo --}}
                                <tr>
                                    <td>1</td>
                                    <td>PRD-001</td>
                                    <td>เครื่องช่วยฟังรุ่น A</td>
                                    <td>อุปกรณ์</td>
                                    <td>LOT-1001</td>
                                    <td>2025-07-01</td>
                                    <td>ชิ้น</td>
                                    <td>10</td>
                                    <td>5,000.00</td>
                                    <td>50,000.00</td>
                                    <td>กรุงเทพ</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>PRD-002</td>
                                    <td>แบตเตอรี่เบอร์ 13</td>
                                    <td>อะไหล่</td>
                                    <td>LOT-1002</td>
                                    <td>2025-07-05</td>
                                    <td>แพ็ค</td>
                                    <td>25</td>
                                    <td>200.00</td>
                                    <td>5,000.00</td>
                                    <td>เชียงใหม่</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>PRD-003</td>
                                    <td>กล่องเก็บเสียง</td>
                                    <td>อุปกรณ์</td>
                                    <td>LOT-1003</td>
                                    <td>2025-07-10</td>
                                    <td>กล่อง</td>
                                    <td>15</td>
                                    <td>150.00</td>
                                    <td>2,250.00</td>
                                    <td>ขอนแก่น</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>PRD-004</td>
                                    <td>เครื่องอบไอน้ำ</td>
                                    <td>อุปกรณ์</td>
                                    <td>LOT-1004</td>
                                    <td>2025-07-15</td>
                                    <td>เครื่อง</td>
                                    <td>8</td>
                                    <td>6,000.00</td>
                                    <td>48,000.00</td>
                                    <td>กรุงเทพ</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>PRD-005</td>
                                    <td>อแดปเตอร์ชาร์จ</td>
                                    <td>อะไหล่</td>
                                    <td>LOT-1005</td>
                                    <td>2025-07-18</td>
                                    <td>ชุด</td>
                                    <td>12</td>
                                    <td>350.00</td>
                                    <td>4,200.00</td>
                                    <td>เชียงใหม่</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
