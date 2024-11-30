@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($mahasiswaAlpha)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data mahasiswa alpha yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Alpha</th>
                        <td>{{ $mahasiswaAlpha->id_alpha }}</td>
                    </tr>
                    <tr>
                        <th>NI</th>
                        <td>{{ $mahasiswaAlpha->ni }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $mahasiswaAlpha->nama }}</td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>{{ $mahasiswaAlpha->semester }}</td>
                    </tr>
                    <tr>
                        <th>Jam Alpha</th>
                        <td>{{ $mahasiswaAlpha->jam_alpha }}</td>
                    </tr>
                    <tr>
                        <th>Jam Kompen</th>
                        <td>{{ $mahasiswaAlpha->jam_kompen }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('datamahasiswa') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush