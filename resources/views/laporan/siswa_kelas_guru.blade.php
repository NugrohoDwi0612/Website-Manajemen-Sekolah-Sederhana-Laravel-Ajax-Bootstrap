@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>List Siswa, Kelas, dan Guru</h4>
    <table class="table table-bordered" id="siswaKelasGuruTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Kelas</th>
                <th>Guru</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('#siswaKelasGuruTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/laporan/data/siswa-kelas-guru') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nisn',
                    name: 'nisn'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'guru',
                    name: 'guru'
                },
            ]
        });
    });
</script>
@endpush