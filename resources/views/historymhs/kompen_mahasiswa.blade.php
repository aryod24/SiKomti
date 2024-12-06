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
