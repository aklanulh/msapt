<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - MSA')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e88e5;
            --primary-dark: #1565c0;
            --primary-light: #42a5f5;
            --secondary-color: #546e7a;
            --success-color: #43a047;
            --danger-color: #e53935;
            --warning-color: #fb8c00;
            --info-color: #00acc1;
            --light-bg: #f5f7fa;
            --white: #ffffff;
            --text-dark: #2c3e50;
            --text-muted: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--text-dark);
        }

        .sidebar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            color: white;
            box-shadow: 4px 0 15px rgba(30, 136, 229, 0.2);
            border-radius: 0 20px 20px 0;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.9);
            padding: 15px 20px;
            border-radius: 12px;
            margin: 6px 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .sidebar .nav-link:hover::before {
            left: 100%;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(8px) scale(1.02);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            border-left: 4px solid #fff;
        }

        .sidebar .nav-link .badge {
            font-size: 0.7rem;
            padding: 0.3em 0.6em;
            border-radius: 50px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .main-content {
            padding: 25px;
            background: transparent;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            border-radius: 20px 20px 0 0 !important;
            padding: 20px 25px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="90" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .card-title {
            font-weight: 600;
            margin: 0;
            font-size: 1.25rem;
        }

        .stats-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(30, 136, 229, 0.1);
        }

        .stats-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 50px rgba(30, 136, 229, 0.2);
        }

        .stats-card .card-body {
            padding: 30px 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 136, 229, 0.4);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 136, 229, 0.3);
        }

        .btn-outline-info {
            color: var(--info-color);
            border-color: var(--info-color);
            border-radius: 12px;
        }

        .btn-outline-warning {
            color: var(--warning-color);
            border-color: var(--warning-color);
            border-radius: 12px;
        }

        .btn-outline-danger {
            color: var(--danger-color);
            border-color: var(--danger-color);
            border-radius: 12px;
        }

        .btn-outline-success {
            color: var(--success-color);
            border-color: var(--success-color);
            border-radius: 12px;
        }

        .alert {
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(67, 160, 71, 0.1) 0%, rgba(67, 160, 71, 0.05) 100%);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(229, 57, 53, 0.1) 0%, rgba(229, 57, 53, 0.05) 100%);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            font-weight: 600;
            padding: 15px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(30, 136, 229, 0.05);
            transform: scale(1.01);
        }

        .badge {
            border-radius: 50px;
            padding: 0.5em 0.8em;
            font-weight: 500;
        }

        .badge-info {
            background: linear-gradient(135deg, var(--info-color) 0%, #26c6da 100%);
        }

        .badge-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #ffb74d 100%);
        }

        .badge-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #66bb6a 100%);
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid rgba(30, 136, 229, 0.1);
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.25);
        }

        .pagination .page-link {
            border-radius: 10px;
            margin: 0 2px;
            border: none;
            color: var(--primary-color);
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
        }

        .pagination .page-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(30, 136, 229, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card, .alert {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Mobile Sidebar Toggle */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1050;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 15px;
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.3);
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
            backdrop-filter: blur(5px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 280px;
                z-index: 1045;
                border-radius: 0 20px 20px 0;
                transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 4px 0 25px rgba(30, 136, 229, 0.3);
            }
            
            .sidebar.show {
                left: 0;
            }

            .sidebar .nav-link {
                margin: 6px 12px;
                padding: 15px 20px;
            }

            .main-content {
                padding: 80px 15px 15px 15px;
                margin-left: 0;
            }
            
            .card {
                border-radius: 15px;
            }

            .container-fluid .row {
                margin: 0;
            }

            .col-md-3.col-lg-2 {
                padding: 0;
            }

            .col-md-9.col-lg-10 {
                padding: 0;
                width: 100%;
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                position: relative;
                left: 0;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Mobile Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar">
                    <div class="p-3">
                        <h4 class="text-center mb-4">
                            <i class="fas fa-cogs me-2"></i>Admin Panel
                        </h4>
                        <hr style="border-color: rgba(255,255,255,0.3);">
                    </div>
                    
                    <nav class="nav flex-column px-3">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}" href="{{ route('admin.products') }}">
                            <i class="fas fa-box me-2"></i>Kelola Produk
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.project-galleries*') ? 'active' : '' }}" href="{{ route('admin.project-galleries') }}">
                            <i class="fas fa-images me-2"></i>Kelola Galeri Proyek
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.trusted-clients*') ? 'active' : '' }}" href="{{ route('admin.trusted-clients') }}">
                            <i class="fas fa-hospital me-2"></i>Kelola Klien Terpercaya
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" href="{{ route('admin.contacts') }}">
                            <i class="fas fa-envelope me-2"></i>Pesan Kontak
                            @php
                                $unreadCount = \App\Models\Contact::whereNull('read_at')->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="badge bg-warning text-dark ms-2">{{ $unreadCount }}</span>
                            @endif
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.logs*') ? 'active' : '' }}" href="{{ route('admin.logs') }}">
                            <i class="fas fa-history me-2"></i>Log Aktivitas
                        </a>
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                        </a>
                        <hr style="border-color: rgba(255,255,255,0.3);">
                        <a class="nav-link" href="{{ route('admin.logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">@yield('page-title', 'Dashboard')</h2>
                        <div class="text-muted">
                            <i class="fas fa-user me-2"></i>Admin
                        </div>
                    </div>
                    
                    <!-- Alerts -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    <!-- Content -->
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Mobile Sidebar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            // Toggle sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('show');
                sidebarOverlay.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
                
                // Change icon
                const icon = sidebarToggle.querySelector('i');
                if (sidebar.classList.contains('show')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
            
            // Close sidebar
            function closeSidebar() {
                sidebar.classList.remove('show');
                sidebarOverlay.style.display = 'none';
                const icon = sidebarToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
            
            // Event listeners
            sidebarToggle.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);
            
            // Close sidebar when clicking on nav links (mobile)
            const navLinks = sidebar.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        setTimeout(closeSidebar, 200);
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
