@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Jenis Tugas</h3>
        </div>
        <div class="card-body">
            @empty($jenisTugas)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data jenis tugas yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('jenistugas') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/jenistugas/'.$jenisTugas->id_tugas) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama Jenis Tugas</label>
                        <div class="col-11">
                            <input type="text" class="form-control" name="nama_jenis_tugas" value="{{ old('nama_jenis_tugas', $jenisTugas->jenis_tugas) }}" required>
                            @error('jenis_tugas')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('jenistugas') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
