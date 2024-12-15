@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('datamahasiswa/create') }}')" class="btn btn-sm btn-success mt-1">Tambah Data Mahasiswa Alpha</button>
                <button class="btn btn-sm btn-primary mt-1" id="import-btn">Import Data Mahasiswa Alpha</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form id="import-form" action="{{ url('datamahasiswa/import_ajax') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                <div class="form-group">
                    <label for="file_mahasiswa">Upload File (Excel):</label>
                    <input type="file" name="file_mahasiswa" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
            <table class="table table-bordered table-striped table-hover table-sm" id="m_mahasiswa_alpha">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NI</th>
                        <th>Nama</th>
                        <th>Semester</th>
                        <th>Jam Alpha</th>
                        <th>Jam Kompen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        /* Tambahkan CSS sesuai kebutuhan */
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Konfigurasi DataTable
            $('#m_mahasiswa_alpha').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('datamahasiswa/list') }}",
                    type: "POST",
                },
                columns: [
                    {data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false},
                    {data: "ni", orderable: true, searchable: true},
                    {data: "nama", orderable: true, searchable: true},
                    {data: "semester", orderable: true, searchable: true},
                    {data: "jam_alpha", orderable: true, searchable: true},
                    {data: "jam_kompen", orderable: true, searchable: true},
                    {data: "aksi", className: "text-center", orderable: false, searchable: false}
                ]
            });

            // Tampilkan form import saat tombol diklik
            $('#import-btn').click(function() {
                $('#import-form').toggle();
            });
        });
    </script>
@endpush
