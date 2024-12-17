@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
<<<<<<< HEAD
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
                            <th>ID Kompen</th>
                            <td>{{ $kompen->UUID_Kompen }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kompen</th>
                            <td>{{ $kompen->nama_kompen }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $kompen->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Tugas</th>
                            <td>{{ $kompen->jenis_tugas }}</td>
                        </tr>
                        <tr>
                            <th>Quota</th>
                            <td>{{ $kompen->quota }}</td>
                        </tr>
                        <tr>
                            <th>Jam Kompen</th>
                            <td>{{ $kompen->jam_kompen }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai</th>
                            <td>{{ $kompen->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Akhir</th>
                            <td>{{ $kompen->tanggal_akhir }}</td>
                        </tr>
                        <tr>
                            <th>Kompetensi</th>
                            <td>
                                @if($kompen->id_kompetensi == 1)
                                    Pemrograman Dasar
                                @elseif($kompen->id_kompetensi == 2)
                                    Pengembangan Web
                                @elseif($kompen->id_kompetensi == 3)
                                    Pengembangan Aplikasi Mobile
                                @else
                                    {{ $kompen->id_kompetensi ?? 'Tidak Diketahui' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Periode Kompen</th>
                            <td>{{ $kompen->periode_kompen }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($kompen->is_selesai == '1')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($kompen->is_selesai == '0')
                                    <span class="badge bg-warning">Belum Selesai</span>
                                @else
                                    <span class="badge bg-secondary">Status Tidak Diketahui</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Pembuat Kompen</th>
                            <td>{{ $kompen->nama }}</td>
                        </tr>
                        <tr>
                            <th>Level Pembuat Kompen</th>
                            <td>{{ $kompen->level ? $kompen->level->level_nama : 'Tidak Diketahui' }}</td>
                        </tr>
                    </tbody>
                </table>
            @endempty
            <div class="text-end mt-3">
                <a href="{{ url('mhskompen') }}" class="btn btn-sm" style="background-color: #6b83a8; color: white;">
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
=======
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($kompen)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data kompen yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Kompen</th>
                        <td>{{ $kompen->UUID_Kompen }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kompen</th>
                        <td>{{ $kompen->nama_kompen }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $kompen->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Tugas</th>
                        <td>{{ $kompen->jenis_tugas }}</td>
                    </tr>
                    <tr>
                        <th>Quota</th>
                        <td>{{ $kompen->quota }}</td>
                    </tr>
                    <tr>
                        <th>Jam Kompen</th>
                        <td>{{ $kompen->jam_kompen }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ $kompen->tanggal_mulai }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Akhir</th>
                        <td>{{ $kompen->tanggal_akhir }}</td>
                    </tr>
                    <tr>
                        <th>Kompetensi</th>
                        <td>
                            @if($kompen->id_kompetensi == 1)
                                Pemrograman Dasar
                            @elseif($kompen->id_kompetensi == 2)
                                Pengembangan Web
                            @elseif($kompen->id_kompetensi == 3)
                                Pengembangan Aplikasi Mobile
                            @else
                                {{ $kompen->id_kompetensi ?? 'Tidak Diketahui' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Periode Kompen</th>
                        <td>{{ $kompen->periode_kompen }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($kompen->is_selesai == '1')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($kompen->is_selesai == '0')
                                <span class="badge bg-warning">Belum Selesai</span>
                            @else
                                <span class="badge bg-secondary">Status Tidak Diketahui</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Pembuat Kompen</th>
                        <td>{{ $kompen->nama}}</td>
                    </tr>
                    <tr>
                        <th>Level Pembuat Kompen</th>
                        <td>{{ $kompen->level ? $kompen->level->level_nama : 'Tidak Diketahui' }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('mhskompen') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
@endpush
