@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header" style="background-color: #6b83a8; color: white;">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @empty($kompen)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data kompen yang Anda cari tidak ditemukan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <table class="table table-bordered table-hover table-sm">
                    <thead style="background-color: #6b83a8; color: white;">
                        <tr>
                            <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Detail Kompen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-start">ID Kompen</th>
                            <td class="text-start">{{ $kompen->UUID_Kompen }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Nama Kompen</th>
                            <td class="text-start">{{ $kompen->nama_kompen }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Deskripsi</th>
                            <td class="text-start">{{ $kompen->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Jenis Tugas</th>
                            <td class="text-start">{{ $kompen->jenisTugas->jenis_tugas ?? 'Tidak Diketahui' }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Quota</th>
                            <td class="text-start">{{ $kompen->quota }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Jam Kompen</th>
                            <td class="text-start">{{ $kompen->jam_kompen }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Tanggal Mulai</th>
                            <td class="text-start">{{ $kompen->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Tanggal Akhir</th>
                            <td class="text-start">{{ $kompen->tanggal_akhir }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Kompetensi</th>
                            <td class="text-start">{{ $kompen->kompetensi->nama_kompetensi ?? 'Tidak Diketahui' }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">Periode Kompen</th>
                            <td class="text-start">{{ $kompen->periode_kompen }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- QR Code Display -->
                <div class="qr-code my-4">
                    <h5>Kode QR Kompensasi:</h5>
                    <div class="text-center">{!! $qrCode !!}</div>
                </div>

                <!-- QR Code Reader -->
                <div class="qr-code-reader my-4">
                    <h5>Scan QR Code:</h5>
                    <div id="reader" style="width: 300px; margin: auto;"></div>
                    <div id="qr-result" class="mt-3 text-center"></div>
                </div>

                <h5 class="mt-4">Mahasiswa Kompen</h5>
                <table class="table table-bordered table-hover table-sm mt-3">
                    <thead style="background-color: #6b83a8; color: white;">
                        <tr>
                            <th>NI</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kompen->progresKompen as $mahasiswa)
                            <tr>
                                <td>{{ $mahasiswa->ni }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->kelas }}</td>
                                <td>{{ $mahasiswa->semester }}</td>
                                <td>{{ $mahasiswa->status_acc == 1 ? 'Disetujui' : 'Belum Disetujui' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endempty
            <div class="text-end mt-3">
                <a href="{{ url('history-kompen') }}" class="btn btn-sm" style="background-color: #6b83a8; color: white;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
@push('css')
<style>
    .table th {
        width: 30%;
    }
    .card-header {
        background-color: #6b83a8 !important;
        color: white;
    }
    .card-outline {
        border: 1px solid #6b83a8 !important;
    }
</style>
@endpush
@push('js')
<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const qrResultElement = document.getElementById('qr-result');
        const html5QrCode = new Html5Qrcode("reader");

        // Konfigurasi dan memulai pembaca QR Code
        html5QrCode.start(
            { facingMode: "environment" }, // Kamera belakang
            {
                fps: 10, // Frame per detik
                qrbox: 250, // Ukuran kotak pembaca
            },
            (decodedText) => {
                // Saat QR Code berhasil dibaca
                qrResultElement.innerHTML = `<p class="text-success">Hasil QR Code: ${decodedText}</p>`;
                html5QrCode.stop(); // Hentikan pembaca setelah membaca
            },
            (errorMessage) => {
                // Kesalahan atau QR Code tidak terbaca
                console.log("Peringatan:", errorMessage);
            }
        ).catch((err) => {
            console.error("Kesalahan saat memulai pembaca QR Code:", err);
        });
    });
</script>
@endpush
