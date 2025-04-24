@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>List Siswa, Kelas, dan Guru</h4>
    <table class="table table-bordered" id="siswaKelasGuruTable">
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Siswa</th>
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
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'siswa',
                    name: 'siswa'
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