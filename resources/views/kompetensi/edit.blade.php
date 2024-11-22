@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Kompetensi</h3>
        </div>
        <div class="card-body">
            @empty($kompetensi)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data kompetensi yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('kompetensi') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/kompetensi/'.$kompetensi->id_kompetensi) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama Bidang Kompetensi</label>
                        <div class="col-11">
                            <input type="text" class="form-control" name="nama_kompetensi" value="{{ old('nama_kompetensi', $kompetensi->nama_kompetensi) }}" required>
                            @error('nama_kompetensi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('kompetensi') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
