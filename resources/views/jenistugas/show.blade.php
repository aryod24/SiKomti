@extends('layouts.template')
@section('content')
<<<<<<< HEAD
    <div class="card card-outline" style="border-color: #6b83a8;">
        <div class="card-header" style="background-color: #6b83a8; color: white;">
            <h3 class="card-title"><i class="fas fa-tasks"></i> {{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @empty($jenisTugas)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data jenis tugas yang Anda cari tidak ditemukan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <table class="table table-bordered table-hover table-sm">
                    <thead style="background-color: #6b83a8; color: white;">
                        <tr>
                            <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Detail Jenis Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-start">ID Jenis Tugas</th>
                            <td class="text-start">{{ $jenisTugas->id_tugas }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Nama Jenis Tugas</th>
                            <td class="text-start">{{ $jenisTugas->jenis_tugas }}</td>
                        </tr>
                    </tbody>
                </table>
            @endempty
            <div class="text-end mt-3">
                <a href="{{ url('jenistugas') }}" class="btn btn-sm" style="background-color: #6b83a8; color: white;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
=======
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($jenisTugas)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data jenis tugas yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Jenis Tugas</th>
                        <td>{{ $jenisTugas->id_tugas }}</td>
                    </tr>
                    <tr>
                        <th>Nama Jenis Tugas</th>
                        <td>{{ $jenisTugas->jenis_tugas }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('jenistugas') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        </div>
    </div>
@endsection

@push('css')
<<<<<<< HEAD
<style>
    .table th {
        width: 30%;
    }
    .card-header {
        background-color: #6b83a8 !important;
        color: white;
    }
    .card-outline {
        border: 1px solid #6b83a8 !important;
    }
</style>
@endpush
@push('js')
<script>
    // Tambahkan skrip JavaScript tambahan jika diperlukan
</script>
=======
@endpush
@push('js')
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
@endpush
