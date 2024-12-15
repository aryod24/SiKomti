@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('level') }}" class="form-horizontal">
                @csrf
                <!-- Kode Level -->
                <div class="form-group row">
                    <label for="level_kode" class="col-1 control-label col-form-label">Kode Level</label>
                    <div class="col-11">
                        <input 
                            type="text" 
                            class="form-control @error('level_kode') is-invalid @enderror" 
                            id="level_kode" 
                            name="level_kode" 
                            value="{{ old('level_kode') }}" 
                            required 
                            autocomplete="off" 
                            placeholder="Masukkan kode level (minimal 3 karakter)">
                        @error('level_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Nama Level -->
                <div class="form-group row">
                    <label for="level_nama" class="col-1 control-label col-form-label">Nama Level</label>
                    <div class="col-11">
                        <input 
                            type="text" 
                            class="form-control @error('level_nama') is-invalid @enderror" 
                            id="level_nama" 
                            name="level_nama" 
                            value="{{ old('level_nama') }}" 
                            required 
                            autocomplete="off" 
                            placeholder="Masukkan nama level (maksimal 100 karakter)">
                        @error('level_nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
<!-- Jika ada tambahan CSS khusus -->
@endpush

@push('js')
<!-- Jika ada tambahan JS khusus -->
@endpush
