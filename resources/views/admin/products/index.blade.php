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
            {{-- Breadcrumb & Page Title --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between container-title">
                    <h5 class="mb-0" style="align-self: center">ข้อมูลสินค้า</h5>
                    <div>
                        <a href="{{ url('admin/products/create') }}" class="btn btn-success">
                            <i class="ti ti-plus me-1"></i> เพิ่มสินค้า
                        </a>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="row g-3 align-items-end">
                            {{-- Row 1 --}}
                            <div class="col-md-4">
                                <label class="form-label">รหัสสินค้า</label>
                                <input type="text" name="product_code" class="form-control" placeholder="PRD-001"
                                    value="{{ request('product_code') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ชื่อสินค้า</label>
                                <input type="text" name="product_name" class="form-control" placeholder="เครื่องช่วยฟัง"
                                    value="{{ request('product_name') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">หมวดหมู่สินค้า</label>
                                <select name="category_id" class="form-select">
                                    <option value="">-- ทุกหมวดหมู่ --</option>
                                    <option value="1" {{ request('category_id') == 1 ? 'selected' : '' }}>อะไหล่
                                    </option>
                                    <option value="2" {{ request('category_id') == 2 ? 'selected' : '' }}>อุปกรณ์
                                    </option>
                                </select>
                            </div>

                            {{-- Row 2 --}}
                            <div class="col-md-4">
                                <label class="form-label">ประเภทสินค้า</label>
                                <select name="type" class="form-select">
                                    <option value="">-- ทุกประเภท --</option>
                                    <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>ทั่วไป
                                    </option>
                                    <option value="special" {{ request('type') == 'special' ? 'selected' : '' }}>รุ่นพิเศษ
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">สถานะ</label>
                                <select name="status" class="form-select">
                                    <option value="">-- ทุกสถานะ --</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>เปิดใช้งาน
                                    </option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                        ปิดใช้งาน</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end justify-content-start gap-2">
                                <button type="submit" class="btn btn-primary w-auto">
                                    <i class="ti ti-search me-1"></i> ค้นหา
                                </button>
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-auto">
                                    <i class="ti ti-refresh me-1"></i> ล้างค่า
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            {{-- Product Table --}}
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        @php
                            $lastNo = 2;
                        @endphp

                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>ภาพสินค้า</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>หมวด</th>
                                    <th>ยี่ห้อ</th>
                                    <th>รุ่น</th>
                                    <th>ราคาขาย</th>
                                    <th>คงเหลือ</th>
                                    <th>หน่วย</th>
                                    <th>สถานะ</th>
                                    <th>อัปเดตล่าสุด</th>
                                    <th class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (request()->has('code'))
                                    <tr class="table-danger">
                                        <td>{{ $lastNo + 1 }}</td>
                                        <td>
                                            @if (request()->has('image_name'))
                                                <img src="{{ asset('temp/' . request('image_name')) }}" width="50"
                                                    class="rounded">
                                            @else
                                                <img src="{{ asset('assets/img/products/default.png') }}" width="50"
                                                    class="rounded">
                                            @endif
                                        </td>
                                        <td>{{ request('code') }}</td>
                                        <td>{{ request('name') }}</td>
                                        <td>
                                            @switch(request('category'))
                                                @case('1')
                                                    อะไหล่
                                                @break

                                                @case('2')
                                                    อุปกรณ์
                                                @break

                                                @default
                                                    -
                                            @endswitch
                                        </td>
                                        <td>{{ request('brand') }}</td>
                                        <td>{{ request('model') }}</td>
                                        <td>{{ number_format(request('price'), 2) }}</td>
                                        <td>{{ request('stock') }}</td>
                                        <td>{{ request('unit') ?? '-' }}</td> {{-- ✅ เพิ่ม --}}
                                        <td><span class="badge bg-success" style="font-size: 13px">เปิดใช้งาน</span></td>
                                        <td>{{ now()->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-info"><i
                                                    class="ti ti-eye"></i></a>
                                            <a href="{{ url('admin/products/create') }}?{{ http_build_query(request()->all()) }}"
                                                class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger"><i
                                                    class="ti ti-trash"></i></a>
                                        </td>
                                    </tr>
                                @endif

                                {{-- รายการ dummy --}}
                                <tr>
                                    <td>2</td>
                                    <td><img src="{{ asset('assets/img/products/hearing-aids.png') }}" width="50"
                                            class="rounded"></td>
                                    <td>PRD001</td>
                                    <td>เครื่องช่วยฟังรุ่น A</td>
                                    <td>อุปกรณ์</td>
                                    <td>Bluedot</td>
                                    <td>Model A</td>
                                    <td>9,900.00</td>
                                    <td>5</td>
                                    <td>เครื่อง</td>
                                    <td><span class="badge bg-success" style="font-size: 13px">เปิดใช้งาน</span></td>
                                    <td>2024-07-20</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info"><i
                                                class="ti ti-eye"></i></a>
                                        <a href="{{ url('admin/products/create') }}?view=1"
                                            class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger"><i
                                                class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><img src="{{ asset('assets/img/products/hearing-aids-battery.png') }}"
                                            width="50" class="rounded"></td>
                                    <td>PRD002</td>
                                    <td>แบตเตอรี่เครื่องช่วยฟัง</td>
                                    <td>อะไหล่</td>
                                    <td>WIDEX</td>
                                    <td>CR2032</td>
                                    <td>120.00</td>
                                    <td>50</td>
                                    <td>ชิ้น</td>
                                    <td><span class="badge bg-secondary" style="font-size: 13px">ปิดใช้งาน</span></td>
                                    <td>2024-07-19</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info"><i
                                                class="ti ti-eye"></i></a>
                                        <a href="{{ url('admin/products/create') }}?view=1"
                                            class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger"><i
                                                class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
