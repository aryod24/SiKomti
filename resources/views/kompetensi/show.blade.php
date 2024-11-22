@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($kompetensi)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data kompetensi yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Kompetensi</th>
                        <td>{{ $kompetensi->id_kompetensi }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kompetensi</th>
                        <td>{{ $kompetensi->nama_kompetensi }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>
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
                </table>
            @endempty
            <a href="{{ url('kompetensi') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
