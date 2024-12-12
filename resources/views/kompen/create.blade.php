@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('kompen') }}" class="form-horizontal">
                @csrf
                <!-- Nama Kompen -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama Kompen</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="nama_kompen" name="nama_kompen" value="{{ old('nama_kompen') }}" required>
                        @error('nama_kompen')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Deskripsi -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Deskripsi</label>
                    <div class="col-11">
                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Jenis Tugas -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Jenis Tugas</label>
                    <div class="col-11">
                        <select class="form-control" id="jenis_tugas" name="jenis_tugas" required>
                            <option value="">- Pilih Jenis Tugas -</option>
                            @foreach ($jenisTugas as $jenis)
                                <option value="{{ $jenis->id_tugas }}" {{ old('jenis_tugas') == $jenis->id_tugas ? 'selected' : '' }}>{{ $jenis->jenis_tugas }}</option>
                            @endforeach
                        </select>
                        @error('jenis_tugas')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Bidang Kompetensi -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Bidang Kompetensi</label>
                    <div class="col-11">
                        <select class="form-control" id="id_kompetensi" name="id_kompetensi" required>
                            <option value="">- Pilih Kompetensi -</option>
                            @foreach ($kompetensi as $kompeten)
                                <option value="{{ $kompeten->id_kompetensi }}" {{ old('id_kompetensi') == $kompeten->id_kompetensi ? 'selected' : '' }}>{{ $kompeten->nama_kompetensi }}</option>
                            @endforeach
                        </select>
                        @error('id_kompetensi')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Quota -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Quota</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="quota" name="quota" value="{{ old('quota') }}">
                        @error('quota')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Jam Kompen -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Jam Kompen</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="jam_kompen" name="jam_kompen" value="{{ old('jam_kompen') }}">
                        @error('jam_kompen')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Status Dibuka -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Status Dibuka</label>
                    <div class="col-11">
                        <select class="form-control" id="status_dibuka" name="status_dibuka">
                            <option value="">- Pilih Status -</option>
                            <option value="1" {{ old('status_dibuka') == '1' ? 'selected' : '' }}>Dibuka</option>
                            <option value="0" {{ old('status_dibuka') == '0' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                        @error('status_dibuka')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Tanggal Mulai -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Tanggal Mulai</label>
                    <div class="col-11">
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Tanggal Akhir -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Tanggal Akhir</label>
                    <div class="col-11">
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                        @error('tanggal_akhir')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Periode Kompen -->
                @if (auth()->check() && auth()->user()->level_id == 1)
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Periode Kompen</label>
                    <div class="col-11">
                        <select class="form-control" id="periode_kompen" name="periode_kompen">
                            <option value="">- Pilih Periode -</option>
                            @for ($year = 2021; $year <= 2024; $year++)
                                <option value="{{ $year }}" {{ old('periode_kompen') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                        @error('periode_kompen')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                @endif
                
                <!-- Status Selesai -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Status Selesai</label>
                    <div class="col-11">
                        <select class="form-control" id="is_selesai" name="is_selesai">
                            <option value="">- Pilih Status -</option>
                            <option value="1" {{ old('is_selesai') == '1' ? 'selected' : '' }}>Selesai</option>
                            <option value="0" {{ old('is_selesai') == '0' ? 'selected' : '' }}>Belum Selesai</option>
                        </select>
                        @error('is_selesai')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit dan Kembali -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('kompen') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
