@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>
        </div>
    </div>
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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="level_id" name="level_id" required>
                            <option value="">- Semua -</option>
                            @foreach ($level as $item)
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Level Pengguna</small>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('css')
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

    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            var dataUser = $('#table_user').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.level_id = $('#level_id').val();
                    }
                },
                columns: [{
                    // nomor urut dari laravel datatable addIndexColumn()
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "username",
                    className: "",
                    // orderable: true, jika ingin kolom ini bisa diurutkan
                    orderable: true,
                    // searchable: true, jika ingin kolom ini bisa dicari
                    searchable: true
                }, {
                    data: "nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    // mengambil data level hasil dari ORM berelasi
                    data: "level.level_nama",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#level_id').on('change', function() {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush