@extends('layouts.template')
<<<<<<< HEAD

@section('content')
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Progress Kompen</h3>
                </div>
                <!-- Body Card -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- Cek jika level_id bukan 3 atau 4 --}}
                    @if (!in_array(auth()->user()->level_id, [3, 4]))
                        <div class="row mb-3">
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
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .action-buttons {
            display: flex;
            justify-content: center; /* Memastikan tombol berada di tengah */
            gap: 5px;
        }
        .table {
=======
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
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            border-radius: 0.5rem;
            border-collapse: separate;
            overflow: hidden;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
        }
        .table thead {
<<<<<<< HEAD
            background-color: #6b83a8;
            color: #ffffff;
=======
            background-color: #8fa0c0a4;
            color: rgb(0, 0, 0);
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
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
    </style>
<<<<<<< HEAD
@endpush

=======
</style>
@endpush
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
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
<<<<<<< HEAD
                            <td>${bukti.status_acc == 1 ? 'Approved' : 'Rejected'}</td>
=======
                            <td>${bukti.status_acc == 1 ? 'Approved' : bukti.status_acc == 0 ? 'Rejected' : 'Menunggu'}</td>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
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