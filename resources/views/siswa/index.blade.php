@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Data Siswa</h2>
    <button class="btn btn-primary mb-3" id="createNewSiswa">Tambah Siswa</button>
    <table class="table table-bordered" id="siswaTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Kelas</th>
                <th>Orang Tua</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="siswaForm" name="siswaForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="siswaModalLabel">Tambah Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="siswa_id" id="siswa_id">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas_id" class="form-label">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $kls)
                            <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="orangtua_id" class="form-label">Orang Tua</label>
                        <select name="orangtua_id" id="orangtua_id" class="form-select" required>
                            <option value="">-- Pilih Orang Tua --</option>
                            @foreach($orangtua as $ot)
                            <option value="{{ $ot->id }}">{{ $ot->nama_orangtua }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
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
        let table = $('#siswaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('siswa.index') }}",
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
                    data: 'orang_tua',
                    name: 'orang_tua'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#createNewSiswa').click(function() {
            $('#siswa_id').val('');
            $('#siswaForm').trigger("reset");
            $('#siswaModalLabel').html("Tambah Siswa");
            $('#siswaModal').modal('show');
        });

        $('body').on('click', '.editSiswa', function() {
            let id = $(this).data('id');
            $.get("{{ url('siswa/edit') }}/" + id, function(data) {
                $('#siswaModalLabel').html("Edit Siswa");
                $('#siswaModal').modal('show');
                $('#siswa_id').val(data.id);
                $('#nama').val(data.nama);
                $('#nisn').val(data.nisn);
                $('#kelas_id').val(data.kelas_id);
                $('#orangtua_id').val(data.orangtua_id);
            });
        });

        $('#siswaForm').submit(function(e) {
            e.preventDefault();
            let actionUrl = $('#siswa_id').val() ? "{{ url('siswa') }}/" + $('#siswa_id').val() :
                "{{ route('siswa.store') }}";
            let method = $('#siswa_id').val() ? 'PUT' : 'POST';

            $.ajax({
                data: $('#siswaForm').serialize(),
                url: actionUrl,
                type: method,
                success: function(data) {
                    $('#siswaForm').trigger("reset");
                    $('#siswaModal').modal('hide');
                    table.draw();
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });


        $('body').on('click', '.deleteSiswa', function() {
            let id = $(this).data("id");
            if (confirm("Yakin ingin menghapus siswa ini?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('siswa') }}/" + id,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        table.draw();
                    }
                });
            }
        });
    });
</script>
@endpush