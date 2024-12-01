<div class="modal-header">
    <h5 class="modal-title">Upload Bukti Kompen</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="uploadBuktiForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="UUID_Kompen" value="{{ $uuidKompen }}">
        
        <div class="form-group">
            <label for="nama_progres">Nama Progress</label>
            <input type="text" class="form-control" id="nama_progres" name="nama_progres" 
                   value="{{ $progress->nama_progres ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="bukti_kompen">Upload Bukti</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="bukti_kompen" name="bukti_kompen" required>
                <label class="custom-file-label" for="bukti_kompen">Pilih file</label>
            </div>
            <small class="form-text text-muted">
                Format yang diizinkan: JPG, JPEG, PNG, PDF, DOC, DOCX, ZIP (Maksimal 4MB)
            </small>
        </div>

        <div id="upload-alert" class="alert" style="display: none;"></div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    <button type="button" class="btn btn-primary" onclick="submitBukti()">Upload</button>
</div>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function submitBukti() {
        let formData = new FormData($('#uploadBuktiForm')[0]);
        
        $.ajax({
            url: '{{ route("progressmhs.upload-bukti") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    setTimeout(function() {
                        $('#detailModal').modal('hide');
                        $('#table_progress').DataTable().ajax.reload();
                    }, 1500);
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan saat upload';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showAlert('danger', errorMessage);
            }
        });
    }

    function showAlert(type, message) {
        $('#upload-alert')
            .removeClass()
            .addClass('alert alert-' + type)
            .html(message)
            .show();
        
        if (type === 'success') {
            setTimeout(function() {
                $('#upload-alert').fadeOut();
            }, 1500);
        }
    }
</script>