@extends('layouts.app')

@section('title', 'Siam Hearing')

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

            {{-- Breadcrumb / Header --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ข้อมูลเปิดบิลขาย</h5>
                    <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#saleModal">
                        <i class="ti ti-plus me-1"></i> เพิ่มใบเปิดบิล
                    </a>
                </div>
            </div>

            {{-- Filter / Search --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET">
                        <div class="row g-3 align-items-end">
                            {{-- แถวที่ 1 --}}
                            <div class="col-md-3">
                                <label class="form-label">วันที่เริ่มต้น</label>
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">วันที่สิ้นสุด</label>
                                <input type="date" class="form-control" name="end_date"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">เลขที่บิล</label>
                                <input type="text" class="form-control" name="invoice_no"
                                    value="{{ request('invoice_no') }}" placeholder="เช่น INV-2025-001">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ชื่อลูกค้า</label>
                                <input type="text" class="form-control" name="customer_name"
                                    value="{{ request('customer_name') }}" placeholder="ค้นหาลูกค้า">
                            </div>

                            {{-- แถวที่ 2 --}}
                            <div class="col-md-3">
                                <label class="form-label">สถานะบิล</label>
                                <select class="form-select" name="status">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        รอชำระเงิน</option>
                                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>ชำระเงินแล้ว
                                    </option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        ยกเลิก</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">วิธีชำระเงิน</label>
                                <select class="form-select" name="payment_method">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>
                                        เงินสด</option>
                                    <option value="transfer"
                                        {{ request('payment_method') == 'transfer' ? 'selected' : '' }}>โอนเงิน</option>
                                    <option value="qr" {{ request('payment_method') == 'qr' ? 'selected' : '' }}>QR Code
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">สาขา</label>
                                <select class="form-select" name="branch_id">
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
                                <button class="btn btn-primary me-2 w-100" type="submit">
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
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>วันที่</th>
                                <th>เลขที่บิล</th>
                                <th>ลูกค้า</th>
                                <th>สาขา</th>
                                <th>รายการสินค้า</th>
                                <th>ยอดรวม (บาท)</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2025-07-25</td>
                                <td>INV-2025-001</td>
                                <td>บริษัท เมดิเคิลแคร์ จำกัด</td>
                                <td>กรุงเทพ</td>
                                <td>เครื่องช่วยฟัง x2, กล่องเก็บเสียง x1</td>
                                <td class="text-end">19,800.00</td>
                                <td><span class="badge bg-warning" style="font-size: 13px">รอชำระเงิน</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="ti ti-printer"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2025-07-24</td>
                                <td>INV-2025-002</td>
                                <td>คุณศิริพร นาคดี</td>
                                <td>เชียงใหม่</td>
                                <td>แบตเตอรี่เบอร์ 13 x4</td>
                                <td class="text-end">3,600.00</td>
                                <td><span class="badge bg-success" style="font-size: 13px">ชำระเงินแล้ว</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="ti ti-printer"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2025-07-23</td>
                                <td>INV-2025-003</td>
                                <td>โรงพยาบาลศิริราช</td>
                                <td>ขอนแก่น</td>
                                <td>เครื่องอบไอน้ำ x1, สายชาร์จ x2</td>
                                <td class="text-end">12,750.00</td>
                                <td><span class="badge bg-danger" style="font-size: 13px">ยกเลิก</span></td>
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

    <!-- Modal เพิ่มใบเปิดบิล -->
    <div class="modal fade" id="saleModal" tabindex="-1" aria-labelledby="saleModalLabel">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <form id="saleForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="saleModalLabel">เพิ่มใบเปิดบิล</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">วันที่</label>
                                <input type="date" class="form-control" name="sale_date" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">เลขที่ใบเปิดบิล</label>
                                <input type="text" class="form-control" name="invoice_no" placeholder="INV-000X"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">สถานะบิล</label>
                                <select class="form-select" name="status">
                                    <option value="pending">รอชำระเงิน</option>
                                    <option value="paid">ชำระเงินแล้ว</option>
                                    <option value="cancelled">ยกเลิก</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">ชื่อลูกค้า / บริษัท</label>
                                <input type="text" class="form-control" name="customer_name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">วิธีชำระเงิน</label>
                                <select class="form-select" name="payment_method">
                                    <option value="">ทั้งหมด</option>
                                    <option value="cash">เงินสด</option>
                                    <option value="transfer">โอนเงิน</option>
                                    <option value="qr">QR Code</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">สาขา</label>
                                <select class="form-select" name="branch_id">
                                    <option value="1">กรุงเทพ</option>
                                    <option value="2">เชียงใหม่</option>
                                    <option value="3">ขอนแก่น</option>
                                </select>
                            </div>
                        </div>

                        <!-- ✅ รายการสินค้า -->
                        <div class="col-md-12 mt-4">
                            <label class="form-label">รายการสินค้า</label>
                            <div class="table-responsive">
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
                                                    id="addSaleItemRow">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="saleItems">
                                        <tr>
                                            <td><input type="text" name="product_code[]" class="form-control"></td>
                                            <td><input type="text" name="product_name[]" class="form-control"></td>
                                            <td><input type="number" name="qty[]" class="form-control qty"
                                                    min="1" value="1" required></td>
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
                                <h6 class="mb-0">ยอดรวมทั้งหมด: <span id="saleTotal">0.00</span> ฿</h6>
                                <input type="hidden" name="total_price" id="total_price_input">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-device-floppy me-1"></i> บันทึกข้อมูล
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function calculateSaleTotal() {
            let total = 0;
            document.querySelectorAll('#saleItems tr').forEach(row => {
                const qty = parseFloat(row.querySelector('input[name="qty[]"]').value) || 0;
                const unitPrice = parseFloat(row.querySelector('input[name="unit_price[]"]').value) || 0;
                const rowTotal = qty * unitPrice;

                row.querySelector('td.item-total').innerText = rowTotal.toFixed(2);
                total += rowTotal;
            });
            document.getElementById('saleTotal').innerText = total.toFixed(2);
            document.getElementById('total_price_input').value = total.toFixed(2);
        }

        // เพิ่มแถวใหม่
        document.getElementById('addSaleItemRow').addEventListener('click', () => {
            const tbody = document.getElementById('saleItems');
            const newRow = tbody.children[0].cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelector('select[name="unit[]"]').value = 'ชิ้น';
            newRow.querySelector('td.item-total').innerText = '0.00';

            tbody.appendChild(newRow);
        });

        // ลบแถว
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                const row = e.target.closest('tr');
                const tbody = document.getElementById('saleItems');
                if (tbody.children.length > 1) row.remove();
                calculateSaleTotal();
            }
        });

        // คำนวณเมื่อกรอก qty หรือ unit_price
        document.addEventListener('input', function(e) {
            if (e.target.name === 'qty[]' || e.target.name === 'unit_price[]') {
                calculateSaleTotal();
            }
        });
    </script>
@endsection
