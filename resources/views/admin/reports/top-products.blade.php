@extends('layouts.app')

@section('title', 'รายงานสินค้าขายดี')

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
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">

            {{-- Header --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">สินค้าขายดี 10 อันดับ</h5>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary ms-2">
                        <i class="ti ti-arrow-left me-1"></i>ย้อนกลับ
                    </a>
                </div>
            </div>

            {{-- Content --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>จำนวนที่ขายได้</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td >1</td>
                                    <td>PRD-005</td>
                                    <td>เครื่องช่วยฟังรุ่น B</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>PRD-002</td>
                                    <td>แบตเตอรี่เบอร์ 13</td>
                                    <td>45</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>PRD-008</td>
                                    <td>แบตเตอรี่เบอร์ 312</td>
                                    <td>40</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>PRD-010</td>
                                    <td>เครื่องช่วยฟังรุ่น C</td>
                                    <td>37</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>PRD-003</td>
                                    <td>แบตเตอรี่เบอร์ 10</td>
                                    <td>35</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>PRD-006</td>
                                    <td>สายเชื่อมต่อรุ่น A</td>
                                    <td>32</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>PRD-009</td>
                                    <td>เครื่องล้างเครื่องช่วยฟัง</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>PRD-004</td>
                                    <td>เครื่องช่วยฟังเด็ก</td>
                                    <td>28</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>PRD-011</td>
                                    <td>กล่องเก็บเครื่องช่วยฟัง</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>PRD-007</td>
                                    <td>หูฟังสำรอง</td>
                                    <td>22</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
