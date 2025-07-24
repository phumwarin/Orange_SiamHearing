@extends('layouts.app')

@section('title', 'รายงานการขาย')

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
            {{-- Breadcrumb --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">รายงานการขาย</h5>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary ms-2">
                        <i class="ti ti-arrow-left me-1"></i> ย้อนกลับ
                    </a>
                </div>
            </div>

            {{-- Filter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">วันที่เริ่มต้น</label>
                            <input type="date" class="form-control" name="start_date"
                                value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">วันที่สิ้นสุด</label>
                            <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">เลขที่บิล</label>
                            <input type="text" class="form-control" name="invoice_no" value="{{ request('invoice_no') }}"
                                placeholder="เช่น INV-0003">
                        </div>
                        <div class="col-md-3 d-flex align-items-end justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-search me-1"></i> ค้นหา
                            </button>
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary">
                                <i class="ti ti-refresh me-1"></i> ล้างค่า
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table Content --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>วันที่</th>
                                    <th>เลขที่บิล</th>
                                    <th>จำนวนรายการ</th>
                                    <th>ยอดขายรวม (บาท)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2025-07-21</td>
                                    <td>INV-0001</td>
                                    <td>4</td>
                                    <td>4,200.00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2025-07-22</td>
                                    <td>INV-0002</td>
                                    <td>2</td>
                                    <td>2,300.00</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2025-07-23</td>
                                    <td>INV-0003</td>
                                    <td>5</td>
                                    <td>5,850.00</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>2025-07-24</td>
                                    <td>INV-0004</td>
                                    <td>3</td>
                                    <td>3,600.00</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>2025-07-25</td>
                                    <td>INV-0005</td>
                                    <td>6</td>
                                    <td>7,250.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
