@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header" style="background-color: #6b83a8; color: white;">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @empty($kompen)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data kompen yang Anda cari tidak ditemukan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <table class="table table-bordered table-hover table-sm">
                    <thead style="background-color: #6b83a8; color: white;">
                        <tr>
                            <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Detail Kompen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-start">ID Kompen</th>
                            <td class="text-start">{{ $kompen->UUID_Kompen }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Nama Kompen</th>
                            <td class="text-start">{{ $kompen->nama_kompen }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Deskripsi</th>
                            <td class="text-start">{{ $kompen->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Jenis Tugas</th>
<<<<<<< HEAD
                            <td class="text-start">{{ $kompen->jenis_tugas }}</td>
=======
                            <td class="text-start">{{ $kompen->jenisTugas->jenis_tugas ?? 'Tidak Diketahui' }}</td>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
                        </tr>
                        <tr>
                            <th class="text-start">Quota</th>
                            <td class="text-start">{{ $kompen->quota }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Jam Kompen</th>
                            <td class="text-start">{{ $kompen->jam_kompen }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Tanggal Mulai</th>
                            <td class="text-start">{{ $kompen->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Tanggal Akhir</th>
                            <td class="text-start">{{ $kompen->tanggal_akhir }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Kompetensi</th>
<<<<<<< HEAD
                            <td class="text-start">
                                @if($kompen->id_kompetensi == 1)
                                    Pemrograman Dasar
                                @else
                                    {{ $kompen->id_kompetensi ?? 'Tidak Diketahui' }}
                                @endif
                            </td>
=======
                            <td class="text-start">{{ $kompen->kompetensi->nama_kompetensi ?? 'Tidak Diketahui' }}</td>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
                        </tr>
                        <tr>
                            <th class="text-start">Periode Kompen</th>
                            <td class="text-start">{{ $kompen->periode_kompen }}</td>
                        </tr>
                    </tbody>
                </table>
            @endempty
            <div class="text-end mt-3">
                <a href="{{ url('kompen') }}" class="btn btn-sm" style="background-color: #6b83a8; color: white;">
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
