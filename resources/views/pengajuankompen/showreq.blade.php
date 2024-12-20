<div class="modal fade animate shake" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Status Acc</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="request-body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmationMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmActionBtn">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>
</div>



<script>
    function showRequestModal(uuidKompen) {
        $('#myModal').modal('show');
        getKompenRequestByUuid(uuidKompen);
    }
    
    function getKompenRequestByUuid(uuidKompen) {
        $.ajax({
            url: "{{ route('pengajuankompen.requests', '') }}/" + uuidKompen,
            method: 'GET',
            success: function(response) {
                if (response.data) {
                    let rows = '';
                    response.data.forEach(function(request) {
                        const isAccepted = request.status_Acc === 1;
                        const isRejected = request.status_Acc === 0;
                        const isPending = request.status_Acc === null;
    
                        rows += `
                            <tr>
                                <td>${request.ni}</td>
                                <td>${request.nama}</td>
                                <td>${isAccepted ? 'Diterima' : (isRejected ? 'Ditolak' : 'Menunggu')}</td>
                                <td class="action-buttons">
                                    <button onclick="confirmAction('Terima', '${request.ni}', '${uuidKompen}', 1)" class="btn btn-success btn-sm" ${isAccepted ? 'disabled' : ''}>Terima</button>
                                    <button onclick="confirmAction('Tolak', '${request.ni}', '${uuidKompen}', 0)" class="btn btn-danger btn-sm" ${isAccepted || isRejected ? 'disabled' : ''}>Tolak</button>
                                    <button onclick="confirmAction('Hapus', '${request.ni}', '${uuidKompen}', null)" class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>`;
                    });
                    $('#request-body').html(rows);
                } else {
                    $('#request-body').html('<tr><td colspan="4" class="text-center">Tidak ada permintaan ditemukan.</td></tr>');
                }
            },
            error: function() {
                $('#request-body').html('<tr><td colspan="4" class="text-center">Belum ada Request.</td></tr>');
            }
        });
    }
    
    function confirmAction(action, ni, uuidKompen, statusAcc) {
        $('#confirmationMessage').text(`Apakah Anda yakin ingin ${action} request ini?`);
        $('#confirmationModal').modal('show');

        $('#confirmActionBtn').off('click').on('click', function() {
            if (action === 'Hapus') {
                deleteRequest(ni, uuidKompen);
            } else {
                updateStatus(ni, uuidKompen, statusAcc);
            }
            $('#confirmationModal').modal('hide');
        });
    }

    
    function updateStatus(ni, uuidKompen, statusAcc) {
        let requestData = {
            _token: '{{ csrf_token() }}',
            ni: ni,
            UUID_Kompen: uuidKompen,
            status_Acc: statusAcc
        };
        $.ajax({
            url: "{{ route('pengajuankompen.update_status') }}",
            method: 'POST',
            data: requestData,
            success: function(response) {
                showAlert(response.message);
                getKompenRequestByUuid(uuidKompen);
            },
            error: function(response) {
                if (response.responseJSON && response.responseJSON.message) {
                    showAlert(response.responseJSON.message);
                } else {
                    showAlert('Gagal memperbarui status.');
                }
            }
        });
    }
    
    function deleteRequest(ni, uuidKompen) {
        let requestData = {
            _token: '{{ csrf_token() }}',
            ni: ni,
            UUID_Kompen: uuidKompen
        };
        $.ajax({
            url: "{{ route('pengajuankompen.delete_request') }}",
            method: 'POST',
            data: requestData,
            success: function(response) {
                showAlert(response.message);
                getKompenRequestByUuid(uuidKompen);
            },
            error: function(response) {
                showAlert('Gagal menghapus permintaan.');
            }
        });
    }
    
    function showAlert(message) {
        $('#notificationMessage').text(message);
        $('#notificationModal').modal('show');
    }
</script>
