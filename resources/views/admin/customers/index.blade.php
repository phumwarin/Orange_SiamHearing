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

@php
    $provinces = ['กรุงเทพมหานคร', 'เชียงใหม่', 'ขอนแก่น', 'นครราชสีมา'];
@endphp

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- หัวข้อ + ปุ่ม --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ข้อมูลลูกค้า</h5>
                    <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createCustomerModal">
                        <i class="ti ti-plus me-1"></i> เพิ่มลูกค้า
                    </a>
                </div>
            </div>

            {{-- Filter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="row g-3 align-items-end">
                            {{-- Row 1 --}}
                            <div class="col-md-3">
                                <label class="form-label">ชื่อลูกค้า / บริษัท</label>
                                <input type="text" name="name" class="form-control" value="{{ request('name') }}"
                                    placeholder="เช่น นายสมชาย">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">เบอร์โทร</label>
                                <input type="text" name="phone" class="form-control" value="{{ request('phone') }}"
                                    placeholder="เช่น 0812345678">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">จังหวัด</label>
                                <select name="province" class="form-select">
                                    <option value="">-- ทุกจังหวัด --</option>
                                    @foreach ($provinces as $prov)
                                        <option value="{{ $prov }}"
                                            {{ request('province') == $prov ? 'selected' : '' }}>{{ $prov }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">ประเภทลูกค้า</label>
                                <select name="customer_type" class="form-select">
                                    <option value="">-- ทุกประเภท --</option>
                                    <option value="individual"
                                        {{ request('customer_type') == 'individual' ? 'selected' : '' }}>บุคคล</option>
                                    <option value="organization"
                                        {{ request('customer_type') == 'organization' ? 'selected' : '' }}>องค์กร</option>
                                </select>
                            </div>

                            {{-- Row 2 --}}
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
                                <label class="form-label">วันที่เริ่มต้น</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">วันที่สิ้นสุด</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>

                            {{-- ปุ่มค้นหา --}}
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
                                <th>รหัสลูกค้า</th>
                                <th>ชื่อลูกค้า / บริษัท</th>
                                <th>ประเภทลูกค้า</th>
                                <th>เบอร์โทร</th>
                                <th>จังหวัด</th>
                                <th>VAT</th>
                                <th>อัปเดตล่าสุด</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ตัวอย่างข้อมูล --}}
                            <tr>
                                <td>1</td>
                                <td>CU-0001</td>
                                <td>สมชาย ใจดี</td>
                                <td>บุคคล</td>
                                <td>081-111-2222</td>
                                <td>กรุงเทพมหานคร</td>
                                <td><span class="badge bg-secondary" style="font-size: 13px">ไม่มี VAT</span></td>
                                <td>2025-07-20</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>ORG-0002</td>
                                <td>โรงพยาบาลสมานใจ</td>
                                <td>องค์กร</td>
                                <td>02-222-8888</td>
                                <td>เชียงใหม่</td>
                                <td><span class="badge bg-success" style="font-size: 13px">มี VAT</span></td>
                                <td>2025-07-18</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>CU-0003</td>
                                <td>นฤมล การค้า</td>
                                <td>บุคคล</td>
                                <td>086-999-5555</td>
                                <td>ขอนแก่น</td>
                                <td><span class="badge bg-success" style="font-size: 13px">มี VAT</span></td>
                                <td>2025-07-16</td>
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

    {{-- Modal: เพิ่มลูกค้า --}}
    <div class="modal fade" id="createCustomerModal" tabindex="-1"
        aria-labelledby="createCustomerModalLabel"aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form id="customerForm" method="POST" action="{{ url('admin/customers') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCustomerModalLabel">เพิ่มลูกค้าใหม่</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            {{-- รหัสลูกค้า --}}
                            <div class="col-md-6">
                                <label class="form-label">รหัสลูกค้า</label>
                                <input type="text" name="customer_code" class="form-control" placeholder="CU-0001"
                                    required>
                            </div>

                            {{-- ประเภทลูกค้า --}}
                            <div class="col-md-6">
                                <label class="form-label">ประเภทลูกค้า</label>
                                <select name="customer_type" class="form-select" required>
                                    <option value="">-- เลือกประเภท --</option>
                                    <option value="general">บุคคล</option>
                                    <option value="organization">องค์กร</option>
                                </select>
                            </div>

                            {{-- ชื่อ-นามสกุล / บริษัท --}}
                            <div class="col-md-6">
                                <label class="form-label">ชื่อ-นามสกุล / ชื่อบริษัท</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            {{-- เบอร์โทร --}}
                            <div class="col-md-6">
                                <label class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            {{-- จังหวัด --}}
                            <div class="col-md-6">
                                <label class="form-label">จังหวัด</label>
                                <select name="province" class="form-select" required>
                                    <option value="">-- เลือกจังหวัด --</option>
                                    @php
                                        $provinces = ['กรุงเทพมหานคร', 'เชียงใหม่', 'ขอนแก่น', 'นครราชสีมา']; // 🔸 dummy
                                    @endphp
                                    @foreach ($provinces as $prov)
                                        <option value="{{ $prov }}">{{ $prov }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- VAT --}}
                            <div class="col-md-6">
                                <label class="form-label">ภาษี</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="vat_type" value="no_vat"
                                        checked>
                                    <label class="form-check-label">ไม่มี VAT</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="vat_type" value="vat">
                                    <label class="form-check-label">มี VAT</label>
                                </div>
                            </div>

                            {{-- หมายเหตุ --}}
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
@endsection

@section('script')
    <script>
        document.getElementById('customerForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert("ส่งข้อมูลลูกค้าไปหลังบ้าน (Mockup)");
            this.submit();
        });
    </script>
@endsection
