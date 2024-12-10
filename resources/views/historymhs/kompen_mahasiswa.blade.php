@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $breadcrumb->title }}</h3>
    </div>
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
@endsection
@push('css')
    <style>
        /* Styling untuk tabel */
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
            { data: 'kompen.Is_Selesai', name: 'is_selesai', render: data => data == 1 ? 'Selesai' : 'Belum Selesai' },
            { data: 'kompen.nama', name: 'kompen.nama', defaultContent: '-' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush