<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')
</head>
<style>

    .text-checkbox {
        font-size: 13px;
        align-self: center;
    }

    .text-position {
        font-size: 13px;
        position: relative;
        top: 0px !important;
    }

    .form-label {
        font-weight: 450;
    }

    .form-select {
        font-size: 13px;
    }

    hr {
        color: #F5F5F5;
    }
</style>

<body>
    <div>
        <h6 class="mb-3 mt-3">Requirement and Test Condition</h6>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <!-- Radio + Text Field --> 
                    <div class="d-flex align-items-center mb-3">
                        <div class="form-check form-check-inline me-2">
                            <input class="form-check-input" type="radio" name="test_type" id="emissionRadio">
                            <label class="form-check-label text-position" for="emissionRadio">Emission</label>
                        </div>
                        <input type="text" class="form-control" placeholder="" />
                    </div>

                    <!-- Checkboxes -->
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="emission1">
                        <label class="form-check-label text-checkbox" for="emission1">Internal pre-test</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="emission2">
                        <label class="form-check-label text-checkbox" for="emission2">Conducted emission (CE) Main /
                            Load</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="emission3">
                        <label class="form-check-label text-checkbox" for="emission3">Power Disturbance (PD)</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="emission4">
                        <label class="form-check-label text-checkbox" for="emission4">Discontinuous disturbances
                            (Click)</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="emission5">
                        <label class="form-check-label text-checkbox" for="emission5">Radiated Emission (RE)</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="emission6">
                        <label class="form-check-label text-checkbox" for="emission6">Magnetic field (MF) / EMF
                            IEC62233</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Radio + Text Field -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="form-check form-check-inline me-2">
                            <input class="form-check-input" type="radio" name="test_type" id="immunityRadio">
                            <label class="form-check-label text-position" for="immunityRadio">Immunity</label>
                        </div>
                        <input type="text" class="form-control" placeholder="" />
                    </div>

                    <!-- Checkboxes -->
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="immunity1">
                        <label class="form-check-label text-checkbox" for="immunity1">ESD Immunity Test (ESD)</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="immunity2">
                        <label class="form-check-label text-checkbox" for="immunity2">Radiated Immunity Test
                            (RI)</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="immunity3">
                        <label class="form-check-label text-checkbox" for="immunity3">Surge Immunity Test (SI)</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="immunity4">
                        <label class="form-check-label text-checkbox" for="immunity4">Conducted Immunity Test
                            (CI)</label>
                    </div>
                    <div class="form-check ms-4 mb-2">
                        <input class="form-check-input" type="checkbox" id="immunity6">
                        <label class="form-check-label text-checkbox" for="immunity6">Voltage Dips, Interruptions and
                            Voltage Variations (VDI)</label>
                    </div>
                </div>
            </div>
            <hr class="mt-4">

            <div class="row mb-2">
                <div class="col-md-5">
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <div class="form-check ms-4 mb-2">
                                <input class="form-check-input" type="checkbox" id="harmonic1">
                                <label class="form-check-label text-checkbox mb-0 me-2" for="harmonic1">Harmonic
                                    current emissions</label>
                            </div>
                        </div>
                        <div class="col">
                            <select class="form-select">
                                <option value="" disabled selected>Please select</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 align-items-center mt-2">
                        <div class="col-auto">
                            <div class="form-check ms-4 mb-2">
                                <input class="form-check-input" type="checkbox" id="qsk">
                                <label class="form-check-label text-checkbox mb-0 me-2" for="qsk">QSK Standard
                                    (Daikin)</label>
                            </div>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <div class="form-check ms-4 mb-2">
                                <input class="form-check-input" type="checkbox" id="flicker1">
                                <label class="form-check-label text-checkbox mb-0 me-2" for="flicker1">Voltage
                                    Fluctuation and Flicker</label>
                            </div>
                        </div>
                        <div class="col">
                            <select class="form-select">
                                <option value="" disabled selected>Please select</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 align-items-center mt-2">
                        <div class="col-auto">
                            <div class="form-check ms-4 mb-2">
                                <input class="form-check-input" type="checkbox" id="yt">
                                <label class="form-check-label text-checkbox mb-0 me-2" for="yt">YT Standard
                                    (Daikin)</label>
                            </div>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <hr class="mt-4">

            {{-- Test Lab Section --}}
            <div class="row mb-2">
                {{-- Radio --}}
                <div class="col-md-12">
                    <label class="form-label mb-3">Test Lab</label>
                    <div class="row g-2 align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex flex-wrap align-items-center gap-4">
                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="test_system"
                                        id="test1">
                                    <label class="form-check-label text-radio mb-0" for="test1">EMC CHAMBER</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="test_system"
                                        id="test2">
                                    <label class="form-check-label text-radio mb-0" for="test2">EMC SHIELD
                                        ROOM</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-3">

                {{-- Test Schedule Require & Test Report Require --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label mb-2">Test Schedule Require</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-2">Test Report Require</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-3">

                {{-- Report --}}
                <div class="col-md-12">
                    <label class="form-label mb-3">Report</label>
                    <div class="row g-2 align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex flex-wrap align-items-center gap-4">
                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="test_system"
                                        id="internal_test">
                                    <label class="form-check-label text-position mb-0" for="internal_test">Internal test
                                        data</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="test_system"
                                        id="full_report">
                                    <label class="form-check-label text-position mb-0" for="full_report">Full test report
                                        for certificate</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Button from submit_action.blade.php --}}
            @include('admin.job.section.submit_action')
        </div>
    </div>
</body>

</html>