@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h3>Selamat datang, {{ auth()->user()->name ?? 'Admin' }}!</h3>
            <p class="text-muted">Berikut ringkasan sistem manajemen sekolah.</p>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Siswa</h5>
                    <h2 class="text-primary">{{ $jumlahSiswa }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Kelas</h5>
                    <h2 class="text-success">{{ $jumlahKelas }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Guru</h5>
                    <h2 class="text-warning">{{ $jumlahGuru }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
