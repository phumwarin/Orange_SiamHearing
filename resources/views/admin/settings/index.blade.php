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
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- Breadcrumb --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">การตั้งค่าระบบ</h5>
                    {{-- <a href="javascript:void(0)" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> เพิ่มข้อมูล
                    </a> --}}
                </div>
            </div>

            {{-- Content --}}
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ชื่อการตั้งค่า</th>
                                    <th>คำอธิบาย</th>
                                    <th>ค่าปัจจุบัน</th>
                                    <th class="text-center">แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ชื่อบริษัท</td>
                                    <td>ชื่อที่ใช้แสดงในหัวเอกสาร</td>
                                    <td>Siam Hearing Co., Ltd.</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"
                                            onclick="openEditModal('company_name', 'Siam Hearing Co., Ltd.', 'ชื่อที่ใช้แสดงในหัวเอกสาร')">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prefix รหัสสินค้า</td>
                                    <td>ใช้สำหรับขึ้นต้นรหัสสินค้า</td>
                                    <td>PRD-</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"
                                            onclick="openEditModal('product_prefix', 'PRD-', 'ใช้สำหรับขึ้นต้นรหัสสินค้า')">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>รูปแบบใบเสนอราคา</td>
                                    <td>รูปแบบหมายเลขใบเสนอราคา</td>
                                    <td>QT-{YYYY}-{####}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"
                                            onclick="openEditModal('quotation_format', 'QT-{YYYY}-{####}', 'รูปแบบหมายเลขใบเสนอราคา')">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>อัตราภาษี</td>
                                    <td>ภาษีมูลค่าเพิ่มที่ใช้งาน</td>
                                    <td>7%</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning"
                                            onclick="openEditModal('vat_rate', '7%', 'ภาษีมูลค่าเพิ่มที่ใช้งาน')">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Setting Modal -->
        <div class="modal fade" id="editSettingModal" tabindex="-1" aria-labelledby="editSettingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <form method="POST" action="{{ url('admin/settings/update') }}">
                    @csrf
                    <input type="hidden" name="key" id="settingKey">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSettingModalLabel">แก้ไขการตั้งค่า</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">คำอธิบาย</label>
                                <input type="text" class="form-control" id="settingDescription" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ค่าปัจจุบัน</label>
                                <input type="text" class="form-control" name="value" id="settingValue" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success">
                                <i class="ti ti-device-floppy me-1"></i> บันทึก
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function openEditModal(key, value, description) {
            document.getElementById('settingKey').value = key;
            document.getElementById('settingValue').value = value;
            document.getElementById('settingDescription').value = description;

            const modal = new bootstrap.Modal(document.getElementById('editSettingModal'));
            modal.show();
        }
    </script>
@endsection
