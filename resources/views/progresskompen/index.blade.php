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

    </div> <!-- End of card-body -->
</div> <!-- End of card -->

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
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Progress</th>
                                    <th>Status ACC</th>
                                    <th>Bukti Kompen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>`;
                
                response.bukti.forEach(function(bukti, index) {
                    detailsHtml += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${bukti.nama}</td>
                            <td>${bukti.nama_progres}</td>
                            <td>${bukti.status_acc == 1 ? 'Approved' : 'Rejected'}</td>
                            <td>${bukti.bukti_kompen}</td>
                            <td>
                                <button class='btn btn-success btn-sm' onclick='updateStatus(${bukti.id_progres}, 1)'>Approve</button> 
                                <button class='btn btn-danger btn-sm' onclick='updateStatus(${bukti.id_progres}, 0)'>Reject</button> 
                                <a href="{{ asset('storage/bukti_kompen/') }}/${bukti.bukti_kompen}" 
                                   class='btn btn-primary btn-sm' 
                                   download>Download</a> 
                            </td></tr>`;
                });

                detailsHtml += `</tbody></table></div>`;
                
                $('#progressDetails').html(detailsHtml);
                $('#progressModal').modal('show');
            } else {
                $('#progressDetails').html('<p>No progress details found.</p>');
                $('#progressModal').modal('show');
            }
        },
        error: function(xhr) {
            $('#progressDetails').html('<p>Belum ada Progress</p>');
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
            $('#notificationArea').html(`<div class="alert alert-success">${response.message}</div>`);
            setTimeout(function() {
                $('#progressModal').modal('hide');
                $('#notificationArea').html('');  // Clear the notification area
            }, 2000);  // Hide the modal after 2 seconds
        },
        error: function(xhr) {
            $('#notificationArea').html('<div class="alert alert-danger">An error occurred while updating the status.</div>');
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
                    d.level_id = $('#level_id').val(); // Menambahkan filter level_id
                }
            },
            columns: [
                { data: "DT_RowIndex", orderable: false, searchable: false },
                { data: "nama_kompen", orderable: true, searchable: true },
                { data: "deskripsi", orderable: true, searchable: true },
                { data: "jenis_tugas", orderable: true, searchable: true },
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