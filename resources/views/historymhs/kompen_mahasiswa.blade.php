@extends('layouts.template')

@section('content')
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">History Kompen</h3>
                </div>
                <!-- Body Card -->
                <div class="card-body" style="text-align: right;">
                    <!-- Action buttons (Optional, if needed) -->
                    <!-- <a class="btn btn-primary" href="{{ url('kompen/create') }}">
                        <i class="fas fa-plus"></i> Tambah Kompen
                    </a> -->
                </div>
                <!-- Tabel -->
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover" id="t_kompen_mahasiswa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kompen</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Dosen Pembuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
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
        }

        .table tbody tr {
            transition: background-color 0.3s;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #ffffff; /* Baris ganjil berwarna putih */
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Baris genap berwarna abu-abu muda */
        }

        .table tbody tr:hover {
            background-color: #f1f1f1; /* Latar belakang saat baris di-hover */
        }

        .table th {
            background-color: #6b83a8 !important;
            color: #ffffff !important;
        }
    </style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    $('#t_kompen_mahasiswa').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('historymhs.kompen') }}",
            type: 'GET'
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kompen.nama_kompen', name: 'kompen.nama_kompen' },
            { data: 'kompen.deskripsi', name: 'kompen.deskripsi' },
            { data: 'status_acc', name: 'status_acc', render: data => data == 1 ? 'Selesai' : 'Belum Selesai' },
            { data: 'kompen.user.nama', name: 'kompen.user.nama', defaultContent: '-' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush