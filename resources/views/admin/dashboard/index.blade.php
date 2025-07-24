@extends('layouts.app')

@section('title', 'รับสินค้าเข้า (Stock-In) | SiamHearing')

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

        .card-center-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100px;
            text-align: center;
        }

        .card-center-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100px;
            text-align: center;
        }

        .card-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .card-value {
            font-size: 30px;
            font-weight: bold;
            color: #4e4e4e;
        }

        .card-products {
            background-color: #f1f0ff;
            border: 1px solid #7367f0;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .card-products:hover {
            box-shadow: 0 0 12px 2px rgba(115, 103, 240, 0.4);
        }

        .card-users {
            background-color: #e8f6f0;
            border: 1px solid #28c76f;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .card-users:hover {
            box-shadow: 0 0 12px 2px rgba(40, 199, 111, 0.4);
        }

        .card-orders {
            background-color: #e0f7fa;
            border: 1px solid #00cfe8;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .card-orders:hover {
            box-shadow: 0 0 12px 2px rgba(0, 207, 232, 0.4);
        }


        .card-pending {
            background-color: #fdecea;
            border: 1px solid #ea5455;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .card-pending:hover {
            box-shadow: 0 0 12px 2px rgba(234, 84, 85, 0.4);
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- Header --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">แดชบอร์ด</h5>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <div class="card card-products p-3">
                        <div class="card-center-content">
                            <div class="card-title text-primary">จำนวนสินค้า</div>
                            <div class="card-value">150</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-users p-3">
                        <div class="card-center-content">
                            <div class="card-title text-success">จำนวนผู้ใช้งาน</div>
                            <div class="card-value">25</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-orders p-3">
                        <div class="card-center-content">
                            <div class="card-title text-info">คำสั่งซื้อวันนี้</div>
                            <div class="card-value">8</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-pending p-3">
                        <div class="card-center-content">
                            <div class="card-title text-danger">รอดำเนินการ</div>
                            <div class="card-value">3</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chart: สัดส่วนสินค้าแยกตามประเภท / supplier --}}
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card vuexy-card">
                        <div class="card-header">
                            <h6 class="mb-0">สัดส่วนสินค้าแยกตามประเภท</h6>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                            <span class="text-muted">Chart: สัดส่วนสินค้าแยกตามประเภท (Bar Chart)</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card vuexy-card">
                        <div class="card-header">
                            <h6 class="mb-0">สัดส่วนการจัดซื้อแยกตาม Supplier</h6>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                            <span class="text-muted">Chart: สัดส่วนการจัดซื้อแยกตาม Supplier (Pie Chart)</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Latest PO Table --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">ใบสั่งซื้อล่าสุด</h6>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>เลขที่</th>
                                <th>ซัพพลายเออร์</th>
                                <th>วันที่</th>
                                <th>สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PO-202407-001</td>
                                <td>บจก. ซัพพลายเทค</td>
                                <td>2024-07-24</td>
                                <td><span class="badge bg-success" style="font-size: 13px">รับสินค้าแล้ว</span></td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info"><i class="ti ti-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>PO-202407-002</td>
                                <td>บจก. แอมพลิฟาย</td>
                                <td>2024-07-23</td>
                                <td><span class="badge bg-warning" style="font-size: 13px">รอรับสินค้า</span></td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info"><i class="ti ti-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
