@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($user)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $user->user_id }}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>{{ $user->level->level_nama }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>{{ $user->jurusan }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Induk</th>
                        <td>{{ $user->ni }}</td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>****</td>
                    </tr>
                    @if ($user->level_id == 2)
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $user->kelas }}</td>
                        </tr>
                        <tr>
                            <th>Semester</th>
                            <td>{{ $user->semester }}</td>
                        </tr>
                    @endif
                </table>
            @endempty
        <a href="{{ url('user') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
