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
                    <!-- Nama Kompen -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama Kompen</label>
                        <div class="col-11">
                            <input type="text" class="form-control" name="nama_kompen" value="{{ old('nama_kompen', $kompen->nama_kompen) }}" required>
                            @error('nama_kompen')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Deskripsi</label>
                        <div class="col-11">
                            <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $kompen->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Jenis Tugas -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Jenis Tugas</label>
                        <div class="col-11">
                            <select class="form-control" name="jenis_tugas" required>
                                <option value="">- Pilih Jenis Tugas -</option>
                                @foreach ($jenisTugas as $jenis)
                                    <option value="{{ $jenis->id_tugas }}" {{ old('jenis_tugas', $kompen->jenis_tugas) == $jenis->id_tugas ? 'selected' : '' }}>{{ $jenis->jenis_tugas }}</option>
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
                            <select class="form-control" name="id_kompetensi" required>
                                <option value="">- Pilih Kompetensi -</option>
                                @foreach ($kompetensi as $kompeten)
                                    <option value="{{ $kompeten->id_kompetensi }}" {{ old('id_kompetensi', $kompen->id_kompetensi) == $kompeten->id_kompetensi ? 'selected' : '' }}>{{ $kompeten->nama_kompetensi }}</option>
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
                            <input type="number" class="form-control" name="quota" value="{{ old('quota', $kompen->quota) }}">
                            @error('quota')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Jam Kompen -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Jam Kompen</label>
                        <div class="col-11">
                            <input type="number" class="form-control" name="jam_kompen" value="{{ old('jam_kompen', $kompen->jam_kompen) }}">
                            @error('jam_kompen')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Status Dibuka -->
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
                    
                    <!-- Tanggal Mulai -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Mulai</label>
                        <div class="col-11">
                            <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kompen->tanggal_mulai) }}">
                            @error('tanggal_mulai')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Tanggal Akhir -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Akhir</label>
                        <div class="col-11">
                            <input type="date" class="form-control" name="tanggal_akhir" value="{{ old('tanggal_akhir', $kompen->tanggal_akhir) }}">
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
                            <select class="form-control" name="periode_kompen">
                                <option value="">- Pilih Periode -</option>
                                @for ($year = 2021; $year <= 2024; $year++)
                                    <option value="{{ $year }}" {{ old('periode_kompen', $kompen->periode_kompen) == $year ? 'selected' : '' }}>{{ $year }}</option>
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
                            <select class="form-control" name="is_selesai">
                                <option value="1" {{ old('is_selesai', $kompen->is_selesai) == 1 ? 'selected' : '' }}>Selesai</option>
                                <option value="0" {{ old('is_selesai', $kompen->is_selesai) == 0 ? 'selected' : '' }}>Belum Selesai</option>
                            </select>
                            @error('is_selesai')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Submit dan Kembali -->
                    <div class="form-group row">
                        <div class="col-11 offset-1">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('kompen') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
