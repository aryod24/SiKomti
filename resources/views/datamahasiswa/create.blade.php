@extends('layouts.template')
<<<<<<< HEAD
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('datamahasiswa') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">NI</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="ni" name="ni" value="{{ old('ni') }}" required>
                        @error('ni')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Nama</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Semester</label>
                    <div class="col-10">
                        <input type="number" class="form-control" id="semester" name="semester" value="{{ old('semester') }}" required>
                        @error('semester')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Jam Alpha</label>
                    <div class="col-10">
                        <input type="number" class="form-control" id="jam_alpha" name="jam_alpha" value="{{ old('jam_alpha') }}" nullable>
                        @error('jam_alpha')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Jam Kompen</label>
                    <div class="col-10">
                        <input type="number" class="form-control" id="jam_kompen" name="jam_kompen" value="{{ old('jam_kompen') }}" nullable>
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
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
=======

@section('content')
<div class="container-fluid" style="height: 100vh; padding: 0;">
    <div class="row justify-content-center" style="height: 100%; margin: 0;">
        <div class="col-12" style="height: 100%; padding: 0;">
            <div class="card card-outline card-primary" style="height: 100%; padding: 0;">
                <div class="card-header">
                    <h3 class="card-title">{{ $page->title }}</h3>
                </div>
                <div class="card-body" style="padding: 0; height: 100%; overflow-y: auto;">
                    <form method="POST" action="{{ url('datamahasiswa') }}" class="form-horizontal" style="height: 100%; padding: 20px;">
                        @csrf
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">NI</label>
                            <div class="col-10">
                                <input type="text" class="form-control" id="ni" name="ni" value="{{ old('ni') }}" required>
                                @error('ni')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Nama</label>
                            <div class="col-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Semester</label>
                            <div class="col-10">
                                <input type="number" class="form-control" id="semester" name="semester" value="{{ old('semester') }}" required>
                                @error('semester')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Jam Alpha</label>
                            <div class="col-10">
                                <input type="number" class="form-control" id="jam_alpha" name="jam_alpha" value="{{ old('jam_alpha') }}" nullable>
                                @error('jam_alpha')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 control-label col-form-label">Jam Kompen</label>
                            <div class="col-10">
                                <input type="number" class="form-control" id="jam_kompen" name="jam_kompen" value="{{ old('jam_kompen') }}" nullable>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
