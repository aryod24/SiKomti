@extends('layouts.template')

@section('content')
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Daftar Jenis Tugas</h3>
                </div>
                <!-- Body Card -->
                <div class="card-body" style="text-align: right;">
                    <button onclick="modalAction('{{ url('jenistugas/create') }}')" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Jenis Tugas
                    </button>
                </div>
                <!-- Tabel -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <!-- Tabel -->
                    <table class="table table-bordered table-striped table-hover table-sm" id="m_jenis_tugas">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Jenis Tugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
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
            var jenisTugas = $('#m_jenis_tugas').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('jenistugas/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "jenis_tugas",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>
@endpush
