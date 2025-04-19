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
                    <a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guru.index') }}">Guru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('laporan.siswa-kelas-guru') }}">Laporan</a>
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

    @stack('scripts')

</body>

</html>
