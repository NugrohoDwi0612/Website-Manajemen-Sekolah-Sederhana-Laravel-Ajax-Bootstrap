@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Data Orang Tua</h2>
    <button class="btn btn-primary mb-3" id="createNeworangtua">Tambah Orang Tua</button>
    <table class="table table-bordered" id="orangtuaTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Orang Tua</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="orangtuaModal" tabindex="-1" aria-labelledby="orangtuaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="orangtuaForm" name="orangtuaForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orangtuaModalLabel">Tambah Orang Tua</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="orangtua_id" id="orangtua_id">
                    <div class="mb-3">
                        <label for="nama_orangtua" class="form-label">Nama Orang Tua</label>
                        <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
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
<script>
    $(function() {
        let table = $('#orangtuaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('orangtua.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_orangtua',
                    name: 'nama_orangtua'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createNeworangtua').click(function() {
            $('#orangtua_id').val('');
            $('#orangtuaForm').trigger("reset");
            $('#orangtuaModalLabel').html("Tambah Orang Tua");
            $('#orangtuaModal').modal('show');
        });

        $('body').on('click', '.editorangtua', function() {
            let id = $(this).data('id');
            $.get("{{ url('orangtua/edit') }}/" + id, function(data) {
                $('#orangtuaModalLabel').html("Edit orangtua");
                $('#orangtuaModal').modal('show');
                $('#orangtua_id').val(data.id);
                $('#nama_orangtua').val(data.nama_orangtua);
                $('#no_hp').val(data.no_hp);
            });
        });

        $('#orangtuaForm').submit(function(e) {
            e.preventDefault();
            let id = $('#orangtua_id').val();
            let method = id ? 'PUT' : 'POST';
            let url = id ? "/orangtua/update/" + id : "{{ route('orangtua.store') }}";

            $.ajax({
                data: $('#orangtuaForm').serialize(),
                url: url,
                type: method,
                success: function(data) {
                    $('#orangtuaForm').trigger("reset");
                    $('#orangtuaModal').modal('hide');
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


        $('body').on('click', '.deleteorangtua', function() {
            let id = $(this).data("id");
            if (confirm("Yakin ingin menghapus Orang Tua ini?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('orangtua') }}/" + id,
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