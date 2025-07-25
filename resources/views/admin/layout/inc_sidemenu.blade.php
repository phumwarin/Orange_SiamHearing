<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme pt-2">
    <div class="app-brand demo">
        <div class="app-brand-logo-wrapper w-100 text-center">
            <a href="index.html" class="app-brand-link d-inline-block">
                <img src="assets/img/illustrations/Siamhearing-Logo.png" alt="SiamHearing Logo" class="mw-100" />
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

            <span class="d-block d-xl-none align-bottom icon-x">
                {{-- สำหรับ Mobile view: ไอคอน X --}}
                @include('admin.layout.components.inc_toggle_icons', ['icon' => 'x'])
            </span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-3">
        {{-- ▶ แดชบอร์ด --}}
        <li class="menu-item">
            <a href="/admin/dashboard" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'dashboard'])
                <div class="menu-color">แดชบอร์ด</div>
            </a>
        </li>

        {{-- ▶ สินค้า --}}
        <li class="menu-item has-sub">
            <a href="#" class="menu-link menu-toggle">
                @include('admin.layout.components.inc_icons', ['icon' => 'product'])
                <div class="menu-color">สินค้า</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin/products" class="menu-link">
                        <div class="menu-color">รายการสินค้า</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/product-categories" class="menu-link">
                        <div class="menu-color">หมวดสินค้า</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- ▶ ข้อมูลบุคคล --}}
        <li class="menu-item has-sub">
            <a href="#" class="menu-link menu-toggle">
                @include('admin.layout.components.inc_icons', ['icon' => 'customer'])
                <div class="menu-color">ข้อมูลบุคคล</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin/customers" class="menu-link">
                        <div class="menu-color">ลูกค้า</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/suppliers" class="menu-link">
                        <div class="menu-color">ซัพพลายเออร์</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- ▶ คลังสินค้า --}}
        <li class="menu-item has-sub">
            <a href="#" class="menu-link menu-toggle">
                @include('admin.layout.components.inc_icons', ['icon' => 'stock-in'])
                <div class="menu-color">คลังสินค้า</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin/stock-in" class="menu-link">
                        <div class="menu-color">รับสินค้าเข้า</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/stock-out" class="menu-link">
                        <div class="menu-color">ตัดสต๊อก</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/branch-transfer" class="menu-link">
                        <div class="menu-color">โอนสินค้าระหว่างสาขา</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- ▶ งานขาย --}}
        <li class="menu-item has-sub">
            <a href="#" class="menu-link menu-toggle">
                @include('admin.layout.components.inc_icons', ['icon' => 'sales'])
                <div class="menu-color">งานขาย</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin/quotations" class="menu-link">
                        <div class="menu-color">ใบเสนอราคา</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/sales" class="menu-link">
                        <div class="menu-color">เปิดบิลขาย</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/product-claims" class="menu-link">
                        <div class="menu-color">เคลมสินค้า</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/purchase-orders" class="menu-link">
                        <div class="menu-color">สั่งซื้อสินค้า</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- ▶ รายงาน --}}
        <li class="menu-item">
            <a href="/admin/reports" class="menu-link">
                @include('admin.layout.components.inc_icons', ['icon' => 'report'])
                <div class="menu-color">รายงาน</div>
            </a>
        </li>

        {{-- ▶ ผู้ใช้และการตั้งค่า --}}
        <li class="menu-item has-sub">
            <a href="#" class="menu-link menu-toggle">
                @include('admin.layout.components.inc_icons', ['icon' => 'permission'])
                <div class="menu-color">ผู้ใช้ & ตั้งค่า</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin/users" class="menu-link">
                        <div class="menu-color">ผู้ใช้ / สิทธิ์การเข้าถึง</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/settings" class="menu-link">
                        <div class="menu-color">ตั้งค่าระบบ</div>
                    </a>
                </li>
            </ul>
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

    document.addEventListener("DOMContentLoaded", function() {
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
