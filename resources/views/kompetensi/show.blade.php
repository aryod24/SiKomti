@extends('layouts.template')
@section('content')
    <div class="card card-outline" style="border-color: #6b83a8;">
        <div class="card-header" style="background-color: #6b83a8; color: white;">
            <h3 class="card-title"><i class="fas fa-cogs"></i> {{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @empty($kompetensi)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data kompetensi yang Anda cari tidak ditemukan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <table class="table table-bordered table-hover table-sm">
                    <thead style="background-color: #6b83a8; color: white;">
                        <tr>
                            <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Detail Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-start">ID Kompetensi</th>
                            <td class="text-start">{{ $kompetensi->id_kompetensi }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Nama Kompetensi</th>
                            <td class="text-start">{{ $kompetensi->nama_kompetensi }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Deskripsi</th>
                            <td class="text-start">
                                @if($kompetensi->id_tugas == 1)
                                    Penelitian
                                @elseif($kompetensi->id_tugas == 2)
                                    Pengabdian
                                @elseif($kompetensi->id_tugas == 3)
                                    Teknis
                                @else
                                    Tidak Diketahui
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endempty
            <div class="text-end mt-3">
                <a href="{{ url('kompetensi') }}" class="btn btn-sm" style="background-color: #6b83a8; color: white;">
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
