<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
    <title>Job | Daikin</title>

    {{-- Load styles from: public\css\job-index.css --}}
    <link rel="stylesheet" href="{{ asset('css/job-index.css') }}">
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin/layout/inc_sidemenu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('admin/layout/inc_topmenu')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between container-title">
                                        <h6 class="mb-0 title-text">Job</h6>
                                        <a href="{{ url('admin/job/create') }}"
                                            class="btn btn-primary buttons-collection waves-effect waves-light">
                                            <i class="ti ti-plus me-1"></i> Create a new job
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-3">All Project under testing</h6>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Datepicker -->
                                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                                <div class="w-100">
                                                    <label class="form-label">Date</label>
                                                    <input type="date" class="form-control" placeholder="DD/MM/YY">
                                                </div>
                                            </div>

                                            <!-- Month List -->
                                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                                <div class="w-100">
                                                    <label class="form-label">Month</label>
                                                    <select class="form-select">
                                                        <option value="">Select Month</option>
                                                        @foreach ([
                                                            '01' => 'January',
                                                            '02' => 'February',
                                                            '03' => 'March',
                                                            '04' => 'April',
                                                            '05' => 'May',
                                                            '06' => 'June',
                                                            '07' => 'July',
                                                            '08' => 'August',
                                                            '09' => 'September',
                                                            '10' => 'October',
                                                            '11' => 'November',
                                                            '12' => 'December',
                                                        ] as $key => $month)
                                                            <option value="{{ $key }}">{{ $month }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Year List -->
                                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                                <div class="w-100">
                                                    <label class="form-label">Year</label>
                                                    <select class="form-select">
                                                        <option value="">Select Year</option>
                                                        @for ($year = date('Y'); $year >= 2000; $year--)
                                                            <option value="{{ $year }}">{{ $year }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Search Button -->
                                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                                <button type="button" class="btn btn-primary w-100">
                                                    <i class="ti ti-search me-1"></i> Search
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- Table --}}
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered custom-table">
                                                <thead class="table-light">
                                                    <tr class="text-center align-middle">
                                                        <th>Item</th>
                                                        <th>Order job No.</th>
                                                        <th>Project Name</th>
                                                        <th>Priority</th>
                                                        <th>Request by</th>
                                                        <th>Test Schedule</th>
                                                        <th>Complete</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="10" class="text-center">No data available</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin/layout/inc_footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    <!--set rent Modal -->

    <!-- / Layout wrapper -->
    @include('admin/layout/inc_js')
    <script>
        var page = "{{ $page_url }}/datatable";
        var searchData = {};
        loadData(page);

        function loadData(pages) {

            $('.p_search').each(function() {
                var inputName = $(this).attr('name'); // ดึงชื่อ attribute 'name' ของ input
                var inputValue = $(this).val(); // ดึงค่า value ของ input

                searchData[inputName] = inputValue; // เก็บข้อมูลลงในออบเจ็กต์ searchData
            });

            // alert(page);
            page = pages;
            $.ajax({
                type: "GET",
                url: pages,
                data: searchData,
                success: function(data) {
                    $("#table-data").html(data);
                }
            });
            // alert(page);
        }

        function view(id) {
            $.ajax({
                type: "GET",
                url: "{{ $page_url }}/" + id,
                success: function(data) {
                    $("#view").html(data);
                }
            });
        }

        function changeStatus(id, v, element) {
            // let old_v = v === 1 ?  false : true ;
            $(element).prop('checked', v === 1 ? false : true);
            // console.log(old_v);
            // console.log(v);

            Swal.fire({
                title: 'ยืนยันการดำเนินการ?',
                text: 'คุณต้องการเปลี่ยนสถานะหรือไม่?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                showDenyButton: false,
                didOpen: () => {
                    // โฟกัสที่ปุ่ม confirm
                    Swal.getConfirmButton().focus();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ $page_url }}/change-status/' +
                            id, // เปลี่ยน URL เป็นจุดหมายที่ต้องการ
                        type: 'POST',
                        data: {
                            ref_status_id: v,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response == true) {
                                Swal.fire('เปลี่ยนสถานะเรียบร้อยแล้ว', '', 'success');
                                loadData(page);
                            }
                        },
                        error: function(error) {
                            Swal.fire('เกิดข้อผิดพลาด', '', 'error');
                            console.error('เกิดข้อผิดพลาด:', error);
                        }
                    });
                } else if (result.isDismissed) {
                    // Swal.fire('ยกเลิกการดำเนินการ', '', 'info');
                }
            });
        };

        function delete_view(id, v, element) {
            // let old_v = v === 1 ?  false : true ;
            $(element).prop('checked', v === 1 ? false : true);
            // console.log(old_v);
            // console.log(v);

            Swal.fire({
                title: 'ยืนยันการดำเนินการ?',
                text: 'คุณต้องการลบพนักงานหรือไม่?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                showDenyButton: false,
                didOpen: () => {
                    // โฟกัสที่ปุ่ม confirm
                    Swal.getConfirmButton().focus();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ $page_url }}/' + id, // เปลี่ยน URL เป็นจุดหมายที่ต้องการ
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response == true) {
                                Swal.fire('ลบพนักงานเรียบร้อยแล้ว', '', 'success');
                                loadData(page);
                            }
                        },
                        error: function(error) {
                            Swal.fire('เกิดข้อผิดพลาด', '', 'error');
                            console.error('เกิดข้อผิดพลาด:', error);
                        }
                    });
                } else if (result.isDismissed) {
                    // Swal.fire('ยกเลิกการดำเนินการ', '', 'info');
                }
            });
        };
        $('#insert_user').on('submit', function(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์มปกติ

            if (!this.checkValidity()) {
                this.reportValidity();
                return console.log('ฟอร์มไม่ถูกต้อง');
            }

            var formData = new FormData(this);

            Swal.fire({
                title: 'ยืนยันการดำเนินการ?',
                text: 'คุณต้องการเพิ่มพนักงานหรือไม่?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                didOpen: () => {
                    Swal.getConfirmButton().focus();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ $page_url }}',
                        type: 'POST',
                        data: formData,
                        contentType: false, // ✅ ต้องมี
                        processData: false, // ✅ ต้องมี
                        success: function(response) {
                            if (response == true) {
                                $('#insert_user')[0].reset();
                                Swal.fire('เพิ่มพนักงานเรียบร้อยแล้ว', '', 'success');
                                $('#addserviceModal').modal('hide');
                                loadData(page);
                            }
                        },
                        error: function(error) {
                            Swal.fire('เกิดข้อผิดพลาด', '', 'error');
                            console.error('เกิดข้อผิดพลาด:', error);
                        }
                    });
                }
            });
        });

        $('#user_code').on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });

        $('#bs-datepicker-format').datepicker({
            format: 'dd/mm/yyyy', // กำหนดรูปแบบวันที่
            autoclose: true, // ปิด datepicker เมื่อเลือกวันที่
            todayHighlight: true // ไฮไลต์วันที่ปัจจุบัน
        });
        $('#select2Position1').select2();
    </script>
</body>

</html>
