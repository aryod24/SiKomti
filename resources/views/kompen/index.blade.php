@extends('layouts.template')

@section('content')
<<<<<<< HEAD
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">List Kompen</h3>
                </div>
                <!-- Body Card -->
                <div class="card-body" style="text-align: right;">
                    <button onclick="modalAction('{{ url('kompen/create') }}')" class="btn btn-primary mt-1">
                        <i class="fas fa-plus"></i> Tambah Kompen
                    </button>
                </div>
                <!-- Filter -->
                @if (!in_array(auth()->user()->level_id, [3, 4]))
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label ml-3">Filter:</label>
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
                <!-- Tabel -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <table class="table table-bordered table-striped table-hover table-sm" id="table_kompen">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kompen</th>
                                <th>Deskripsi</th>
                                <th>Jenis Kompen</th>
                                <th>Pembuat Tugas</th>
                                <th>Quota</th>
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
=======
<div class="card card-outline card-primary">
    <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
        <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Daftar Kompen</h3>     
    </div>
    <div class="card-body">
        <div class="card-tools mb-3 text-right">  
            <div class="card-tools">
                <button onclick="modalAction('{{ url('kompen/create') }}')" class="btn btn-sm btn-success mt-1">Tambah Kompen</button>
            </div>
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

            <table class="table table-bordered table-striped table-hover table-sm" id="table_kompen">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kompen</th>
                        <th>Deskripsi</th>
                        <th>Jenis Kompen</th>
                        <th>Pembuat Tugas</th>
                        <th>Quota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
<<<<<<< HEAD
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
=======
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
            background-color: #8fa0c0a4; /* Warna latar belakang header */
            color: rgb(0, 0, 0); /* Warna teks header */
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

        /* Warna biru */
        .btn-blue {
            background-color: #007bff; /* Biru */
            color: white;
        }
        .btn-blue:hover {
            background-color: #0056b3; /* Biru lebih gelap saat hover */
            color: white;
        }

        /* Warna biru muda */
        .btn-lightblue {
            background-color: #28b2db; /* Biru muda */
            color: white;
        }
        .btn-lightblue:hover {
            background-color:#28b2db; /* Biru lebih gelap saat hover */
            color: white;
        }

        /* Warna biru gelap */
        .btn-darkblue {
            background-color: #003366; /* Biru gelap */
            color: white;
        }
        .btn-darkblue:hover {
            background-color: #001f33; /* Biru lebih gelap saat hover */
            color: white;
        }

        /* Warna biru gradasi */
        .btn-blue-gradient {
            background: linear-gradient(to right, #007bff, #0056b3); /* Gradasi biru */
            color: white;
        }
        .btn-blue-gradient:hover {
            background: linear-gradient(to right, #0056b3, #003366); /* Gradasi lebih gelap saat hover */
            color: white;
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        }
    </style>
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function() {
            var dataKompen = $('#table_kompen').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('kompen/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.level_id = $('#level_id').val(); // Menambahkan filter level_id
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_kompen",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "deskripsi",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jenis_tugas",
                        className: "",
                        orderable: true,
                        searchable: true,
                        render: function(data) {
                            if (data == 1) {
                                return 'Penelitian';
                            } else if (data == 2) {
                                return 'Pengabdian';
                            } else if (data == 3) {
                                return 'Teknis';
                            }
                            return data;
                        }
                    },
                    {
                        data: "nama", // Field for Pembuat Tugas
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "quota",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "is_selesai",
                        className: "text-center",
                        render: function(data) {
                            if (data == 1) {
                                return '<span class="badge bg-success">Selesai</span>';
                            } else if (data == 0) {
                                return '<span class="badge bg-warning">Belum Selesai</span>';
                            }
                            return '<span class="badge bg-secondary">Status Tidak Diketahui</span>';
                        }
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#level_id').on('change', function() {
                dataKompen.ajax.reload();
            });
        });
    </script>
@endpush
