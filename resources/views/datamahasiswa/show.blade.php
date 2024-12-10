@extends('layouts.template')
@section('content')
<div class="card card-outline" style="border-color: #6b83a8;">
    <div class="card-header" style="background-color: #6b83a8; color: white;">
        <h3 class="card-title"><i class="fas fa-user-graduate"></i> {{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @empty($mahasiswaAlpha)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data mahasiswa alpha yang Anda cari tidak ditemukan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <table class="table table-bordered table-hover table-sm">
                <thead style="background-color: #6b83a8; color: white;">
                    <tr>
                        <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Detail Mahasiswa Alpha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-start">ID Alpha</th>
                        <td class="text-start">{{ $mahasiswaAlpha->id_alpha }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">NI</th>
                        <td class="text-start">{{ $mahasiswaAlpha->ni }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Nama</th>
                        <td class="text-start">{{ $mahasiswaAlpha->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Semester</th>
                        <td class="text-start">{{ $mahasiswaAlpha->semester }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Jam Alpha</th>
                        <td class="text-start">{{ $mahasiswaAlpha->jam_alpha }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Jam Kompen</th>
                        <td class="text-start">{{ $mahasiswaAlpha->jam_kompen }}</td>
                    </tr>
                </tbody>
            </table>
        @endempty
        <div class="text-end mt-3">
            <a href="{{ url('datamahasiswa') }}" class="btn btn-sm" style="background-color: #6b83a8; color: white;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection

@push('css')
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
@endpush
