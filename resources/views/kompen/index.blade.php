@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Kompen</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kompen/import') }}')" class="btn btn-sm btn-info mt-1">Import Kompen</button>
                <a href="{{url('/kompen/export_excel')}}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Kompen (Excel)</a>
                <a href="{{url('/kompen/export_pdf')}}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export Kompen (PDF)</a>
                <button onclick="modalAction('{{ url('kompen/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Kompen</button>
            </div>
        </div>
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
                        <th>Kode Kompen</th> <!-- Tambahkan kolom Kode Kompen -->
                        <th>Nama Kompen</th>
                        <th>Quota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
    <style>
        /* Styling untuk tabel */
        .table {
            border-radius: 0.5rem; /* Sudut tabel membulat */
            overflow: hidden; /* Menghindari border radius di luar tabel */
        }

        .table thead {
            background-color: #007bff; /* Warna latar belakang header */
            color: white; /* Warna teks header */
        }

        .table th, .table td {
            padding: 10px; /* Jarak dalam sel */
            text-align: center; /* Rata tengah */
        }

        .table tbody tr {
            transition: background-color 0.3s; /* Animasi saat hover */
        }

        .table tbody tr:hover {
            background-color: #f0f8ff; /* Warna latar belakang saat hover */
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

        var dataKompen;
        $(document).ready(function() {
            var dataKompen = $('#table_kompen').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('kompen/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.kompen_id = $('#kompen_id').val(); // Jika ada filter untuk kompen
                    }
                },
                columns: [{
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nama_kompen", // Kode Kompen
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "jenis_tugas", // Nama Kompen
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "quota", // Status Kompen
                    className: "text-center",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi", // Tombol Aksi
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#kompen_id').on('change', function() {
                dataKompen.ajax.reload();
            });
        });
    </script>
@endpush
