<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Peminjaman Alat')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #2563EB;
            --navy-dark: #1D4ED8;
            --amber: #3B82F6;
            --amber-dark: #2563EB;
            --bg: #F5F8FF;
            --border: #DBEAFE;
            --success: #22C55E;
            --danger: #EF4444;
        }

        /* Background Abstrak Berpola Modern */
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-color: #f4f7fe;
            background-image: 
                radial-gradient(at 90% 10%, rgba(37, 99, 235, 0.08) 0px, transparent 50%),
                radial-gradient(at 10% 90%, rgba(59, 130, 246, 0.08) 0px, transparent 50%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232563eb' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-attachment: fixed;
        }

        h1, h2, h3, h4, h5, .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
        }

        /* Navigasi Header */
        .navbar-dark.bg-dark {
            background-color: var(--navy) !important;
            border-bottom: 3px solid var(--amber);
        }

        .navbar-dark .nav-link {
            color: rgba(255,255,255,.75) !important;
            position: relative;
        }

        .navbar-dark .nav-link:hover,
        .navbar-dark .nav-link.active {
            color: #fff !important;
            font-weight: 600;
        }

        .navbar-dark .nav-link.active::after {
            content: "";
            position: absolute;
            left: .5rem;
            right: .5rem;
            bottom: -2px;
            height: 3px;
            border-radius: 2px;
            background-color: #fff;
        }

        /* Button Default */
        .btn-primary {
            background-color: var(--navy);
            border-color: var(--navy);
        }
        .btn-primary:hover {
            background-color: var(--navy-dark);
            border-color: var(--navy-dark);
        }

        /* Penyesuaian Ukuran Card Utama (Diperbesar) */
        .card {
            border: 1px solid var(--border);
            border-radius: 16px; /* Lengkungan lebih elegan */
            transition: all 0.25s ease-in-out;
        }

        /* Style Khusus Kartu Statistik / Dashboard (Ukuran Lebih Besar) */
        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            min-height: 120px; /* Ukuran tinggi minimal kartu diperbesar */
        }

        .stat-card .card-body {
            padding: 1.5rem !important; /* Padding dalam diperbesar */
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -4px rgba(37, 99, 235, 0.12);
        }

        .stat-icon {
            width: 58px; /* Ukuran ikon diperbesar dari 48px ke 58px */
            height: 58px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem; /* Ukuran font ikon diperbesar */
            flex-shrink: 0;
        }

        /* Alert Notification */
        .alert-success {
            border-left: 4px solid var(--success);
        }
        .alert-danger {
            border-left: 4px solid var(--danger);
        }
    </style>
</head>

<body>

    @include('layouts.navbar')

    <div class="container py-4">
        @if (session('sukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('gagal'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('gagal') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('konten')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>