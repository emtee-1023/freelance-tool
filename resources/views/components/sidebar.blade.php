<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Str::startswith($activePage, 'dashboard') ? '' : 'collapsed' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Str::startsWith($activePage, 'freelancers') ? '' : 'collapsed' }}"
                href="{{ route('freelancers.index') }}">
                <i class="bi bi-people"></i>
                <span>Freelancers</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Str::startsWith($activePage, 'fiverr-accounts') ? '' : 'collapsed' }}"
                href="{{ route('fiverr-accounts.index') }}">
                <i class="bi bi-briefcase"></i>
                <span>Fiverr Accounts</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Str::startsWith($activePage, 'tasks') ? '' : 'collapsed' }}"
                href="{{ route('tasks.index') }}">
                <i class="bi bi-check2-square"></i>
                <span>Tasks</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Alerts</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Accordion</span>
                    </a>
                </li>
                <li>
                    <a href="components-badges.html">
                        <i class="bi bi-circle"></i><span>Badges</span>
                    </a>
                </li>
                <li>
                    <a href="components-spinners.html">
                        <i class="bi bi-circle"></i><span>Spinners</span>
                    </a>
                </li>
                <li>
                    <a href="components-tooltips.html">
                        <i class="bi bi-circle"></i><span>Tooltips</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav --> --}}

        <li class="nav-heading">Settings</li>

        <li class="nav-item">
            <a class="nav-link {{ Str::startsWith($activePage, 'profile') ? '' : 'collapsed' }}"
                href="{{ route('profile.edit') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        @if (Auth::user() && Auth::user()->user_type === 'admin')
            <li class="nav-item">
                <a href="{{ route('admins.create') }}"
                    class="nav-link {{ Str::startsWith($activePage, 'admin') ? '' : 'collapsed' }}">
                    <i class="bi bi-person-plus"></i> {{-- Optional icon --}}
                    Add Admin
                </a>
            </li>
        @endif

    </ul>

</aside>
