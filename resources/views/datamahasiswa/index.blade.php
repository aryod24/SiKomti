@extends('layouts.template')

@section('content')
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Data Mahasiswa</h3>
                </div>
                <!-- Body Card -->
                <div class="card-body" style="text-align: right;">
                    <button onclick="modalAction('{{ url('datamahasiswa/create') }}')" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data Mahasiswa Alpha
                    </button>
                    <button class="btn btn-primary mt-1" id="import-btn">
                        <i class="fas fa-upload"></i> Import Data Mahasiswa Alpha
                    </button>
                    <a href="{{ route('datamahasiswa.export.excel') }}" class="btn btn-success mt-1">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <a href="{{ route('datamahasiswa.export.pdf') }}" class="btn btn-danger mt-1">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                </div>
                <!-- Form Import -->
                <div class="card-body" id="import-form" style="display: none;">
                    <form action="{{ url('datamahasiswa/import_ajax') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file_mahasiswa">Upload File (Excel):</label>
                            <input type="file" name="file_mahasiswa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Import</button>
                            <a href="{{ url('/template/alpha.xlsx') }}" class="btn btn-info" id="template-btn" style="display: none;">Download Template Excel</a>
                        </div>
                    </form>
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
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>

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
    background-color: #6b83a8;
    color: #ffffff;
}

.table th, .table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #dee2e6;
    background-color: #ffffff; /* Pastikan setiap sel berwarna putih */
}

.table tbody tr {
    background-color: #ffffff; /* Pastikan baris tabel memiliki latar belakang putih */
}

.table tbody tr:nth-child(even) {
    background-color: #ffffff; /* Pastikan baris genap tetap putih */
}

.table tbody tr:hover {
    background-color: #f1f1f1; /* Highlight saat hover */
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
            var mahasiswaAlpha = $('#m_mahasiswa_alpha').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('datamahasiswa/list') }}",
                    "dataType": "json",
                    "type": "POST",
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
                $('#template-btn').toggle();
            });

            // Tampilkan template saat tombol diklik
            $('#template-btn').click(function() {
                window.location.href = "{{ url('public/template/alpha.xlsx') }}";
            });
        });
    </script>
@endpush
