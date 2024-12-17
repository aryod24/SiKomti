@extends('layouts.template')

@section('content')
<<<<<<< HEAD
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">{{ $breadcrumb->title }}</h3>
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
                        <div class="col-md-3">
                            <div class="form-inline">
                                <label for="filterLevel" class="mr-2">Filter Level</label>
                                <select id="filterLevel" class="form-control">
                                    <option value="">- Semua -</option>
                                    <option value="1">Admin</option>
                                    <option value="3">Dosen</option>
                                    <option value="4">Tendik</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Tabel -->
                    <table class="table table-bordered table-striped table-hover table-sm" id="t_history_kompen">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kompen</th>
                                <th>Deskripsi</th>
                                <th>Jenis Tugas</th>
                                <th>Quota</th>
                                <th>Periode</th>
                                <th>Status</th>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Warna header tabel tetap biru dengan teks putih */
        .table thead {
            background-color: #6b83a8; /* Warna header tabel */
            color: #ffffff; /* Warna teks header */
        }

        /* Semua baris tabel (ganjil dan genap) berwarna putih */
        .table tbody tr {
            background-color: #ffffff !important; /* Latar belakang putih untuk semua baris */
        }

        /* Hover efek untuk baris */
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Latar belakang saat baris di-hover */
        }

        /* Border antar sel tabel */
        .table td, .table th {
            border: 1px solid #dddddd; /* Warna garis pembatas */
        }

        /* Judul Card di tengah */
        .card-header h3.card-title {
            font-size: 32px;
            font-weight: bold;
            text-align: center; /* Judul berada di tengah */
            text-transform: none; /* Teks tidak sepenuhnya kapital */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Tombol aksi di tengah kolom */
        .table td:last-child {
            text-align: center; /* Menempatkan tombol di tengah */
        }
    </style>
=======
<div class="card card-outline card-primary">
    <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
        <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">History Kompen</h3>
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
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-inline">
                    <label for="filterLevel" class="mr-2">Filter Level</label>
                    <select id="filterLevel" class="form-control">
                        <option value="">- Semua -</option>
                        <option value="1">Admin</option>
                        <option value="3">Dosen</option>
                        <option value="4">Tendik</option>
                    </select>
                </div>
            </div>
        </div>
        @endif

        <!-- Tabel -->
        <table class="table table-bordered table-striped table-hover table-sm" id="t_history_kompen">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kompen</th>
                    <th>Deskripsi</th>
                    <th>Pembuat Tugas</th>
                    <th>Quota</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div> <!-- End of card-body -->
</div> <!-- End of card -->
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

    .dataTables_length {
        float: left;
        margin-bottom: 10px;
    }
</style>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
@endpush

@push('js')
<script>
$(document).ready(function() {
    var table = $('#t_history_kompen').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('history.list') }}",
            type: 'GET',
            data: function (d) {
                d.level_id = $('#filterLevel').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_kompen', name: 'nama_kompen' },
            { data: 'deskripsi', name: 'deskripsi' },
<<<<<<< HEAD
            { data: 'jenis_tugas', name: 'jenis_tugas' },
            { data: 'quota', name: 'quota' },
            { data: 'periode_kompen', name: 'periode_kompen' },
=======
            { data: 'nama', name: 'nama' },
            { data: 'quota', name: 'quota' },
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            { data: 'is_selesai', name: 'is_selesai', render: function(data) {
                return data == 1 ? 'Selesai' : 'Belum Selesai';
            }},
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ]
    });

    // Event listener for the filter
    $('#filterLevel').change(function() {
        table.draw();
    });
});
</script>
<<<<<<< HEAD
@endpush
=======
@endpush
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
