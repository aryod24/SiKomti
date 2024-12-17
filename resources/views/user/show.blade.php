@extends('layouts.template')
@section('content')
<div class="card card-outline" style="border-color: #6b83a8;">
    <div class="card-header" style="background-color: #6b83a8; color: white;">
        <h3 class="card-title"><i class="fas fa-user-circle"></i> {{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @empty($user)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <table class="table table-bordered table-hover table-sm">
                <thead style="background-color: #6b83a8; color: white;">
                    <tr>
                        <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Detail Pengguna</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-start">ID</th>
                        <td class="text-start">{{ $user->user_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Level</th>
                        <td class="text-start">{{ $user->level->level_nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Username</th>
                        <td class="text-start">{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Nama</th>
                        <td class="text-start">{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">Password</th>
                        <td class="text-start"><span class="badge bg-secondary">******</span></td>
                    </tr>
                </tbody>
            </table>
        @endempty
        <div class="text-end mt-3">
            <a href="{{ url('user') }}" class="btn btn-sm" style="background-color: #6b83a8; color: white;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
<<<<<<< HEAD
=======
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
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
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
<<<<<<< HEAD
<script>
    // Tambahkan skrip JavaScript tambahan jika diperlukan
</script>
=======
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
@endpush
