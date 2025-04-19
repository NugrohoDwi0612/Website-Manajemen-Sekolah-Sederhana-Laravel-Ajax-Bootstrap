@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Data Kelas</h2>
    <button class="btn btn-primary mb-3" id="createNewKelas">Tambah Kelas</button>
    <table class="table table-bordered" id="kelasTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="kelasModal" tabindex="-1" aria-labelledby="kelasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="kelasForm" name="kelasForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kelasModalLabel">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="kelas_id" id="kelas_id">
                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
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
        let table = $('#kelasTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('kelas.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_kelas',
                    name: 'nama_kelas'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createNewKelas').click(function() {
            $('#kelas_id').val('');
            $('#kelasForm').trigger("reset");
            $('#kelasModalLabel').html("Tambah Kelas");
            $('#kelasModal').modal('show');
        });

        $('body').on('click', '.editKelas', function() {
            let id = $(this).data('id');
            $.get("{{ url('kelas/edit') }}/" + id, function(data) {
                $('#kelasModalLabel').html("Edit Kelas");
                $('#kelasModal').modal('show');
                $('#kelas_id').val(data.id);
                $('#nama_kelas').val(data.nama_kelas);
            });
        });

        $('#kelasForm').submit(function(e) {
            e.preventDefault();
            let id = $('#kelas_id').val();
            let method = id ? 'PUT' : 'POST';
            let url = id ? "/kelas/update/" + id : "{{ route('kelas.store') }}";

            $.ajax({
                data: $('#kelasForm').serialize(),
                url: url,
                type: method,
                success: function(data) {
                    $('#kelasForm').trigger("reset");
                    $('#kelasModal').modal('hide');
                    table.draw();
                },
                error: function(xhr) {
                    let response = xhr.responseJSON;
                    if (response && response.errors) {
                        alert(Object.values(response.errors).join("\n"));
                    }
                }
            });
        });


        $('body').on('click', '.deleteKelas', function() {
            let id = $(this).data("id");
            if (confirm("Yakin ingin menghapus kelas ini?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('kelas') }}/" + id,
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
