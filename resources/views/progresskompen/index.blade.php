@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
        <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Progress Kompen</h3>     
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

    </div> <!-- End of card-body -->
</div> <!-- End of card -->
@push('css')
<style>
    .action-buttons {
        display: flex;
        gap: 5px;
    }
    .table {
        border-radius: 0.5rem;
        border-collapse: separate;
        overflow: hidden;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
    }
    .table thead {
        background-color: #8fa0c0a4;
        color: rgb(0, 0, 0);
    }
    .table th, .table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #dee2e6;
        background-color: #ffffff;
    }
    .table tbody tr {
        background-color: #ffffff;
        transition: background-color 0.3s;
    }
    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }
    .table th {
        background-color: #6b83a8 !important;
        color: #ffffff !important;
    }
    <style>
/* Tambahkan CSS berikut */
.modal-xl {
    max-width: 90%;
    width: 90%;
    margin: 1.75rem auto;
}

.modal-body {
    padding: 1rem;
}

.table-responsive {
    width: 100%;
    margin-bottom: 1rem;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table td {
    white-space: nowrap;
    vertical-align: middle;
}

.d-flex.gap-2 {
    display: flex;
    gap: 0.5rem;
    flex-wrap: nowrap;
    justify-content: flex-start;
}

@media (max-width: 768px) {
    .modal-xl {
        max-width: 95%;
        width: 95%;
        margin: 1rem auto;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .btn-sm {
        width: 100%;
    }
}
</style>

</style>
@endpush
@include('progresskompen.show') <!-- Include modal from show.blade.php -->

@push('js')
<script>
function showProgressModal(uuidKompen) {
    $.ajax({
        url: '{{ route('progresskompen.view_bukti', '') }}/' + uuidKompen,
        type: 'GET',
        success: function(response) {
            if (response.bukti && response.bukti.length > 0) {
                let detailsHtml = `
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Nama</th>
                                        <th width="20%">Nama Progress</th>
                                        <th width="10%">Status ACC</th>
                                        <th width="20%">Bukti Kompen</th>
                                        <th width="30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                
                response.bukti.forEach(function(bukti, index) {
                    detailsHtml += `
                        <tr id="progress-row-${bukti.id_progres}">
                            <td>${index + 1}</td>
                            <td>${bukti.nama || 'Belum ada nama'}</td>
                            <td>${bukti.nama_progres || 'Belum ada progress'}</td>
                            <td class="status-cell">${bukti.status_acc == 1 ? 'Approved' : bukti.status_acc == 0 ? 'Rejected' : 'Menunggu'}</td>
                            <td>${bukti.bukti_kompen || 'Belum ada bukti'}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-success btn-sm approve-btn" onclick="updateStatus(${bukti.id_progres}, 1)" ${bukti.status_acc == 1 ? 'disabled' : ''}>
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button class="btn btn-danger btn-sm reject-btn" onclick="updateStatus(${bukti.id_progres}, 0)" ${bukti.status_acc == 0 ? 'disabled' : ''}>
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                    <a href="{{ asset('storage/bukti_kompen/') }}/${bukti.bukti_kompen}" class="btn btn-primary btn-sm" download ${!bukti.bukti_kompen ? 'disabled' : ''}>
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </div>
                            </td>
                        </tr>`;
                });
                
                detailsHtml += `</tbody></table></div></div>`;
                $('#progressDetails').html(detailsHtml);
                $('#progressModal').modal('show');
            } else {
                $('#progressDetails').html('<div class="modal-body"><p>Belum ada Progress</p></div>');
                $('#progressModal').modal('show');
            }
        },
        error: function(xhr) {
            $('#progressDetails').html('<div class="modal-body"><p>Belum ada Progress</p></div>');
            $('#progressModal').modal('show');
        }
    });
}


function updateStatus(id_progres, status_acc) {
    $.ajax({
        url: '{{ route('progresskompen.update_bukti') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id_progres: id_progres,
            status_acc: status_acc
        },
        success: function(response) {
            // Update status cell
            const row = $(`#progress-row-${id_progres}`);
            row.find('.status-cell').text(status_acc == 1 ? 'Approved' : 'Rejected');
            
            // Update button states
            row.find('.approve-btn').prop('disabled', status_acc == 1);
            row.find('.reject-btn').prop('disabled', status_acc == 0);
            
            // Show notification
            $('#notificationArea').html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${response.message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `);
            
            // Auto hide notification after 3 seconds
            setTimeout(() => {
                $('#notificationArea .alert').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 3000);
        },
        error: function(xhr) {
            $('#notificationArea').html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan saat memperbarui status
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `);
        }
    });
}



$(document).ready(function() {
    var dataKompen = $('#t_kompen').DataTable({
        serverSide: true,
        ajax: {
            "url": "{{ route('progresskompen.list') }}",
            "dataType": "json",
            "type": "GET",
            "data": function(d) {
                d.level_id = $('#level_id').val(); 
            }
        },
        columns: [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "nama_kompen", orderable: true, searchable: true },
            { data: "deskripsi", orderable: true, searchable: true },
            { data: "jenis_tugas", orderable: true, searchable: true, render: function(data) {
                if (data == 1) {
                    return 'Penelitian';
                } else if (data == 2) {
                    return 'Pengabdian';
                } else if (data == 3) {
                    return 'Teknis';
                } else {
                    return 'Tidak Diketahui';
                }
            }},
            { data: "nama", orderable: true, searchable: true },
            { data: "quota", orderable: true, searchable: true },
            { data: "is_selesai", render: function(data) {
                return data == 1 ? '<span class="badge bg-success">Selesai</span>' : '<span class="badge bg-warning">Belum Selesai</span>';
            }},
            { data: null, orderable: false, searchable: false, render: function(data) {
                return `<button onclick='showProgressModal("${data.UUID_Kompen}")' class='btn btn-primary btn-sm'>Progress</button>`;
            }}
        ]
    });

    $('#level_id').on('change', function() {
        dataKompen.ajax.reload();
    });
});
</script>
@endpush
@endsection
