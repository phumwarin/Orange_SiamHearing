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

        .card-illustration {
            height: 100px;
        }

        .card-sales {
            background-color: #f1f0ff;
            border: 1px solid #7367f0;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .card-sales:hover {
            box-shadow: 0 0 12px 2px rgba(115, 103, 240, 0.4);
            /* centered purple shadow */
        }

        .card-stock {
            background-color: #e8f5e9;
            border: 1px solid #28c76f;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .card-stock:hover {
            box-shadow: 0 0 12px 2px rgba(40, 199, 111, 0.4);
        }

        .card-top-products {
            background-color: #fff3e0;
            border: 1px solid #ff9f43;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .card-top-products:hover {
            box-shadow: 0 0 12px 2px rgba(255, 159, 67, 0.4);
        }
    </style>

    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- Breadcrumb --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">รายงานสรุปภาพรวม</h5>
                    <a href="javascript:void(0)" class="btn btn-success">
                        <i class="ti ti-download me-1"></i> ดาวน์โหลด Excel
                    </a>
                </div>
            </div>

            {{-- Report Cards --}}
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card card-hover p-3 d-flex flex-column justify-content-between card-sales"
                        onclick="window.location.href='{{ route('reports.sales') }}'">
                        <div class="d-flex justify-content-between align-items-start flex-grow-1">
                            <div>
                                <h5 class="mb-1">รายงานการขาย</h5>
                                <small class="text-muted">แสดงข้อมูลการขายทั้งหมด พร้อมเลือกช่วงเวลาได้</small>
                            </div>
                            <img src="{{ asset('assets/img/illustrations/Sale-Report.png') }}" alt="รายงานการขาย"
                                class="card-illustration">
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-primary" style="font-size: 13px">ดูสถิติ</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-hover p-3 d-flex flex-column justify-content-between card-stock"
                        onclick="window.location.href='{{ route('reports.stock') }}'">
                        <div class="d-flex justify-content-between align-items-start flex-grow-1">
                            <div>
                                <h5 class="mb-1">รายงานคงเหลือสินค้า</h5>
                                <small class="text-muted">ดูข้อมูลสินค้าคงเหลือในสต๊อก แยกตาม LOT</small>
                            </div>
                            <img src="{{ asset('assets/img/illustrations/Stock-Report.png') }}" alt="รายงานคงเหลือสินค้า"
                                class="card-illustration">
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success" style="font-size: 13px">ดูสต๊อก</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-hover p-3 d-flex flex-column justify-content-between card-top-products"
                        onclick="window.location.href='{{ route('reports.top-products') }}'">
                        <div class="d-flex justify-content-between align-items-start flex-grow-1">
                            <div>
                                <h5 class="mb-1">สินค้าขายดี 10 อันดับ</h5>
                                <small class="text-muted">วิเคราะห์สินค้าขายดีสูงสุด</small>
                            </div>
                            <img src="{{ asset('assets/img/illustrations/Top-Selling.png') }}" alt="สินค้าขายดี"
                                class="card-illustration">
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-warning text-white" style="font-size: 13px">ดูอันดับ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
