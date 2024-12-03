@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Kompen</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
            {{-- Cek jika level_id bukan 3 atau 4 --}}
            @if (!in_array(auth()->user()->level_id, [3, 4]))
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="level_id" name="level_id">
                                <option value="">- Semua -</option>
                                <option value="1">Admin</option>
                                <option value="3">Dosen</option>
                                <option value="4">Tendik</option>
                            </select>
                        </div>
                        <small class="form-text text-muted">Level Pengguna</small>
                    </div>
                </div>
            </div>
            @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="t_kompen">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kompen</th>
                    <th>Deskripsi</th>
                    <th>Jenis Tugas</th>
                    <th>Pembuat Tugas</th>
                    <th>Quota</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@include('pengajuankompen.showreq')

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="notificationMessage"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    .action-buttons {
        display: flex;
        gap: 5px;
    }
</style>
@endpush

@push('js')
<script>
function showRequestModal(uuidKompen) {
    $('#myModal').modal('show');
    getKompenRequestByUuid(uuidKompen);
}

function getKompenRequestByUuid(uuidKompen) {
    $.ajax({
        url: "{{ route('pengajuankompen.requests', '') }}/" + uuidKompen,
        method: 'GET',
        success: function(response) {
            if (response.data) {
                let rows = '';
                response.data.forEach(function(request) {
                    rows += `
                        <tr>
                            <td>${request.ni}</td>
                            <td>${request.nama}</td>
                            <td>${request.status_Acc === 1 ? 'Diterima' : (request.status_Acc === 0 ? 'Ditolak' : 'Menunggu')}</td>
                            <td class="action-buttons">
                                <button onclick="updateStatus('${request.ni}', '${uuidKompen}', 1)" class="btn btn-success btn-sm">Terima</button>
                                <button onclick="updateStatus('${request.ni}', '${uuidKompen}', 0)" class="btn btn-danger btn-sm">Tolak</button>
                                <button onclick="deleteRequest('${request.ni}', '${uuidKompen}')" class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>`;
                });
                $('#request-body').html(rows);
            } else {
                $('#request-body').html('<tr><td colspan="4" class="text-center">Tidak ada permintaan ditemukan.</td></tr>');
            }
        },
        error: function() {
            $('#request-body').html('<tr><td colspan="4" class="text-center">Gagal memuat data.</td></tr>');
        }
    });
}

function updateStatus(ni, uuidKompen, statusAcc) {
    let requestData = {
        _token: '{{ csrf_token() }}',
        ni: ni,
        UUID_Kompen: uuidKompen,
        status_Acc: statusAcc
    };
    $.ajax({
        url: "{{ route('pengajuankompen.update_status') }}",
        method: 'POST',
        data: requestData,
        success: function(response) {
            showAlert(response.message);
            getKompenRequestByUuid(uuidKompen);
        },
        error: function(response) {
            if(response.responseJSON && response.responseJSON.message) {
                showAlert(response.responseJSON.message);
            } else {
                showAlert('Gagal memperbarui status.');
            }
        }
    });
}

function deleteRequest(ni, uuidKompen) {
    let requestData = {
        _token: '{{ csrf_token() }}',
        ni: ni,
        UUID_Kompen: uuidKompen
    };
    $.ajax({
        url: "{{ route('pengajuankompen.delete_request') }}",
        method: 'POST',
        data: requestData,
        success: function(response) {
            showAlert(response.message);
            getKompenRequestByUuid(uuidKompen);
        },
        error: function(response) {
            showAlert('Gagal menghapus permintaan.');
        }
    });
}

function showAlert(message) {
    $('#notificationMessage').text(message);
    $('#notificationModal').modal('show');
}

$(document).ready(function() {
    var dataKompen = $('#t_kompen').DataTable({
        serverSide: true,
        ajax: {
            "url": "{{ route('pengajuankompen.list') }}",
            "dataType": "json",
            "type": "GET",
            "data": function (d) {
                d.level_id = $('#level_id').val();
            }
        },
        columns: [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "nama_kompen", orderable: true, searchable: true },
            { data: "deskripsi", orderable: true, searchable: true },
            { data: "jenis_tugas", orderable: true, searchable: true, render: function(data) {
                if (data == 1) return 'Penelitian';
                if (data == 2) return 'Pengabdian';
                if (data == 3) return 'Teknis';
                return data;
            }},
            { data: "nama", orderable: true, searchable: true },
            { data: "quota", orderable: true, searchable: true },
            { data: "is_selesai", render: function(data) {
                if (data == 1) return '<span class="badge bg-success">Selesai</span>';
                if (data == 0) return '<span class="badge bg-warning">Belum Selesai</span>';
                return '<span class="badge bg-secondary">Status Tidak Diketahui</span>';
            }},
            { 
                data: null, 
                orderable: false, 
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="action-buttons">
                            <button onclick="showRequestModal('${row.UUID_Kompen}')" class="btn btn-info btn-sm">Request</button> 
                        </div>`;
                }
            }
        ]
    });

    $('#level_id').on('change', function() {
        dataKompen.ajax.reload();
    });
});
</script>
@endpush
