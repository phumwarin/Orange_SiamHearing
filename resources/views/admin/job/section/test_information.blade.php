<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
</head>
<style>
    .text-checkbox {
        font-size: 13px;
    }

    .text-radio {
        font-size: 13px;
        position: relative;
        top: 2px;
    }

    .form-label {
        font-weight: 450;
    }
</style>

<body>
    <div>
        <h6 class="mb-3 mt-3">Enter your Test information</h6>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label">Order job no.</label>
                    <input type="text" name="order_job_no" class="form-control" placeholder="EMC-11-18-003">
                </div>

                {{-- Date Picker --}}
                <div class="col-md-3 mb-2">
                    <label class="form-label">Date</label>
                    <input type="date" name="job_date" class="form-control" placeholder="2019/08/09">
                </div>

                <div class="col-md-3 mb-2">
                    <label class="form-label">Test report No.</label>
                    <input type="text" name="test_report_no" class="form-control" placeholder="">
                </div>

                {{-- Select List --}}
                <div class="col-md-3 mb-2">
                    <label class="form-label">Priority</label>
                    <select class="form-select" name="priority">
                        <option value="" disabled selected>Normal</option>
                        @foreach ([
                            '01' => 'Normal',
                            '02' => 'Low',
                            '03' => 'Height',
                        ] as $key => $priority)
                            <option value="{{ $key }}">{{ $priority }}</option>
                        @endforeach
                    </select>
                </div>
                <hr class="mt-3">
            </div>

            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label">Request by</label>
                    <input type="text" name="request_by" class="form-control" placeholder="Suda Mahasap">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Dept. / section</label>
                    <input type="text" name="department" class="form-control" placeholder="R&D / DEDE">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="test@example.com">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Tel</label>
                    <input type="text" name="tel" class="form-control" placeholder="">
                </div>
                <hr class="mt-3">
            </div>

            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="form-label">Project Name</label>
                    <input type="text" name="project_name" class="form-control" placeholder="">
                </div>
                <div class="col-md-8 mb-2">
                    <label class="form-label">Test Requirement</label>
                    <div class="row g-2 align-items-center">
                        {{-- Checkbox 1 --}}
                        <div class="col-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pretestCheckbox" name="requirement_pretest">
                                <label class="form-check-label text-checkbox me-2" for="pretestCheckbox">Internal
                                    pre-test</label>
                            </div>
                        </div>

                        {{-- Input field --}}
                        <div class="col me-2">
                            <input type="text" name="pretest_note" class="form-control" placeholder="for">
                        </div>

                        {{-- Checkbox 2 --}}
                        <div class="col-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="certCheckbox" name="requirement_certificate">
                                <label class="form-check-label text-checkbox me-2" for="certCheckbox">Test for request
                                    certificate</label>
                            </div>
                        </div>

                        {{-- Select list --}}
                        <div class="col">
                            <select class="form-select" name="certificate_option">
                                <option value="" disabled selected>Please select</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr class="mt-3">
            </div>

            <div class="row mb-2">
                <div class="col-md-12">
                    <label class="form-label">Test System</label>
                    <div class="row g-2 align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between">
                                {{-- Radio --}}
                                <div class="d-flex align-items-center flex-grow-1 me-3">
                                    <input class="form-check-input me-2" type="radio" name="test_system" id="test1" value="EUT_both">
                                    <label class="form-check-label text-radio" for="test1">
                                        EUT (Outdoor + Indoor)
                                    </label>
                                </div>
                                <div class="d-flex align-items-center flex-grow-1 me-3">
                                    <input class="form-check-input me-2" type="radio" name="test_system" id="test2" value="EUT_outdoor">
                                    <label class="form-check-label text-radio" for="test2">
                                        EUT Outdoor only (Dummy Indoor)
                                    </label>
                                </div>
                                <div class="d-flex align-items-center flex-grow-1">
                                    <input class="form-check-input me-2" type="radio" name="test_system" id="test3" value="EUT_indoor">
                                    <label class="form-check-label text-radio" for="test3">
                                        EUT Indoor only (Dummy Outdoor)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex align-items-center">
                            <input class="form-check-input me-2" type="radio" name="test_system" id="test4" value="other">
                            <label class="form-check-label text-radio me-2" for="test4">Other</label>
                            <input type="text" name="test_system_other" class="form-control" placeholder="Remote controller">
                        </div>
                    </div>

                    {{-- หมายเหตุ --}}
                    <div class="mt-1">
                        <small class="text-muted text-radio">*EUT = Equipment under test</small>
                    </div>
                </div>
                <hr class="mt-3">
            </div>

            {{-- Date Picker --}}
            <div class="row mb-2">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Unit delivery date</label>
                    <input type="date" name="unit_delivery_date" class="form-control">
                </div>
            </div>
        </div>
    </div>
</body>
</html>