@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>List Siswa berdasarkan Kelas</h4>
    <table class="table table-bordered" id="siswaKelasTable">
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Nama Siswa</th>
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
                data: 'kelas',
                name: 'kelas'
            },
            {
                data: 'siswa',
                name: 'siswa'
            },
        ]
    });
});
</script>
@endpush
