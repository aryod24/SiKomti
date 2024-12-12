@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $breadcrumb->title }}</h3>
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
                <label for="filterLevel">Filter Level</label>
                <select id="filterLevel" class="form-control">
                    <option value="">- Semua -</option>
                    <option value="1">Admin</option>
                    <option value="3">Dosen</option>
                    <option value="4">Tendik</option>
                </select>
            </div>
        </div>
        @endif
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
            { data: 'jenis_tugas', name: 'jenis_tugas' },
            { data: 'quota', name: 'quota' },
            { data: 'periode_kompen', name: 'periode_kompen' },
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
@endpush