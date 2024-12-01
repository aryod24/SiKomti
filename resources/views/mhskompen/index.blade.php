@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_mhskompen">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kompen</th>
                        <th>Deskripsi</th>
                        <th>Quota</th>
                        <th>Jam Kompen</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
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
            var dataMhsKompen = $('#table_mhskompen').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('mhskompen/list') }}",
                    "dataType": "json",
                    "type": "GET"
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
                        data: "quota",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jam_kompen",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_mulai",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_akhir",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush