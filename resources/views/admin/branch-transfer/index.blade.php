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

        .form-label {
            font-size: 14px;
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
        <div class="col-sm-12">
            {{-- Breadcrumb --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">การโอนย้ายสินค้า</h5>
                    <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createTransferModal">
                        <i class="ti ti-plus me-1"></i> เพิ่มรายการโอน
                    </a>
                </div>
            </div>

            {{-- Filter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">วันที่เริ่มต้น</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">วันที่สิ้นสุด</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">จากสาขา</label>
                            <select name="from_branch" class="form-select">
                                <option value="">-- ทั้งหมด --</option>
                                <option value="กรุงเทพ">สาขากรุงเทพ</option>
                                <option value="เชียงใหม่">สาขาเชียงใหม่</option>
                                <option value="หาดใหญ่">สาขาหาดใหญ่</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">ไปยังสาขา</label>
                            <select name="to_branch" class="form-select">
                                <option value="">-- ทั้งหมด --</option>
                                <option value="กรุงเทพ">สาขากรุงเทพ</option>
                                <option value="เชียงใหม่">สาขาเชียงใหม่</option>
                                <option value="หาดใหญ่">สาขาหาดใหญ่</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">สถานะ</label>
                            <select name="status" class="form-select">
                                <option value="">-- ทั้งหมด --</option>
                                <option value="pending">รอดำเนินการ</option>
                                <option value="completed">โอนเรียบร้อย</option>
                                <option value="cancelled">ยกเลิก</option>
                            </select>
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search me-1"></i> ค้นหา
                            </button>
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-100">
                                <i class="ti ti-refresh me-1"></i> ล้างค่า
                            </a>
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
                                <th>เลขที่เอกสารโอนสินค้า</th>
                                <th>วันที่โอน</th>
                                <th>จากสาขา</th>
                                <th>ไปยังสาขา</th>
                                <th>จำนวน</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ตัวอย่างรายการ --}}
                            <tr>
                                <td>1</td>
                                <td>TRF-0001</td>
                                <td>2025-07-23</td>
                                <td>สาขากรุงเทพ</td>
                                <td>สาขาเชียงใหม่</td>
                                <td>3 รายการ</td>
                                <td><span class="badge bg-warning" style="font-size: 13px">รอดำเนินการ</span></td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>TRF-0002</td>
                                <td>2025-07-24</td>
                                <td>สาขาเชียงใหม่</td>
                                <td>สาขาหาดใหญ่</td>
                                <td>5 รายการ</td>
                                <td><span class="badge bg-success" style="font-size: 13px">โอนเรียบร้อย</span></td>
                                <td>
                                    <button class="btn btn-info btn-sm"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>TRF-0003</td>
                                <td>2025-07-25</td>
                                <td>สาขาหาดใหญ่</td>
                                <td>สาขากรุงเทพ</td>
                                <td>2 รายการ</td>
                                <td><span class="badge bg-danger" style="font-size: 13px">ยกเลิก</span></td>
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

            {{-- Modal: เพิ่มรายการโอน --}}
            <div class="modal fade" id="createTransferModal" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="javascript:void(0)" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">เพิ่มรายการโอนสินค้า</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">วันที่โอน</label>
                                        <input type="date" name="transfer_date" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">จากสาขา</label>
                                        <select name="from_branch" class="form-select">
                                            <option value="">-- เลือกสาขา --</option>
                                            <option value="1">สาขากรุงเทพ</option>
                                            <option value="2">สาขาเชียงใหม่</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">ไปยังสาขา</label>
                                        <select name="to_branch" class="form-select">
                                            <option value="">-- เลือกสาขา --</option>
                                            <option value="2">สาขาเชียงใหม่</option>
                                            <option value="3">สาขาขอนแก่น</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">สถานะ</label>
                                        <select name="status" class="form-select">
                                            <option value="pending">รอดำเนินการ</option>
                                            <option value="completed">โอนเรียบร้อย</option>
                                            <option value="cancelled">ยกเลิก</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- เก็บจำนวนรายการสินค้า --}}
                                <input type="hidden" name="item_count" id="item_count">

                                {{-- รายการสินค้า --}}
                                <div class="table-responsive mt-4">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>รหัสสินค้า</th>
                                                <th>ชื่อสินค้า</th>
                                                <th>จำนวน</th>
                                                <th>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        id="addTransferRow">
                                                        <i class="ti ti-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="transferItems">
                                            <tr>
                                                <td><input type="text" name="product_code[]" class="form-control">
                                                </td>
                                                <td><input type="text" name="product_name[]" class="form-control">
                                                </td>
                                                <td><input type="number" name="quantity[]" class="form-control"
                                                        min="1"></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger remove-row">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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

        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tbody = document.getElementById('transferItems');
            const itemCountInput = document.getElementById('item_count');

            // ฟังก์ชันนับจำนวนรายการสินค้า
            function updateItemCount() {
                const rowCount = tbody.querySelectorAll('tr').length;
                itemCountInput.value = rowCount;
            }

            // เพิ่มแถวสินค้า
            document.getElementById('addTransferRow').addEventListener('click', function() {
                const newRow = tbody.children[0].cloneNode(true);

                // รีเซ็ตค่า input
                newRow.querySelectorAll('input').forEach(input => input.value = '');

                tbody.appendChild(newRow);
                updateItemCount();
            });

            // ลบแถวสินค้า
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) {
                    const row = e.target.closest('tr');
                    const rows = tbody.querySelectorAll('tr');
                    if (rows.length > 1) {
                        row.remove();
                        updateItemCount();
                    }
                }
            });

            // อัปเดตจำนวนแถวเริ่มต้นเมื่อโหลดหน้า
            updateItemCount();
        });
    </script>
@endsection
