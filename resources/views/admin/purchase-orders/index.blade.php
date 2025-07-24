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
            {{-- Breadcrumb --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ข้อมูลการสั่งซื้อสินค้า</h5>
                    <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createPurchaseModal">
                        <i class="ti ti-plus me-1"></i> เพิ่มใบสั่งซื้อสินค้า
                    </a>
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
                                <label class="form-label">เลขที่ใบสั่งซื้อ</label>
                                <input type="text" name="po_no" class="form-control" placeholder="เช่น PO-2025-001"
                                    value="{{ request('po_no') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ผู้จำหน่าย</label>
                                <select name="supplier_id" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    {{-- วนลูป Supplier จริงในระบบ --}}
                                    <option value="1">หจก. แสงไทยการแพทย์</option>
                                    <option value="2">บจก. ซัพพลายแอนด์โซลูชัน</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">สถานะ</label>
                                <select name="status" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="draft">ร่าง</option>
                                    <option value="pending">รออนุมัติ</option>
                                    <option value="approved">อนุมัติแล้ว</option>
                                    <option value="received">รับของแล้ว</option>
                                    <option value="cancelled">ยกเลิก</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">สาขา</label>
                                <select name="branch_id" class="form-select">
                                    <option value="">-- ทั้งหมด --</option>
                                    <option value="1">กรุงเทพ</option>
                                    <option value="2">เชียงใหม่</option>
                                    <option value="3">ขอนแก่น</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2 w-100"><i class="ti ti-search me-1"></i>
                                    ค้นหา</button>
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-100"><i
                                        class="ti ti-refresh me-1"></i> ล้างค่า</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- PO Table --}}
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>เลขที่ใบสั่งซื้อ</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>Supplier</th>
                                <th>สาขา</th>
                                <th>สถานะ</th>
                                <th>ยอดรวม (บาท)</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Draft --}}
                            <tr>
                                <td>1</td>
                                <td>PO-0001</td>
                                <td>2025-07-22</td>
                                <td>บริษัท แสงไทยการแพทย์</td>
                                <td>กรุงเทพ</td>
                                <td><span class="badge bg-secondary" style="font-size: 13px">ร่าง</span></td>
                                <td>10,500.00</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            {{-- Pending --}}
                            <tr>
                                <td>2</td>
                                <td>PO-0002</td>
                                <td>2025-07-23</td>
                                <td>บริษัท ABC จำกัด</td>
                                <td>เชียงใหม่</td>
                                <td><span class="badge bg-warning" style="font-size: 13px">รออนุมัติ</span></td>
                                <td>12,500.00</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            {{-- Approved --}}
                            <tr>
                                <td>3</td>
                                <td>PO-0003</td>
                                <td>2025-07-24</td>
                                <td>บริษัท XYZ จำกัด</td>
                                <td>กรุงเทพ</td>
                                <td><span class="badge bg-success" style="font-size: 13px">อนุมัติแล้ว</span></td>
                                <td>8,750.00</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            {{-- Received --}}
                            <tr>
                                <td>4</td>
                                <td>PO-0004</td>
                                <td>2025-07-25</td>
                                <td>บจก. สมาร์ทเมดิคอล</td>
                                <td>ขอนแก่น</td>
                                <td><span class="badge bg-primary" style="font-size: 13px">รับของแล้ว</span></td>
                                <td>5,900.00</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            {{-- Cancelled --}}
                            <tr>
                                <td>5</td>
                                <td>PO-0005</td>
                                <td>2025-07-26</td>
                                <td>บริษัท สมาร์ทเทรด จำกัด</td>
                                <td>เชียงใหม่</td>
                                <td><span class="badge bg-danger" style="font-size: 13px">ยกเลิก</span></td>
                                <td>7,300.00</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal: เพิ่มใบสั่งซื้อ --}}
            <div class="modal fade" id="createPurchaseModal" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="javascript:void(0)" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">เพิ่มใบสั่งซื้อสินค้า</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">เลขที่ใบสั่งซื้อ</label>
                                        <input type="text" name="po_no" class="form-control"
                                            placeholder="เช่น PO-2025-001">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">วันที่สั่งซื้อ</label>
                                        <input type="date" name="order_date" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">วันที่ต้องการรับ</label>
                                        <input type="date" name="expected_date" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Supplier</label>
                                        <select name="supplier_id" class="form-select">
                                            <option value="">-- เลือก Supplier --</option>
                                            <option value="1">บริษัท ABC จำกัด</option>
                                            <option value="2">บริษัท XYZ จำกัด</option>
                                        </select>
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
                                        <label class="form-label">สถานะ</label>
                                        <select name="status" class="form-select">
                                            <option value="draft">ร่าง</option>
                                            <option value="pending">รออนุมัติ</option>
                                            <option value="approved">อนุมัติแล้ว</option>
                                            <option value="received">รับของแล้ว</option>
                                            <option value="cancelled">ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">หมายเหตุ</label>
                                        <input type="text" name="note" class="form-control"
                                            placeholder="ระบุเพิ่มเติมถ้ามี...">
                                    </div>
                                </div>

                                {{-- รายการสินค้า --}}
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
                                                        id="addPurchaseRow">
                                                        <i class="ti ti-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="purchaseItems">
                                            <tr>
                                                <td><input type="text" name="product_code[]" class="form-control">
                                                </td>
                                                <td><input type="text" name="product_name[]" class="form-control">
                                                </td>
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
                                                <td><input type="number" name="unit_price[]"
                                                        class="form-control unit_price" step="0.01" min="0">
                                                </td>
                                                <td class="text-end total">0.00</td>
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
                                    <h6 class="mb-0">ยอดรวมทั้งหมด: <span id="purchaseTotal">0.00</span> ฿</h6>
                                    <input type="hidden" name="total_price" id="purchase_total_input">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="action" value="draft" class="btn btn-outline-secondary">
                                    <i class="ti ti-pencil me-1"></i> บันทึกร่าง
                                </button>
                                <button type="submit" name="action" value="submit" class="btn btn-success">
                                    <i class="ti ti-device-floppy me-1"></i> บันทึกใบสั่งซื้อ
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
        // คำนวณยอดรวมต่อแถวและรวมทั้งหมด
        function calculatePurchaseTotal() {
            let total = 0;
            document.querySelectorAll('#purchaseItems tr').forEach(row => {
                const qty = parseFloat(row.querySelector('input[name="qty[]"]')?.value) || 0;
                const unitPrice = parseFloat(row.querySelector('input[name="unit_price[]"]')?.value) || 0;
                const rowTotal = qty * unitPrice;

                const totalCell = row.querySelector('td.total');
                if (totalCell) totalCell.innerText = rowTotal.toFixed(2);
                total += rowTotal;
            });

            document.getElementById('purchaseTotal').innerText = total.toFixed(2);
            document.getElementById('purchase_total_input').value = total.toFixed(2);
        }

        // เพิ่มแถวใหม่
        document.getElementById('addPurchaseRow')?.addEventListener('click', () => {
            const tbody = document.getElementById('purchaseItems');
            const newRow = tbody.children[0].cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelector('select[name="unit[]"]').value = 'ชิ้น';
            newRow.querySelector('td.total').innerText = '0.00';

            tbody.appendChild(newRow);
        });

        // ลบแถว
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                const row = e.target.closest('tr');
                const tbody = document.getElementById('purchaseItems');
                if (tbody.children.length > 1 && row) {
                    row.remove();
                    calculatePurchaseTotal();
                }
            }
        });

        // คำนวณใหม่เมื่อเปลี่ยน qty หรือ unit_price
        document.addEventListener('input', function(e) {
            if (e.target.name === 'qty[]' || e.target.name === 'unit_price[]') {
                calculatePurchaseTotal();
            }
        });
    </script>
@endsection
