@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>List Siswa berdasarkan Kelas</h4>
    <table class="table table-bordered" id="siswaKelasTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Kelas</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('#siswaKelasTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/laporan/data/siswa-kelas') }}",
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
            ]
        });
    });
</script>
@endpush