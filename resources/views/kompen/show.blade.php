@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
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
                        <td> @if($kompen->id_kompetensi == 1)
                            Pemrograman Dasar
                        @else
                            {{ $kompen->id_kompetensi?? 'Tidak Diketahui' }}
                        @endif</td>
                    </tr>
                    <tr>
                        <th>Periode Kompen</th>
                        <td>{{ $kompen->periode_kompen }}</td>
                    </tr>
                </table>
            @endempty
        <a href="{{ url('kompen') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
