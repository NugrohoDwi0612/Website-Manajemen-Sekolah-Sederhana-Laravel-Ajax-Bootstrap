@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>List Guru berdasarkan Kelas</h4>
    <table class="table table-bordered" id="guruKelasTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>NIP</th>
                <th>Kelas</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('#guruKelasTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/laporan/data/guru-kelas') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nip',
                    name: 'nip'
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