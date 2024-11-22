<form action="{{ url('/kompen/ajax') }}" method="POST" id="form-tambah-kompen">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kompen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kompen</label>
                    <input value="" type="text" name="nama_kompen" id="nama_kompen" class="form-control" required>
                    <small id="error-nama_kompen" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                    <small id="error-deskripsi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Jenis Tugas</label>
                    <select name="jenis_tugas" id="jenis_tugas" class="form-control">
                        <option value="">Pilih Jenis Tugas</option>
                        <!-- Tambahkan opsi untuk jenis tugas -->
                    </select>
                    <small id="error-jenis_tugas" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Quota</label>
                    <input value="" type="number" name="quota" id="quota" class="form-control">
                    <small id="error-quota" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Jam Kompen</label>
                    <input value="" type="number" name="jam_kompen" id="jam_kompen" class="form-control">
                    <small id="error-jam_kompen" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input value="" type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                    <small id="error-tanggal_mulai" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input value="" type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                    <small id="error-tanggal_akhir" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>ID Kompetensi</label>
                    <input value="" type="number" name="id_kompetensi" id="id_kompetensi" class="form-control">
                    <small id="error-id_kompetensi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Periode Kompen</label>
                    <input value="" type="text" name="periode_kompen" id="periode_kompen" class="form-control">
                    <small id="error-periode_kompen" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah-kompen").validate({
            rules: {
                nama_kompen: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                deskripsi: {
                    required: false,
                    minlength: 5
                },
                jenis_tugas: {
                    required: true
                },
                quota: {
                    required: true,
                    min: 1
                },
                jam_kompen: {
                    required: true,
                    min: 1
                },
                tanggal_mulai: {
                    required: true
                },
                tanggal_akhir: {
                    required: true
                },
                id_kompetensi: {
                    required: true,
                    min: 1
                },
                periode_kompen: {
                    required: false,
                    minlength: 5
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataKompen.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
