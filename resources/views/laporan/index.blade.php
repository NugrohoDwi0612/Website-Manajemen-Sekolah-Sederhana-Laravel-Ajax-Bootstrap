@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Laporan Siswa, Kelas, dan Guru</h2>

    @foreach($kelasList as $kelas)
    <div class="card mt-4">
        <div class="card-header">
            <strong>Kelas: {{ $kelas->nama_kelas }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Guru Pengajar:</strong></p>
            <ul>
                @forelse($kelas->guru as $guru)
                <li>{{ $guru->nama }} (NIP: {{ $guru->nip }})</li>
                @empty
                <li><em>Tidak ada guru</em></li>
                @endforelse
            </ul>

            <p><strong>Daftar Siswa:</strong></p>
            <ul>
                @forelse($kelas->siswa as $siswa)
                <li>{{ $siswa->nama }} (NISN: {{ $siswa->nisn }})</li>
                @empty
                <li><em>Tidak ada siswa</em></li>
                @endforelse
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection
