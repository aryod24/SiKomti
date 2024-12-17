@extends('layouts.template')

@section('content')
<<<<<<< HEAD
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Daftar Level</h3>
                </div>
                <!-- Body Card -->
                <div class="card-body" style="text-align: right;">
                    <a class="btn btn-primary" href="{{ url('level/create') }}">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <!-- Tabel -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Tabel -->
                    <table class="table table-bordered table-striped table-hover table-sm" id="table_level">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Level</th>
                                <th>Nama Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
=======
<div class="card card-outline card-primary">
    <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
        <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Daftar Level</h3>     
    </div>
    <div class="card-body">
        <div class="card-tools mb-3 text-right">  
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('level/create') }}">Tambah</a>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        </div>
    </div>
</div>
@endsection

@push('css')
<<<<<<< HEAD
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
=======
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    <style>
        /* Styling untuk tabel */
        .table {
            border-radius: 0.5rem; /* Sudut tabel membulat */
            border-collapse: separate; /* Memungkinkan border tampil di setiap sel */
            overflow: hidden; /* Menghindari border radius di luar tabel */
            background-color: #ffffff; /* Latar belakang putih penuh */
            border: 1px solid #dee2e6; /* Garis luar tabel */
        }

        /* Styling untuk bagian header tabel */
        .table thead {
<<<<<<< HEAD
            background-color: #6b83a8; /* Warna latar belakang header */
            color: #ffffff; /* Warna teks header */
=======
            background-color: #8fa0c0a4; /* Warna latar belakang header */
            color: rgb(0, 0, 0); /* Warna teks header */
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        }

        /* Styling untuk kolom header dan sel */
        .table th, .table td {
            padding: 10px; /* Jarak dalam sel */
            text-align: left; /* Rata kiri */
            border: 1px solid #dee2e6; /* Garis pada setiap sel */
            background-color: #ffffff; /* Latar belakang sel putih */
        }

        /* Styling untuk baris dalam tbody */
        .table tbody tr {
            background-color: #ffffff; /* Latar belakang putih penuh pada setiap baris */
            transition: background-color 0.3s; /* Animasi saat hover */
        }

        /* Styling untuk baris genap dengan sedikit perbedaan warna */
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Warna latar belakang baris genap */
        }

        /* Styling untuk baris saat dihover */
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Warna saat hover */
        }

        /* Styling untuk header tabel jika ingin penyesuaian warna lebih lanjut */
        .table th {
            background-color: #6b83a8 !important; /* Warna latar belakang header biru */
            color: #ffffff !important; /* Warna teks header putih */
        }

<<<<<<< HEAD
        /* Styling untuk kolom aksi */
        .table td:last-child {
            text-align: center; /* Menyusun tombol di tengah kolom aksi */
        }

        /* Styling tambahan untuk tombol aksi jika menggunakan flexbox */
        .table td:last-child .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }

=======
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataLevel = $('#table_level').DataTable({
                serverSide: true, 
                ajax: {
                    "url": "{{ url('level/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [
                    {
                        data: "DT_RowIndex", 
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "level_kode", 
                        orderable: true, 
                        searchable: true
                    },
                    {
                        data: "level_nama", 
                        orderable: true, 
                        searchable: true
                    },
                    {
                        data: "aksi", 
                        orderable: false, 
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
