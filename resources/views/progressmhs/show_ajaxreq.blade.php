<div class="modal-header">
    <h5 class="modal-title">Detail Kompen Request</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <table class="table table-bordered">
        <tr>
            <th>ID Mahasiswa Kompen</th>
            <td>{{ $kompenRequest->id_MahasiswaKompen }}</td>
        </tr>
        <tr>
            <th>NIM</th>
            <td>{{ $kompenRequest->ni }}</td>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
            <td>{{ $kompenRequest->nama }}</td>
        </tr>
        <tr>
            <th>Nama Kompen</th>
            <td>{{ $kompenRequest->kompen->nama_kompen }}</td>
        </tr>
        <tr>
            <th>Deskripsi Kompen</th>
            <td>{{ $kompenRequest->kompen->deskripsi }}</td>
        </tr>
        <tr>
            <th>Jam Kompen</th>
            <td>{{ $kompenRequest->kompen->jam_kompen }}</td>
        </tr>
        <tr>
            <th>Tanggal Mulai</th>
            <td>{{ $kompenRequest->kompen->tanggal_mulai }}</td>
        </tr>
        <tr>
            <th>Tanggal Akhir</th>
            <td>{{ $kompenRequest->kompen->tanggal_akhir }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if($kompenRequest->status_Acc === null)
                    Menunggu Persetujuan
                @elseif($kompenRequest->status_Acc === 1)
                    Disetujui
                @else
                    Ditolak
                @endif
            </td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>