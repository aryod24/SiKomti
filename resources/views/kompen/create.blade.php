@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Kompen</h3>
        </div>
        <div class="card-body">
            <!-- Formulir untuk menambahkan kompen -->
            <form id="kompenForm">
                @csrf
                <div class="form-group">
                    <label for="nama_kompen">Nama Kompen</label>
                    <input type="text" class="form-control" id="nama_kompen" name="nama_kompen" required>
                    <span class="text-danger" id="error-nama_kompen"></span>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    <span class="text-danger" id="error-deskripsi"></span>
                </div>

                <div class="form-group">
                    <label for="jenis_tugas">Jenis Tugas</label>
                    <input type="number" class="form-control" id="jenis_tugas" name="jenis_tugas" required>
                    <span class="text-danger" id="error-jenis_tugas"></span>
                </div>

                <div class="form-group">
                    <label for="quota">Quota</label>
                    <input type="number" class="form-control" id="quota" name="quota" required>
                    <span class="text-danger" id="error-quota"></span>
                </div>

                <div class="form-group">
                    <label for="jam_kompen">Jam Kompen</label>
                    <input type="number" class="form-control" id="jam_kompen" name="jam_kompen" required>
                    <span class="text-danger" id="error-jam_kompen"></span>
                </div>

                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                    <span class="text-danger" id="error-tanggal_mulai"></span>
                </div>

                <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
                    <span class="text-danger" id="error-tanggal_akhir"></span>
                </div>

                <div class="form-group">
                    <label for="id_kompetensi">Kompetensi</label>
                    <select class="form-control" id="id_kompetensi" name="id_kompetensi" required>
                        <option value="">-- Pilih Kompetensi --</option>
                        @foreach($kompetensi as $k)
                            <option value="{{ $k->id_kompetensi }}">{{ $k->nama_kompetensi }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger" id="error-id_kompetensi"></span>
                </div>

                <div class="form-group">
                    <label for="periode_kompen">Periode Kompen</label>
                    <input type="text" class="form-control" id="periode_kompen" name="periode_kompen">
                    <span class="text-danger" id="error-periode_kompen"></span>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Kompen</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Submit form menggunakan AJAX
            $('#kompenForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                // Mengirim data menggunakan AJAX
                $.ajax({
                    url: '{{ route('kompen.store_ajax') }}',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            alert(response.message);
                            // Clear form setelah sukses
                            $('#kompenForm')[0].reset();
                        } else {
                            // Tampilkan pesan error untuk setiap field
                            $.each(response.msgField, function(key, value) {
                                $('#error-' + key).text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
