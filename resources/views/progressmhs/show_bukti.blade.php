<div class="modal-header">
    <h5 class="modal-title">Detail Bukti Kompen</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nama Progress</th>
                    <td>{{ $progress->nama_progres }}</td>
                </tr>
                <tr>
                    <th>File Bukti</th>
                    <td>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ $progress->bukti_kompen }}</span>
                            <a href="{{ asset('storage/bukti_kompen/' . $progress->bukti_kompen) }}" 
                               class="btn btn-primary btn-sm" 
                               download>
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Upload</th>
                    <td>{{ $progress->updated_at->format('d F Y H:i') }}</td>
                </tr>
                @if($progress->bukti_kompen)
                    <tr>
                        <th>Preview</th>
                        <td>
                            @php
                                $extension = pathinfo($progress->bukti_kompen, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                            @endphp
                            
                            @if($isImage)
                                <img src="{{ asset('storage/bukti_kompen/' . $progress->bukti_kompen) }}" 
                                     class="img-fluid" 
                                     alt="Bukti Kompen">
                            @else
                                <p class="text-muted">Preview tidak tersedia untuk file {{ strtoupper($extension) }}</p>
                            @endif
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>