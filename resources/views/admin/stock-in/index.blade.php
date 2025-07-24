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
                    <h5 class="mb-0">บันทึกรับสินค้าเข้า</h5>
                    <div>
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#stockInModal">
                            <i class="ti ti-plus me-1"></i> สร้างรายการใหม่
                        </button>

                        <button class="btn btn-outline-secondary me-2">
                            <i class="ti ti-download me-1"></i> Export
                        </button>

                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                            <i class="ti ti-upload me-1"></i> Import Excel
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
                                <label class="form-label">เลขที่ใบรับสินค้า</label>
                                <input type="text" name="stock_in_no" class="form-control" placeholder="SI-2025-001"
                                    value="{{ request('stock_in_no') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ประเภทการรับเข้า</label>
                                <select name="stock_in_type" class="form-select">
                                    <option value="">-- ทุกประเภท --</option>
                                    <option value="new" {{ request('stock_in_type') == 'new' ? 'selected' : '' }}>
                                        สินค้าเข้าใหม่</option>
                                    <option value="return" {{ request('stock_in_type') == 'return' ? 'selected' : '' }}>
                                        รับคืนจากลูกค้า</option>
                                    <option value="transfer" {{ request('stock_in_type') == 'transfer' ? 'selected' : '' }}>
                                        โอนเข้าจากสาขาอื่น</option>
                                    <option value="adjustment"
                                        {{ request('stock_in_type') == 'adjustment' ? 'selected' : '' }}>ปรับยอดสต็อก
                                    </option>
                                </select>
                            </div>

                            {{-- Row 2 --}}
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
                                <th>วันที่รับเข้า</th>
                                <th>เลขที่ใบรับ</th>
                                <th>ชื่อสินค้า</th>
                                <th>ประเภทการรับ</th>
                                <th>ซัพพลายเออร์</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                                <th>หมายเหตุ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2025-07-25</td>
                                <td>SI-0001</td>
                                <td>เครื่องช่วยฟังรุ่น X</td>
                                <td>สินค้าเข้าใหม่</td>
                                <td>บริษัท XYZ</td>
                                <td>2</td>
                                <td>11,900.00</td>
                                <td>รับจาก supplier A (PO-2025-004)</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="ti ti-printer"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>2025-07-22</td>
                                <td>SI-0002</td>
                                <td>แบตเตอรี่ขนาด 312</td>
                                <td>ปรับยอดสต็อก</td>
                                <td>—</td>
                                <td>5</td>
                                <td>1,250.00</td>
                                <td>รอปรับยอดสิ้นเดือน</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="ti ti-printer"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>2025-07-20</td>
                                <td>SI-0003</td>
                                <td>เครื่องวัดเสียง S-55</td>
                                <td>รับคืนจากลูกค้า</td>
                                <td>—</td>
                                <td>1</td>
                                <td>12,500.00</td>
                                <td>คืนจากลูกค้า รหัส M2024-001</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i
                                            class="ti ti-printer"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>2025-07-18</td>
                                <td>SI-0004</td>
                                <td>ชุดอุปกรณ์ทำความสะอาด</td>
                                <td>โอนเข้าจากสาขาเชียงใหม่</td>
                                <td>—</td>
                                <td>3</td>
                                <td>2,400.00</td>
                                <td>โอนจากคลังเชียงใหม่</td>
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
        </div>
    </div>

    {{-- Modal สำหรับรับสินค้าเข้า --}}
    <div class="modal fade" id="stockInModal" tabindex="-1" aria-labelledby="stockInModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <form id="stockInForm" method="POST" action="{{ url('admin/stock-in') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="stockInModalLabel">สร้างรายการรับสินค้าเข้า</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        {{-- ข้อมูลใบรับสินค้า --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">เลขที่ใบรับ</label>
                                <input type="text" name="receipt_no" class="form-control" placeholder="SI-0001"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">วันที่รับเข้า</label>
                                <input type="date" name="stock_in_date" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ประเภทการรับเข้า</label>
                                <select name="stock_in_type" class="form-select" required>
                                    <option value="">-- เลือกประเภท --</option>
                                    <option value="purchase">ซื้อเข้า</option>
                                    <option value="adjust">ปรับยอด</option>
                                    <option value="return">คืนจากลูกค้า</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label class="form-label">สาขา</label>
                                <select name="branch_id" class="form-select" required>
                                    <option value="">-- เลือกสาขา --</option>
                                    <option value="1">กรุงเทพ</option>
                                    <option value="2">เชียงใหม่</option>
                                    <option value="3">ขอนแก่น</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label class="form-label">ซัพพลายเออร์</label>
                                <select name="supplier_id" class="form-select">
                                    <option value="">-- เลือกซัพพลายเออร์ --</option>
                                    <option value="1">บริษัท XYZ</option>
                                    <option value="2">หจก. วัสดุไทย</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label class="form-label">ผู้รับผิดชอบ</label>
                                <select name="created_by" class="form-select" required>
                                    <option value="">-- เลือกผู้ใช้งาน --</option>
                                    @foreach ($users ?? [] as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label">หมายเหตุ</label>
                                <input type="text" name="note" class="form-control"
                                    placeholder="เช่น รับของล็อตแรก">
                            </div>
                        </div>

                        {{-- รายการสินค้า --}}
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>หน่วย</th>
                                        <th>ราคาต่อหน่วย</th>
                                        <th>ราคารวม</th>
                                        <th>
                                            <button type="button" class="btn btn-sm btn-success" id="addRowBtn">
                                                <i class="ti ti-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="stockInRows">
                                    <tr>
                                        <td><input type="text" name="product_code[]" class="form-control"></td>
                                        <td><input type="text" name="product_name[]" class="form-control" readonly>
                                        </td>
                                        <td><input type="number" name="qty[]" class="form-control qty" min="1"
                                                value="1" required></td>
                                        <td>
                                            <select name="unit[]" class="form-select" required>
                                                <option value="">-- เลือกหน่วย --</option>
                                                <option value="ชิ้น" selected>ชิ้น</option>
                                                <option value="กล่อง">กล่อง</option>
                                                <option value="ถุง">ถุง</option>
                                                <option value="ขวด">ขวด</option>
                                                <option value="ชุด">ชุด</option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="unit_price[]" class="form-control unit-price"
                                                min="0" step="0.01" required></td>
                                        <td class="total text-end">0.00</td>
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
                            <h6 class="mb-0">ยอดรวมทั้งหมด: <span id="grandTotal">0.00</span> ฿</h6>
                        </div>
                    </div>

                    <div class="modal-footer pt-0">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-device-floppy me-1"></i> บันทึกรายการ
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Import Excel --}}
    <div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ url('admin/stock-in/import-excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importExcelModalLabel">นำเข้ารายการรับสินค้าผ่าน Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="mb-3">
                            <label for="excel_file" class="form-label">เลือกไฟล์ Excel (.xlsx)</label>
                            <input type="file" name="excel_file" class="form-control" accept=".xlsx" required>
                        </div>

                        <div class="alert alert-info">
                            <strong>คำแนะนำ:</strong> กรุณาใช้ Template Excel ที่ระบบกำหนด<br>
                            <a href="{{ asset('sample/stock-in-template.xlsx') }}" class="btn btn-sm btn-info mt-2">
                                ดาวน์โหลดไฟล์ตัวอย่าง
                            </a>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">
                            <i class="ti ti-upload me-1"></i> นำเข้า
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
        document.addEventListener('DOMContentLoaded', function() {

            // ฟังก์ชันคำนวณราคารวมและยอดรวมทั้งหมด
            function updateTotals() {
                let grandTotal = 0;

                document.querySelectorAll('#stockInRows tr').forEach(row => {
                    const qty = parseFloat(row.querySelector('.qty')?.value || 0);
                    const price = parseFloat(row.querySelector('.unit-price')?.value || 0);
                    const total = qty * price;
                    row.querySelector('.total').textContent = total.toFixed(2);
                    grandTotal += total;
                });

                document.getElementById('grandTotal').textContent = grandTotal.toFixed(2);
            }

            // เพิ่มแถวใหม่
            document.getElementById('addRowBtn').addEventListener('click', () => {
                const templateRow = document.querySelector('#stockInRows tr');
                const newRow = templateRow.cloneNode(true);

                // เคลียร์ค่าใน input
                newRow.querySelectorAll('input').forEach(input => input.value = '');
                newRow.querySelector('.total').textContent = '0.00';

                document.getElementById('stockInRows').appendChild(newRow);
            });

            // ลบแถว
            document.querySelector('#stockInRows').addEventListener('click', (e) => {
                if (e.target.closest('.remove-row')) {
                    const rows = document.querySelectorAll('#stockInRows tr');
                    if (rows.length > 1) {
                        e.target.closest('tr').remove();
                        updateTotals();
                    }
                }
            });

            // คำนวณเมื่อมีการกรอกจำนวนหรือราคาต่อหน่วย
            document.querySelector('#stockInRows').addEventListener('input', function(e) {
                if (e.target.classList.contains('qty') || e.target.classList.contains('unit-price')) {
                    updateTotals();
                }
            });

            // ดึงชื่อสินค้าอัตโนมัติจากรหัส
            document.querySelector('#stockInRows').addEventListener('change', function(e) {
                if (e.target.classList.contains('product-code')) {
                    const row = e.target.closest('tr');
                    const code = e.target.value;

                    fetch(`/api/products/code/${code}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data && data.name) {
                                row.querySelector('.product-name').value = data.name;
                            } else {
                                row.querySelector('.product-name').value = 'ไม่พบสินค้า';
                            }
                        }).catch(() => {
                            row.querySelector('.product-name').value = 'เกิดข้อผิดพลาด';
                        });
                }
            });

        });
    </script>
@endsection
