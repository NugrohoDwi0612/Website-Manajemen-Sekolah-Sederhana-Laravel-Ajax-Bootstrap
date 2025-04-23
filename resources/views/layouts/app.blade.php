<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manajemen Sekolah')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Sekolah</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('siswa.index') }}">Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guru.index') }}">Guru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a>
                </li>
                <!-- Dropdown menu untuk laporan -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        List
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('laporan.siswaPerKelas') }}">Siswa per Kelas</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('laporan.guruPerKelas') }}">Guru per Kelas</a></li>
                        <li><a class="dropdown-item" href="{{ route('laporan.siswaKelasGuru') }}">Siswa, Kelas &
                                Guru</a></li>
                    </ul>
                </li>
            </ul>

            <form action="{{ route('logout') }}" method="GET" class="d-flex">
                @csrf
                <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
            </form>
        </div>
    </nav>

    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    @stack('scripts')

</body>

</html>