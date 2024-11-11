@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Kompen</h3>
        </div>
        <div class="card-body">
            @empty($kompen)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data kompen yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('kompen') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/kompen/'.$kompen->UUID_Kompen) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama Kompen</label>
                        <div class="col-11">
                            <input type="text" class="form-control" name="nama_kompen" value="{{ old('nama_kompen', $kompen->nama_kompen) }}" required>
                            @error('nama_kompen')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Deskripsi</label>
                        <div class="col-11">
                            <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $kompen->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Jenis Tugas</label>
                        <div class="col-11">
                            <input type="number" class="form-control" name="jenis_tugas" value="{{ old('jenis_tugas', $kompen->jenis_tugas) }}">
                            @error('jenis_tugas')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Quota</label>
                        <div class="col-11">
                            <input type="number" class="form-control" name="quota" value="{{ old('quota', $kompen->quota) }}">
                            @error('quota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Jam Kompen</label>
                        <div class="col-11">
                            <input type="number" class="form-control" name="jam_kompen" value="{{ old('jam_kompen', $kompen->jam_kompen) }}">
                            @error('jam_kompen')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Status Dibuka</label>
                        <div class="col-11">
                            <select class="form-control" name="status_dibuka">
                                <option value="1" {{ old('status_dibuka', $kompen->status_dibuka) == 1 ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ old('status_dibuka', $kompen->status_dibuka) == 0 ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @error('status_dibuka')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Mulai</label>
                        <div class="col-11">
                            <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kompen->tanggal_mulai) }}">
                            @error('tanggal_mulai')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Akhir</label>
                        <div class="col-11">
                            <input type="date" class="form-control" name="tanggal_akhir" value="{{ old('tanggal_akhir', $kompen->tanggal_akhir) }}">
                            @error('tanggal_akhir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Periode Kompen</label>
                        <div class="col-11">
                            <input type="text" class="form-control" name="periode_kompen" value="{{ old('periode_kompen', $kompen->periode_kompen) }}">
                            @error('periode_kompen')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('kompen') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection