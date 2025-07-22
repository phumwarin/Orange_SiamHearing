<!doctype html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    @include('admin/layout/inc_header')

    {{-- Load styles from: public\css\job-index.css --}}
    <link rel="stylesheet" href="{{ asset('css/add-indoor.css') }}">
</head>

<body>
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIndoor">
            <i class="ti ti-plus me-1"></i> Indoor Add More
        </button>
    </div>

    {{-- Table --}}
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered custom-table" id="indoorTable">
                    <thead class="table-light">
                        <tr class="text-center align-middle">
                            <th>Item</th>
                            <th>Model(s) tested</th>
                            <th>Product type</th>
                            <th>Rated Voltage (V) and Frequency (Hz)</th>
                            <th>Current Rating (A)</th>
                            <th>Adding Series Model</th>
                        </tr>
                    </thead>
                    <tbody id="indoorTableBody">
                        <tr>
                            <td colspan="6" class="text-center text-muted">No data available</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addIndoor" tabindex="-1" aria-labelledby="addIndoorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 pb-0">
                    <div class="d-flex justify-content-between align-items-start w-100 mb-4 mt-2">
                        <div>
                            <h5 class="modal-title fw-bold" id="addIndoorLabel">INDOOR UNIT</h5>
                        </div>
                        <button type="button" class="position-absolute top-0 end-0 mt-3 me-3 border-0 bg-transparent"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="ti ti-x fs-4"></i>
                        </button>
                    </div>
                </div>

                <div class="modal-body py-0">
                    <form id="indoorForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Model(s) tested: Indoor</label>
                                <input type="text" class="form-control" name="model_tested" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Product type</label>
                                <input type="text" class="form-control" name="product_type"
                                    placeholder="Example: Wallmount, Cassette, Ceiling, Duct" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rated Voltage (V) and Frequency (Hz)</label>
                            <input type="text" class="form-control" name="rated_voltage"
                                placeholder="Example: 1P 220-240V/50Hz" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Current Rating (A)</label>
                                <input type="text" class="form-control" name="current_rating" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Uses (Kg)</label>
                                <input type="text" class="form-control" name="uses">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">More Information</label>
                            <textarea class="form-control" name="more_info" rows="3"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer justify-content-center border-top-0">
                    <button type="button" class="btn btn-success" id="addIndoorBtn"
                        data-bs-dismiss="modal">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add Series Model -->
    <div class="modal fade" id="addSeriesModelModal" tabindex="-1" aria-labelledby="addSeriesModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addSeriesModelLabel">Add Series Model</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="seriesModelForm">
                        <div class="mb-3">
                            <label class="form-label">Series Model Name</label>
                            <input type="text" class="form-control" name="series_name"
                                placeholder="e.g. ACX100-TH" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="series_description" rows="3" placeholder="Optional"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script>
    let itemCount = 0;

    document.getElementById('addIndoorBtn').addEventListener('click', function () {
        const form = document.getElementById('indoorForm');
        const formData = new FormData(form);

        const model = formData.get('model_tested');
        const product = formData.get('product_type');
        const voltage = formData.get('rated_voltage');
        const current = formData.get('current_rating');

        if (!model || !product || !voltage || !current) return;

        const tbody = document.getElementById('indoorTableBody');

        // Clear "No data available"
        if (tbody.children.length === 1 && tbody.children[0].textContent.includes("No data")) {
            tbody.innerHTML = '';
        }

        itemCount++;

        const tr = document.createElement('tr');
        tr.setAttribute('data-row-id', itemCount); // Set data attribute to identify this row
        tr.innerHTML = `
            <td class="text-center">${itemCount}</td>
            <td>${model}</td>
            <td>${product}</td>
            <td>${voltage}</td>
            <td>${current}</td>
            <td class="text-center">
                <button class="btn btn-sm btn-info me-1 btn-add-series" data-row-id="${itemCount}">
                    <i class="ti ti-plus"></i>
                </button>
                <button class="btn btn-sm btn-danger btn-delete-row"><i class="ti ti-x"></i></button>
            </td>
        `;
        tbody.appendChild(tr);

        form.reset();
    });

    // Delegate event: open Add Series modal
    document.addEventListener('click', function (e) {
        const seriesBtn = e.target.closest('.btn-add-series');
        if (seriesBtn) {
            const rowId = seriesBtn.getAttribute('data-row-id');

            // You can store rowId for use in modal logic later
            document.getElementById('seriesModelForm').setAttribute('data-target-row', rowId);

            const addSeriesModal = new bootstrap.Modal(document.getElementById('addSeriesModelModal'));
            addSeriesModal.show();
        }

        // Optional: delete row
        const deleteBtn = e.target.closest('.btn-delete-row');
        if (deleteBtn) {
            const row = deleteBtn.closest('tr');
            row.remove();

            // Reset numbering if needed
            const tbody = document.getElementById('indoorTableBody');
            if (!tbody.children.length) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted">No data available</td></tr>`;
                itemCount = 0;
            } else {
                [...tbody.children].forEach((tr, index) => {
                    tr.children[0].innerText = index + 1;
                    tr.setAttribute('data-row-id', index + 1);
                    const btn = tr.querySelector('.btn-add-series');
                    if (btn) btn.setAttribute('data-row-id', index + 1);
                });
                itemCount = tbody.children.length;
            }
        }
    });
</script>

</body>

</html>
