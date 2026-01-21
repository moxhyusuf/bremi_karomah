<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard.index') }}">
            <span class="align-middle">CV. Bremi Karomah</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ $title === 'Dashboard' ? 'active ' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            @if (auth()->user()->role === 'admin')
                <li class="sidebar-item {{ $title === 'User' ? 'active ' : '' }}">
                    <a class="sidebar-link" href="{{ route('user.index') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Kelola Users</span>
                    </a>
                </li>
            @endif

            <li class="sidebar-item {{ $title === 'Customer' ? 'active ' : '' }}">
                <a class="sidebar-link" href="{{ route('customer.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Customer</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title === 'Order' ? 'active ' : '' }}">
                <a class="sidebar-link" href="{{ route('order.index') }}">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">Order (IN)</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title === 'Material' ? 'active ' : '' }}">
                <a class="sidebar-link" href="{{ route('material.index') }}">
                    <i class="align-middle" data-feather="codesandbox"></i> <span class="align-middle">Materials</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title === 'Production' ? 'active ' : '' }}">
                <a class="sidebar-link" href="{{ route('production.index') }}">
                    <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Production</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title === 'Delivery' ? 'active ' : '' }}">
                <a class="sidebar-link" href="{{ route('delivery.index') }}">
                    <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Delivery (Out)</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title === 'Report' ? 'active ' : '' }}">
                <a class="sidebar-link" href="{{ route('report.index') }}">
                    <i class="align-middle" data-feather="flag"></i> <span class="align-middle">Report</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
