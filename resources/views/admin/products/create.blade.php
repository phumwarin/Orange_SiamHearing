@extends('layouts.app')

@section('title', 'SiamHearing')

@push('styles')
    <style>
        .form-label {
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- Breadcrumb & Title --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between container-title">
                    <h5 class="mb-0 title-text d-flex align-items-center">
                        <a href="{{ url('admin/products') }}" class="text-dark text-decoration-none me-1">สินค้า
                            (Products)</a>
                        <span style="color: #03a9f4;">/ เพิ่มสินค้า</span>
                    </h5>
                    <a href="{{ url('admin/products') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i> กลับ
                    </a>
                </div>
            </div>

            {{-- Product Create Form --}}
            <div class="card mb-3">
                <div class="card-body">
                    @if (request()->has('view_code'))
                        <div class="alert alert-info">
                            <strong>รายละเอียดสินค้า:</strong><br>
                            <ul class="mb-0">
                                <li><strong>รหัส:</strong> {{ request('view_code') }}</li>
                                <li><strong>ชื่อสินค้า:</strong> {{ request('view_name') }}</li>
                                <li><strong>หมวด:</strong>
                                    @switch(request('view_category'))
                                        @case('1')
                                            อะไหล่
                                        @break

                                        @case('2')
                                            อุปกรณ์
                                        @break

                                        @default
                                            -
                                    @endswitch
                                </li>
                                <li><strong>ยี่ห้อ:</strong> {{ request('view_brand') }}</li>
                                <li><strong>รุ่น:</strong> {{ request('view_model') }}</li>
                                <li><strong>ราคา:</strong> {{ number_format(request('view_price'), 2) }}</li>
                                <li><strong>คงเหลือ:</strong> {{ request('view_stock') }}</li>
                            </ul>
                        </div>
                    @endif

                    @if (!request()->has('view_code'))
                        <form id="productForm" action="{{ url('admin/products') }}" method="GET"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">รหัสสินค้า</label>
                                    <input type="text" name="code" class="form-control" value="{{ request('code') }}"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">ชื่อสินค้า</label>
                                    <input type="text" name="name" class="form-control" value="{{ request('name') }}"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">หมวดสินค้า</label>
                                    <select name="category" class="form-select" required>
                                        <option value="">-- เลือกหมวดสินค้า --</option>
                                        <option value="1" {{ request('category') == '1' ? 'selected' : '' }}>อะไหล่
                                        </option>
                                        <option value="2" {{ request('category') == '2' ? 'selected' : '' }}>อุปกรณ์
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">ยี่ห้อ</label>
                                    <input type="text" name="brand" class="form-control"
                                        value="{{ request('brand') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">รุ่น</label>
                                    <input type="text" name="model" class="form-control"
                                        value="{{ request('model') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">SN Number</label>
                                    <input type="text" name="sn_number" class="form-control"
                                        value="{{ request('sn_number') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">หน่วยสินค้า</label>
                                    <select name="unit" class="form-select" required>
                                        <option value="">-- เลือกหน่วยสินค้า --</option>
                                        <option value="ชิ้น" {{ request('unit') == 'ชิ้น' ? 'selected' : '' }}>ชิ้น
                                        </option>
                                        <option value="กล่อง" {{ request('unit') == 'กล่อง' ? 'selected' : '' }}>กล่อง
                                        </option>
                                        <option value="แพ็ค" {{ request('unit') == 'แพ็ค' ? 'selected' : '' }}>แพ็ค
                                        </option>
                                        <option value="เครื่อง" {{ request('unit') == 'เครื่อง' ? 'selected' : '' }}>
                                            เครื่อง</option>
                                        <option value="ชุด" {{ request('unit') == 'ชุด' ? 'selected' : '' }}>ชุด
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">ราคาขาย</label>
                                    <input type="number" name="price" class="form-control" step="0.01"
                                        value="{{ request('price') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">จำนวนคงเหลือ</label>
                                    <input type="number" name="stock" class="form-control"
                                        value="{{ request('stock') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">สถานะ</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="active"
                                            checked>
                                        <label class="form-check-label">เปิดใช้งาน</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="inactive">
                                        <label class="form-check-label">ปิดใช้งาน</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">หมายเหตุ</label>
                                    <textarea name="note" class="form-control" rows="2">{{ request('note') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">ภาพสินค้า</label>
                                    <input type="file" name="image" class="form-control">
                                    @if (request('image_name'))
                                        <div class="mt-2">
                                            <img src="{{ asset('temp/' . request('image_name')) }}" width="100"
                                                class="rounded">
                                            <input type="hidden" name="image_name" value="{{ request('image_name') }}">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="ti ti-device-floppy me-1"></i> บันทึกข้อมูล
                                </button>
                                <a href="{{ url('admin/products') }}" class="btn btn-outline-secondary ms-2">ยกเลิก</a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('productForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const fileInput = form.querySelector('input[name="image"]');
            const file = fileInput.files[0];

            let imageName = '';
            if (file) {
                imageName = file.name;
            }

            const params = new URLSearchParams();
            for (let [key, value] of formData.entries()) {
                if (key === 'image') continue; // ไม่ส่ง file จริง
                params.append(key, value);
            }

            if (imageName) {
                params.append('image_name', imageName);
            }

            window.location.href = "{{ url('admin/products') }}?" + params.toString();
        });
    </script>
@endsection
