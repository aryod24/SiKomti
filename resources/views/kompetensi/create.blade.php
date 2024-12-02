@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Kompetensi</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/kompetensi') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama Bidang Kompetensi</label>
                    <div class="col-11">
                        <input type="text" class="form-control" name="nama_kompetensi" value="{{ old('nama_kompetensi') }}" required>
                        @error('nama_kompetensi')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ url('kompetensi') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
