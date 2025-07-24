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
            {{-- Header + Action Buttons --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ข้อมูลใบเสนอราคา</h5>
                    <div>
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#createQuotationModal">
                            <i class="ti ti-plus me-1"></i> สร้างใบเสนอราคาใหม่
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="ti ti-download me-1"></i> Export
                        </button>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="row g-3 align-items-end">
                            {{-- Row 1 --}}
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
                                <label class="form-label">เลขที่ใบเสนอราคา</label>
                                <input type="text" name="quotation_no" class="form-control" placeholder="QT-2025-001"
                                    value="{{ request('quotation_no') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ชื่อลูกค้า</label>
                                <input type="text" name="customer_name" class="form-control"
                                    placeholder="ค้นหาชื่อลูกค้า" value="{{ request('customer_name') }}">
                            </div>

                            {{-- Row 2 --}}
                            <div class="col-md-3">
                                <label class="form-label">สถานะใบเสนอราคา</label>
                                <select name="status" class="form-select">
                                    <option value="">-- ทุกสถานะ --</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>ร่าง
                                    </option>
                                    <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>ส่งแล้ว
                                    </option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>อนุมัติ
                                    </option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>ปฏิเสธ
                                    </option>
                                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>หมดอายุ
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ประเภทลูกค้า</label>
                                <select name="customer_type" class="form-select">
                                    <option value="">-- ทุกประเภท --</option>
                                    <option value="individual"
                                        {{ request('customer_type') == 'individual' ? 'selected' : '' }}>บุคคลทั่วไป
                                    </option>
                                    <option value="company" {{ request('customer_type') == 'company' ? 'selected' : '' }}>
                                        บริษัท</option>
                                    <option value="hospital"
                                        {{ request('customer_type') == 'hospital' ? 'selected' : '' }}>โรงพยาบาล</option>
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

                            {{-- Row 3: Buttons --}}
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-search me-1"></i> ค้นหา
                                    </button>
                                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary">
                                        <i class="ti ti-refresh me-1"></i> ล้างค่า
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table: Quotation List --}}
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>วันที่</th>
                                <th>เลขที่ใบเสนอราคา</th>
                                <th>ลูกค้า</th>
                                <th>ประเภทลูกค้า</th>
                                <th>สาขา</th>
                                <th>ผู้รับผิดชอบ</th>
                                <th>จำนวนรายการ</th>
                                <th>ราคารวม</th>
                                <th>สถานะ</th>
                                <th>หมายเหตุ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2025-07-23</td>
                                <td>QT-0001</td>
                                <td>บริษัท ABC จำกัด</td>
                                <td>บริษัท</td>
                                <td>กรุงเทพ</td>
                                <td>คุณศิริพร</td>
                                <td>3</td>
                                <td>15,800.00</td>
                                <td><span class="badge bg-warning">ร่าง</span></td>
                                <td>เสนอราคารอบแรก</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="ti ti-printer"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2025-07-21</td>
                                <td>QT-0002</td>
                                <td>โรงพยาบาลสมานใจ</td>
                                <td>โรงพยาบาล</td>
                                <td>เชียงใหม่</td>
                                <td>คุณปิยาภรณ์</td>
                                <td>5</td>
                                <td>28,400.00</td>
                                <td><span class="badge bg-success">ยืนยันแล้ว</span></td>
                                <td>เสนอราคาแบบมี VAT</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i
                                            class="ti ti-printer"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2025-07-18</td>
                                <td>QT-0003</td>
                                <td>คุณสมศรี ทองดี</td>
                                <td>บุคคล</td>
                                <td>ขอนแก่น</td>
                                <td>คุณปกรณ์</td>
                                <td>2</td>
                                <td>7,200.00</td>
                                <td><span class="badge bg-danger">ยกเลิก</span></td>
                                <td>ลูกค้าเปลี่ยนใจไม่ซื้อ</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i
                                            class="ti ti-printer"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal: Create Quotation --}}
            <div class="modal fade" id="createQuotationModal" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="javascript:void(0)" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">สร้างใบเสนอราคา</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                {{-- Quotation Header --}}
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">วันที่</label>
                                        <input type="date" name="quotation_date" class="form-control"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">เลขที่ใบเสนอราคา</label>
                                        <input type="text" name="quotation_no" class="form-control"
                                            placeholder="QT-XXXX" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">สถานะ</label>
                                        <select name="status" class="form-select">
                                            <option value="draft">ร่าง</option>
                                            <option value="processing">รอดำเนินการ</option>
                                            <option value="confirmed">ยืนยันแล้ว</option>
                                            <option value="cancelled">ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">วันหมดอายุ</label>
                                        <input type="date" name="expire_date" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">ชื่อลูกค้า</label>
                                        <select name="customer_id" class="form-select">
                                            <option value="">-- เลือกลูกค้า --</option>
                                            <option value="1">บริษัท ABC จำกัด</option>
                                            <option value="2">คุณสมชาย ใจดี</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">ประเภทลูกค้า</label>
                                        <select name="customer_type" class="form-select">
                                            <option value="บุคคล">บุคคล</option>
                                            <option value="บริษัท">บริษัท</option>
                                            <option value="โรงพยาบาล">โรงพยาบาล</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">สาขา</label>
                                        <select name="branch_id" class="form-select">
                                            <option value="1">กรุงเทพ</option>
                                            <option value="2">เชียงใหม่</option>
                                            <option value="3">ขอนแก่น</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">ผู้รับผิดชอบ</label>
                                        <input type="text" name="responsible_staff" class="form-control"
                                            placeholder="ชื่อเจ้าหน้าที่">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">หมายเหตุ</label>
                                        <input type="text" name="note" class="form-control">
                                    </div>
                                </div>

                                {{-- Quotation Items --}}
                                <div class="table-responsive mt-4">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>รหัสสินค้า</th>
                                                <th>ชื่อสินค้า</th>
                                                <th>จำนวน</th>
                                                <th>หน่วย</th>
                                                <th>ราคาต่อหน่วย</th>
                                                <th>ราคารวม</th>
                                                <th>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        id="addItemRow">
                                                        <i class="ti ti-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="quotationItems">
                                            <tr>
                                                <td><input type="text" name="product_code[]" class="form-control">
                                                </td>
                                                <td><input type="text" name="product_name[]" class="form-control">
                                                </td>
                                                <td><input type="number" name="qty[]" class="form-control qty"
                                                        min="1" value="1" required></td>
                                                <td>
                                                    <select name="unit[]" class="form-select" required>
                                                        <option value="ชิ้น" selected>ชิ้น</option>
                                                        <option value="กล่อง">กล่อง</option>
                                                        <option value="ถุง">ถุง</option>
                                                        <option value="ขวด">ขวด</option>
                                                        <option value="ชุด">ชุด</option>
                                                    </select>
                                                </td>
                                                <td><input type="number" name="unit_price[]" class="form-control"
                                                        step="0.01"></td>
                                                <td class="text-end item-total">0.00</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger remove-row">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end mt-2">
                                    <h6 class="mb-0">ยอดรวมทั้งหมด: <span id="quotationTotal">0.00</span> ฿</h6>
                                    <input type="hidden" name="total_price" id="quotationTotalInput">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-secondary" name="save_as_draft"
                                    value="1">
                                    <i class="ti ti-pencil me-1"></i> บันทึกร่าง
                                </button>

                                <button type="submit" class="btn btn-success">
                                    <i class="ti ti-device-floppy me-1"></i> บันทึก
                                </button>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // ฟังก์ชันคำนวณยอดรวมต่อแถวและรวมทั้งหมด
        function calculateQuotationTotal() {
            let total = 0;
            document.querySelectorAll('#quotationItems tr').forEach(row => {
                const qty = parseFloat(row.querySelector('input[name="qty[]"]').value) || 0;
                const unitPrice = parseFloat(row.querySelector('input[name="unit_price[]"]').value) || 0;
                const rowTotal = qty * unitPrice;

                row.querySelector('td.text-end').innerText = rowTotal.toFixed(2);
                total += rowTotal;
            });
            document.getElementById('quotationTotal').innerText = total.toFixed(2);
        }

        // เพิ่มแถวใหม่
        document.getElementById('addItemRow').addEventListener('click', () => {
            const tbody = document.getElementById('quotationItems');
            const newRow = tbody.children[0].cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelector('select[name="unit[]"]').value = 'ชิ้น';
            newRow.querySelector('td.text-end').innerText = '0.00';

            tbody.appendChild(newRow);
        });

        // ลบแถว
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                const row = e.target.closest('tr');
                const tbody = document.getElementById('quotationItems');
                if (tbody.children.length > 1) row.remove();
                calculateQuotationTotal();
            }
        });

        // คำนวณเมื่อเปลี่ยน quantity หรือ unit_price
        document.addEventListener('input', function(e) {
            if (e.target.name === 'qty[]' || e.target.name === 'unit_price[]') {
                calculateQuotationTotal();
            }
        });
    </script>
@endsection
