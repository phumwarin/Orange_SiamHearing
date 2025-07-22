<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme pt-2">
    <div class="app-brand demo">
        <div class="app-brand-logo-wrapper">
            <a href="index.html" class="app-brand-link d-flex align-items-center">
                <img src="assets/img/illustrations/Daikin-Logo.png" alt="Daikin Logo" class="app-brand-logo mw-100" />
            </a>
        </div>

        <a href="javascript:void(0);" class="layout-menu-toggle text-large ms-auto icon-toggle-color">
            <span id="menuToggleIcon" class="d-none d-xl-block align-middle">
                {{-- สำหรับ Desktop view: chevron-left / chevron-right --}}
                <span class="icon-chevron-left">
                    @include('admin.layout.components.inc_toggle_icons', ['icon' => 'chevron-left'])
                </span>
                <span class="icon-chevron-right d-none">
                    @include('admin.layout.components.inc_toggle_icons', ['icon' => 'chevron-right'])
                </span>
            </span>

            <span class="d-block d-xl-none align-middle icon-x">
                {{-- สำหรับ Mobile view: ไอคอน X --}}
                @include('admin.layout.components.inc_toggle_icons', ['icon' => 'x'])
            </span>
        </a>
    </div>

    {{-- <div class="menu-inner-shadow"></div> --}}

    <ul class="menu-inner py-3">
        <li class="menu-item">
            <a href="/admin/job" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'job'])
                <div data-i18n="Job" class="menu-color">Job</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/lab-availability" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'lab'])
                <div data-i18n="Lab Availability" class="menu-color">Lab Availability</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/iso-documents" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'iso'])
                <div data-i18n="ISO Documents" class="menu-color">ISO Documents</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/backup-file" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'backup'])
                <div data-i18n="Backup file" class="menu-color">Backup file</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/project-status-report" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'report'])
                <div data-i18n="Project Status Report" class="menu-color">Project Status Report</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/project-visualization" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'visualization'])
                <div data-i18n="Project Visualization" class="menu-color">Project Visualization</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/test-equipment" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'test'])
                <div data-i18n="Test Equipment" class="menu-color">Test Equipment</div>
            </a>
        </li>
    </ul>
</aside>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    setTimeout(() => {
        document.querySelectorAll('.menu-item').forEach(item => {
            const hasActiveChild = item.querySelector('.menu-sub .menu-item.active');
            if (hasActiveChild) {
                item.classList.add('open');
            }
        });
    }, 500);

    document.addEventListener("DOMContentLoaded", function() {
        var links = document.querySelectorAll("ul li a");
        var currentUrl = window.location.pathname;

        links.forEach(function(link) {
            if (link.getAttribute("href") === currentUrl) {
                link.parentElement.classList.add("active");
            }
        });
    });
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".layout-menu-toggle");
    const iconLeft = document.querySelector(".icon-chevron-left");
    const iconRight = document.querySelector(".icon-chevron-right");

    function isMenuCollapsed() {
        return (
            document.body.classList.contains("layout-menu-collapsed") ||
            document.documentElement.classList.contains("layout-menu-collapsed") ||
            document.querySelector(".layout-wrapper")?.classList.contains("layout-menu-collapsed")
        );
    }

    function updateMenuToggleIcon() {
        const collapsed = isMenuCollapsed();
        if (collapsed) {
            iconLeft.classList.add("d-none");
            iconRight.classList.remove("d-none");
        } else {
            iconLeft.classList.remove("d-none");
            iconRight.classList.add("d-none");
        }
    }

    updateMenuToggleIcon();

    toggleBtn.addEventListener("click", () => {
        setTimeout(updateMenuToggleIcon, 100);
    });
});
</script>
