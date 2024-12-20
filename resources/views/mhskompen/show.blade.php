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
                        <td>{{ $kompen->jenisTugas->jenis_tugas ?? 'Tidak Diketahui' }}</td>
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
                        <td>{{ $kompen->kompetensi->nama_kompetensi ?? 'Tidak Diketahui' }}</td>
                    </tr>
                    <tr>
                        <th>Periode Kompen</th>
                        <td>{{ $kompen->periode_kompen }}</td>
                    </tr>
                    <tr>
                        <th>Status Selesai</th>
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
@endpush
