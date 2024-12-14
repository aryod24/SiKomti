@extends('layouts.template')

@section('content')
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Daftar Kompetensi</h3>
                </div>
                <!-- Body Card -->
                <div class="card-body" style="text-align: right;">
                    <button onclick="modalAction('{{ url('kompetensi/create') }}')" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Kompetensi
                    </button>
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
                    <table class="table table-bordered table-striped table-hover table-sm" id="m_bidang_kompetensi">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kompetensi</th>
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

        /* Tombol aksi di tengah kolom */
        .table td:last-child {
            text-align: center; /* Menempatkan tombol di tengah */
        }

        .btn-success {
            background-color: #28a745; /* Warna tombol hijau */
            color: white;
        }
        .btn-success:hover {
            background-color: #218838; /* Warna lebih gelap saat hover */
            color: white;
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
            var kompetensi = $('#m_bidang_kompetensi').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('kompetensi/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "nama_kompetensi", orderable: true, searchable: true },
                    { data: "aksi", className: "text-center", orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
