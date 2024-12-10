@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Mahasiswa Alpha</h3>
        </div>
        <div class="card-body">
            @empty($mahasiswaAlpha)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data mahasiswa alpha yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('datamahasiswa') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/datamahasiswa/'.$mahasiswaAlpha->id_alpha) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">NI</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="ni" value="{{ old('ni', $mahasiswaAlpha->ni) }}" required>
                            @error('ni')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Nama</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="nama" value="{{ old('nama', $mahasiswaAlpha->nama) }}" required>
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Semester</label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="semester" value="{{ old('semester', $mahasiswaAlpha->semester) }}" required>
                            @error('semester')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Jam Alpha</label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="jam_alpha" value="{{ old('jam_alpha', $mahasiswaAlpha->jam_alpha) }}" required>
                            @error('jam_alpha')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Jam Kompen</label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="jam_kompen" value="{{ old('jam_kompen', $mahasiswaAlpha->jam_kompen) }}" nullable>
                            @error('jam_kompen')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label"></label>
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('datamahasiswa') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection