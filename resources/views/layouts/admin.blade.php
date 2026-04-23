<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FastBites Admin')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    @stack('styles')
</head>
<body>
    <button class="mobile-menu-toggle" type="button" aria-label="Open menu" aria-controls="adminSidebar" aria-expanded="false">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16v2H4zm0 8h16v2H4zm0-4h16v2H4z" /></svg>
    </button>

    <div class="sidebar-overlay" aria-hidden="true"></div>

    <div class="admin-shell">
        <aside class="admin-sidebar" id="adminSidebar">
            <div>
                <div class="brand-block">
                    <div class="sidebar-brand-row">
                        <a href="{{ auth()->check() ? route(auth()->user()->getDashboardRoute()) : url('/') }}" class="brand-logo-link"><img src="{{ asset('images/logo.png') }}" alt="FastBites Logo" class="brand-logo"></a>                        
                        <button class="drawer-close-button" type="button" aria-label="Close menu">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.3 5.71 12 12l6.3 6.29-1.41 1.41L10.59 13.4 4.29 19.7 2.88 18.29 9.17 12 2.88 5.71 4.29 4.3l6.3 6.29 6.29-6.3z" /></svg>
                        </button>
                    </div>
                    <p class="brand-subtitle">Admin Panel</p>
                </div>

                <nav class="sidebar-nav">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5zm2 0V11h5V6zm7 0v5h5V5.5zM6 13v5.5h5V13zm7 0v5.5h5V13z" /></svg>
                        </span>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.employees') }}" class="nav-item {{ request()->routeIs('admin.employees') || request()->routeIs('admin.employees.create') || request()->routeIs('admin.employees.edit') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M16 11a4 4 0 1 0-3.999-4A4 4 0 0 0 16 11zm-8 1a3 3 0 1 0-3-3 3 3 0 0 0 3 3zm8 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zM8 14c-.29 0-.62.02-.97.05C4.47 14.3 2 15.29 2 17v2h6v-1c0-1.23.62-2.28 1.67-3.11A7.29 7.29 0 0 0 8 14z"/>
                            </svg>
                        </span>
                        <span>Manage Employees</span>
                    </a>

                    <a href="{{ route('admin.manage-restaurants') }}" class="nav-item {{ request()->routeIs('admin.manage-restaurants') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2H3zm0 4h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm4 2v2h4v-2z" /></svg>
                        </span>
                        <span>Manage Restaurants</span>
                    </a>

                    <a href="{{ route('admin.orders') }}" class="nav-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2H3zm0 4h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm4 2v2h4v-2z" /></svg>
                        </span>
                        <span>Orders</span>
                    </a>

                    <a href="{{ route('admin.reports') }}" class="nav-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 3h2v14h14v2H5zm4 10 3-3 2 2 4-5 1.6 1.2-5.3 6.63-2.1-2.1-2.8 2.8z" /></svg>
                        </span>
                        <span>Reports</span>
                    </a>

                    <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m19.14 12.94.04-.94-.04-.94 2.03-1.58a.5.5 0 0 0 .12-.64l-1.92-3.32a.5.5 0 0 0-.6-.22l-2.39.96a7.24 7.24 0 0 0-1.63-.94L14.4 2.8a.5.5 0 0 0-.49-.4h-3.84a.5.5 0 0 0-.49.4L9.25 5.3c-.58.23-1.12.54-1.63.94l-2.39-.96a.5.5 0 0 0-.6.22L2.71 8.82a.5.5 0 0 0 .12.64l2.03 1.58-.04.94.04.94-2.03 1.58a.5.5 0 0 0-.12.64l1.92 3.32a.5.5 0 0 0 .6.22l2.39-.96c.5.4 1.05.71 1.63.94l.33 2.5a.5.5 0 0 0 .49.4h3.84a.5.5 0 0 0 .49-.4l.33-2.5c.58-.23 1.12-.54 1.63-.94l2.39.96a.5.5 0 0 0 .6-.22l1.92-3.32a.5.5 0 0 0-.12-.64zM12 15.5A3.5 3.5 0 1 1 15.5 12 3.5 3.5 0 0 1 12 15.5" /></svg>
                        </span>
                        <span>Settings</span>
                    </a>
                </nav>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item logout-link">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17v-2h4V9h-4V7h4a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2zm9-5-4 4v-3H8v-2h7V8zM5 19h6v2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6v2H5z" /></svg>
                    </span>
                    <span>Log Out</span>
                </button>
            </form>
        </aside>

        <main class="admin-main">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const sidebar = document.querySelector('.admin-sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        const drawerCloseButton = document.querySelector('.drawer-close-button');

        if (menuToggle && sidebar && overlay) {
            const setMenuState = (isOpen) => {
                document.body.classList.toggle('sidebar-open', isOpen);
                menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                overlay.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            };

            menuToggle.addEventListener('click', () => {
                setMenuState(!document.body.classList.contains('sidebar-open'));
            });

            overlay.addEventListener('click', () => setMenuState(false));
            drawerCloseButton?.addEventListener('click', () => setMenuState(false));

            window.addEventListener('resize', () => {
                if (window.innerWidth > 1100) {
                    setMenuState(false);
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>