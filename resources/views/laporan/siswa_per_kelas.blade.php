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
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
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