@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>List Guru berdasarkan Kelas</h4>
    <table class="table table-bordered" id="guruKelasTable">
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Nama Guru</th>
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