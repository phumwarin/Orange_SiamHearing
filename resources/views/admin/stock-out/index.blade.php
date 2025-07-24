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
            {{-- Header --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ตัดสต๊อกสินค้า</h5>
                    <div>
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#stockOutModal">
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
                                <label class="form-label">เลขที่ใบตัดสต็อก</label>
                                <input type="text" name="stock_out_no" class="form-control" placeholder="SO-2025-001"
                                    value="{{ request('stock_out_no') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ประเภทการตัดสต็อก</label>
                                <select name="reason_type" class="form-select">
                                    <option value="">-- ทุกประเภท --</option>
                                    <option value="sale" {{ request('reason_type') == 'sale' ? 'selected' : '' }}>ขาย
                                    </option>
                                    <option value="damage" {{ request('reason_type') == 'damage' ? 'selected' : '' }}>ชำรุด
                                    </option>
                                    <option value="expired" {{ request('reason_type') == 'expired' ? 'selected' : '' }}>
                                        หมดอายุ</option>
                                    <option value="lost" {{ request('reason_type') == 'lost' ? 'selected' : '' }}>
                                        ยืมไม่คืน</option>
                                </select>
                            </div>

                            {{-- Row 2 --}}
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

            {{-- Table --}}
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>วันที่</th>
                                <th>เลขที่ใบตัด</th>
                                <th>ชื่อสินค้า</th>
                                <th>ประเภทการตัด</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                                <th>หมายเหตุ</th>
                                <th>ผู้รับผิดชอบ</th> {{-- ✅ เพิ่มคอลัมน์นี้ --}}
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop รายการ --}}
                            <tr>
                                <td>1</td>
                                <td>2025-07-23</td>
                                <td>SO-0001</td>
                                <td>เครื่องช่วยฟังรุ่น X</td>
                                <td>ขาย</td>
                                <td>3</td>
                                <td>5,500.00</td>
                                <td>ขายสินค้าหน้าร้าน</td>
                                <td>สมชาย ใจดี</td>
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
                                <td>SO-0002</td>
                                <td>สายไมโครโฟนรุ่น M-200</td>
                                <td>ชำรุด</td>
                                <td>5</td>
                                <td>1,250.00</td>
                                <td>ตัดสินค้าชำรุดจากคลัง</td>
                                <td>สุนารี ศรีทอง</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="ti ti-printer"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>2025-07-19</td>
                                <td>SO-0003</td>
                                <td>ถ่านเครื่องช่วยฟัง A13</td>
                                <td>หมดอายุ</td>
                                <td>10</td>
                                <td>1,000.00</td>
                                <td>สินค้าหมดอายุ ไม่สามารถจำหน่ายได้</td>
                                <td>อรอนงค์ พงษ์ศรี</td>
                                <td>
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="ti ti-printer"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>2025-07-17</td>
                                <td>SO-0004</td>
                                <td>เครื่องวัดเสียงรุ่น S-55</td>
                                <td>ยืมไม่คืน</td>
                                <td>1</td>
                                <td>12,500.00</td>
                                <td>อุปกรณ์ยืมไปทดลองใช้งานแต่ไม่ส่งคืน</td>
                                <td>วิศรุต แซ่ลิ้ม</td>
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

            {{-- Modal: สร้างรายการตัดสต๊อก --}}
            <div class="modal fade" id="stockOutModal" tabindex="-1" aria-labelledby="stockOutModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <form method="POST" action="{{ url('admin/stock-out') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="stockOutModalLabel">สร้างรายการตัดสต๊อกสินค้า</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                {{-- ข้อมูลทั่วไป --}}
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">เลขที่ใบตัด</label>
                                        <input type="text" name="stock_out_no" class="form-control"
                                            placeholder="SO-0001" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">วันที่</label>
                                        <input type="date" name="stock_out_date" class="form-control"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">ประเภทการตัด</label>
                                        <select name="stock_out_type" class="form-select" required>
                                            <option value="">-- เลือกประเภท --</option>
                                            <option value="ขาย">ขาย</option>
                                            <option value="ชำรุด">ชำรุด</option>
                                            <option value="บริจาค">บริจาค</option>
                                            <option value="โอนออก">โอนออก</option>
                                            <option value="หมดอายุ">หมดอายุ</option>
                                            <option value="ยืมไม่คืน">ยืมไม่คืน</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">ผู้รับผิดชอบ</label>
                                        <select name="created_by" class="form-select">
                                            <option value="">-- เลือกผู้ใช้ --</option>
                                            @foreach ($users ?? [] as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">หมายเหตุ</label>
                                        <input type="text" name="note" class="form-control">
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
                                        <tbody id="stockOutRows">
                                            <tr>
                                                <td><input type="text" name="product_code[]" class="form-control">
                                                </td>
                                                <td><input type="text" name="product_name[]" class="form-control"
                                                        readonly></td>
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
                                                        class="form-control unit-price" required></td>
                                                <td class="total text-end">0.00</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger remove-row"><i
                                                            class="ti ti-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end mt-2">
                                    <h6 class="mb-0">ยอดรวมทั้งหมด: <span id="grandTotal">0.00</span> ฿</h6>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="ti ti-device-floppy me-1"></i> บันทึกรายการ
                                </button>
                                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
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
        // ฟังก์ชันคำนวณยอดรวมทั้งหมด
        function calculateTotal() {
            let total = 0;

            document.querySelectorAll('#stockOutRows tr').forEach(row => {
                const qty = parseFloat(row.querySelector('.qty')?.value || 0);
                const price = parseFloat(row.querySelector('.unit-price')?.value || 0);
                const rowTotal = qty * price;

                row.querySelector('.total').innerText = rowTotal.toFixed(2);
                total += rowTotal;
            });

            document.getElementById('grandTotal').innerText = total.toFixed(2);
        }

        // เมื่อมีการพิมพ์ในช่องจำนวนหรือราคาต่อหน่วย → คำนวณใหม่
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('qty') || e.target.classList.contains('unit-price')) {
                calculateTotal();
            }
        });

        // เพิ่มแถวใหม่
        document.getElementById('addRowBtn').addEventListener('click', () => {
            const row = document.querySelector('#stockOutRows tr').cloneNode(true);

            row.querySelectorAll('input').forEach(input => input.value = '');
            row.querySelector('.total').innerText = '0.00';
            document.getElementById('stockOutRows').appendChild(row);
        });

        // ลบแถว
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                const row = e.target.closest('tr');

                if (document.querySelectorAll('#stockOutRows tr').length > 1) {
                    row.remove();
                    calculateTotal();
                }
            }
        });
    </script>
@endsection
