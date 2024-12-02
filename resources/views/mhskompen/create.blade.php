@extends('layouts.template')

@section('content')
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 5px;
        text-align: center;
    }

    .modal-footer {
        margin-top: 20px;
    }

    .modal-footer button {
        margin: 0 10px;
    }
</style>

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Request Kompen</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="requestForm" action="{{ route('mhskompen.store') }}" method="POST">
            @csrf
            <input type="hidden" name="UUID_Kompen" value="{{ $kompen->UUID_Kompen }}">
            
            <div class="form-group">
                <label for="ni">NIM</label>
                <input type="text" class="form-control" id="ni" name="ni" value="{{ auth()->user()->ni }}" readonly>
            </div>
            
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ auth()->user()->nama }}" readonly>
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

            <button type="button" onclick="confirmSubmission()" class="btn btn-primary">Submit Request</button>
            <a href="{{ route('mhskompen.index') }}" class="btn btn-secondary">Cancel</a>
        </form>

        <!-- Custom Modal -->
        <div id="confirmModal" class="modal">
            <div class="modal-content">
                <h4>Konfirmasi</h4>
                <p>Apakah Anda yakin ingin request kompen ini?</p>
                <div class="modal-footer">
                    <button onclick="submitForm()" class="btn btn-primary">Ya</button>
                    <button onclick="closeModal()" class="btn btn-secondary">Tidak</button>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function confirmSubmission() {
                document.getElementById('confirmModal').style.display = 'block';
            }

            function closeModal() {
                document.getElementById('confirmModal').style.display = 'none';
            }

            function submitForm() {
                document.getElementById('requestForm').submit();
            }

            // Close the modal if user clicks outside of it
            window.onclick = function(event) {
                var modal = document.getElementById('confirmModal');
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>
</div>
@endsection