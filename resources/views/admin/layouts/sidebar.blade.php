<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                
                @if (auth()->user()->hasRole('Admin'))
                    <li {{ (\Request::is('admin/category') || \Request::is('admin/category/*')) ? 'class=mm-active' : '' }}>
                        <a href="{{ route('admin.category.index') }}" class="waves-effect {{ (\Request::is('admin/category') || \Request::is('admin/category/*')) ? 'active' : '' }}">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-dashboards">Category</span>
                        </a>
                    </li>
                @endif


                <li {{ (\Request::is('admin/product') || \Request::is('admin/product/*')) ? 'class=mm-active' : '' }}>
                    <a href="{{ route('admin.product.index') }}" class="waves-effect {{ (\Request::is('admin/product') || \Request::is('admin/product/*')) ? 'active' : '' }}">
                        <i class='bx bx-store'></i>
                        <span key="t-dashboards">Products</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
