<div class="modal-header">
    <h5 class="modal-title">Request Kompen</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <div id="modal-alert-container"></div>
    <form id="requestForm" action="{{ route('mhskompen.store-ajax') }}" method="POST">
        @csrf
        <input type="hidden" name="UUID_Kompen" value="{{ $kompen->UUID_Kompen }}">
        
        <div class="form-group">
            <label for="ni">NIM</label>
            <input type="text" class="form-control" id="ni" name="ni" value="{{ auth()->user()->ni }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ auth()->user()->nama }}" readonly>
<<<<<<< HEAD
=======
   
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ auth()->user()->kelas }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="text" class="form-control" id="semester" name="semester" value="{{ auth()->user()->semester }}" readonly>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        </div>
        
        <div class="form-group">
            <label for="nama_kompen">Nama Kompen</label>
            <input type="text" class="form-control" id="nama_kompen" value="{{ $kompen->nama_kompen }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" rows="3" readonly>{{ $kompen->deskripsi }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="jam_kompen">Jam Kompen</label>
            <input type="text" class="form-control" id="jam_kompen" value="{{ $kompen->jam_kompen }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="text" class="form-control" id="tanggal_mulai" value="{{ $kompen->tanggal_mulai }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="text" class="form-control" id="tanggal_akhir" value="{{ $kompen->tanggal_akhir }}" readonly>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit Request</button>
</div>