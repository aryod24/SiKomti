@extends('layouts.template')

@section('content')
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