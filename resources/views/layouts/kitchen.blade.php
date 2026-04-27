<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FastBites Kitchen')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    @stack('styles')
</head>
<body>
    <button class="mobile-menu-toggle" type="button" aria-label="Open menu" aria-controls="kitchenSidebar" aria-expanded="false">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16v2H4zm0 8h16v2H4zm0-4h16v2H4z" /></svg>
    </button>
    <div class="sidebar-overlay" aria-hidden="true"></div>
    <div class="admin-shell">
        <aside class="admin-sidebar" id="kitchenSidebar">
            <div>
                <div class="brand-block">
                    <div class="sidebar-brand-row">
                        <a href="{{ url('/') }}" class="brand-logo-link">
    <img src="{{ asset('images/logo.png') }}" alt="FastBites Logo" class="sidebar-logo">
</a>   
                        <button class="drawer-close-button" type="button" aria-label="Close menu">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.3 5.71 12 12l6.3 6.29-1.41 1.41L10.59 13.4 4.29 19.7 2.88 18.29 9.17 12 2.88 5.71 4.29 4.3l6.3 6.29 6.29-6.3z" /></svg>
                        </button>
                    </div>
                    <p class="brand-subtitle">Kitchen Manager Panel</p>
                </div>

                <nav class="sidebar-nav">
                    <a href="{{ route('kitchen.dashboard') }}" class="nav-item {{ request()->routeIs('kitchen.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5zm2 0V11h5V6zm7 0v5h5V5.5zM6 13v5.5h5V13zm7 0v5.5h5V13z" /></svg>
                        </span>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('kitchen.new-orders') }}" class="nav-item {{ request()->routeIs('kitchen.new-orders') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4h10l1 3h2v2h-1l-1.1 8.12A2 2 0 0 1 15.92 19H8.08a2 2 0 0 1-1.98-1.88L5 9H4V7h2zm1.02 5 .88 8h6.2l.88-8zM9 2h2v2H9zm4 0h2v2h-2z" /></svg>
                        </span>
                        <span>New Orders</span>
                    </a>
                    <a href="{{ route('kitchen.preparing-orders') }}" class="nav-item {{ request()->routeIs('kitchen.preparing-orders') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 2h2v8H6zm5 0h2v8h-2zm5 0h2v8h-2zM4 12h16v2a8 8 0 0 1-16 0z" /></svg>
                        </span>
                        <span>Preparing Orders</span>
                    </a>
                    <a href="{{ route('kitchen.ready-orders') }}" class="nav-item {{ request()->routeIs('kitchen.ready-orders') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2 4 6v6c0 5 3.4 9.74 8 10 4.6-.26 8-5 8-10V6zm-1.2 13.2L7.6 12l1.4-1.4 1.8 1.8 4.2-4.2 1.4 1.4z" /></svg>
                        </span>
                        <span>Ready Orders</span>
                    </a>
                    <a href="{{ route('kitchen.completed-orders') }}" class="nav-item {{ request()->routeIs('kitchen.completed-orders') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z" /></svg>
                        </span>
                        <span>Completed Orders</span>
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
