@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Data Guru</h2>
    <button class="btn btn-primary mb-3" id="createNewGuru">Tambah Guru</button>
    <table class="table table-bordered" id="guruTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="guruModal" tabindex="-1" aria-labelledby="guruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="guruForm" name="guruForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guruModalLabel">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="guru_id" id="guru_id">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas_id" class="form-label">Kelas</label>
                        <select class="form-control" id="kelas_id" name="kelas_id" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $kelas_item)
                            <option value="{{ $kelas_item->id }}">{{ $kelas_item->nama_kelas }}</option>
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
        let table = $('#guruTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('guru.index') }}",
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
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#createNewGuru').click(function() {
            $('#guru_id').val('');
            $('#guruForm').trigger("reset");
            $('#guruModalLabel').html("Tambah Guru");
            $('#guruModal').modal('show');
        });

        $('body').on('click', '.editGuru', function() {
            let id = $(this).data('id');
            $.get("{{ url('guru/edit') }}/" + id, function(data) {
                $('#guruModalLabel').html("Edit Guru");
                $('#guruModal').modal('show');
                $('#guru_id').val(data.id);
                $('#nama').val(data.nama);
                $('#nip').val(data.nip);
                $('#kelas_id').val(data.kelas_id);
            });
        });

        $('#guruForm').submit(function(e) {
            e.preventDefault();
            let id = $('#guru_id').val();
            let method = id ? 'PUT' : 'POST';
            let url = id ? "/guru/update/" + id : "{{ route('guru.store') }}";

            $.ajax({
                data: $('#guruForm').serialize(),
                url: url,
                type: method,
                success: function(data) {
                    $('#guruForm').trigger("reset");
                    $('#guruModal').modal('hide');
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

        $('body').on('click', '.deleteGuru', function() {
            let id = $(this).data("id");
            if (confirm("Yakin ingin menghapus guru ini?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('guru') }}/" + id,
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
