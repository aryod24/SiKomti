<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Kompensasi Presensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: 100px;
        }
        .header-text {
            text-align: center;
        }
        .header-text h3 {
            font-size: 14px;
            margin: 5px 0;
            font-weight: bold;
        }
        .header-text p {
            font-size: 13px;
            margin: 3px 0;
        }
        .divider {
            border-top: 1px solid black;
            margin: 15px 0;
        }
        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 30px 0;
        }
        .content {
<<<<<<< HEAD
            margin-left: 20px;
=======
            margin-left: 0px;
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
        }
        .content-row {
            margin-bottom: 8px;
            display: flex;
        }
        .label {
            width: 120px;
            display: inline-block;
        }
        .colon {
            width: 20px;
            display: inline-block;
        }
        .signature-table {
            width: 100%;
<<<<<<< HEAD
            margin-top: 50px;
=======
            margin-top: 10px;
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            border-spacing: 0 20px; /* Menambahkan jarak antar baris tabel */
        }
        .signature-table td {
            text-align: center; /* Semua teks di tengah secara horizontal */
            vertical-align: top; /* Semua teks di atas secara vertikal */
            padding: 5px; /* Memberikan jarak dalam sel */
            width: 33.33%; /* Membagi lebar kolom tabel secara simetris */
        }
        .qr-code {
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }
        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .signature-text {
            margin: 0;
            line-height: 1.8;
            text-align: left; /* Rata kiri untuk teks dalam kolom */
        }
        .footer-note {
<<<<<<< HEAD
            margin-top: 50px;
=======
            margin-top: 10px;
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header menggunakan tabel -->
        <table class="header-table">
            <tr>
                <!-- Kolom pertama untuk logo -->
                <td style="width: 100px; padding-right: 20px;">
                    <img class="logo" src="adminlte/dist/img/polinema.png" alt="Logo Polinema">
                </td>
                <!-- Kolom kedua untuk teks header -->
                <td class="header-text">
                    <h3>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h3>
                    <h3>POLITEKNIK NEGERI MALANG</h3>
                    <h3>PROGRAM STUDI TEKNIK INFORMATIKA</h3>
                    <p>Jl. Soekarno Hatta No.9 Malang 65141</p>
                    <p>Telp. 0341404424 Fax. 0341404420, http://www.poltek-malang.ac.id</p>
                </td>
            </tr>
        </table>

        <div class="divider"></div>

        <div class="title">BERITA ACARA KOMPENSASI PRESENSI</div>

        <div class="content">
            <div class="content-row">
                <span class="label">Nama Pengajar</span>
                <span class="colon">:</span>
                <span>{{ $progress->kompen->user->nama }}</span>
            </div>
            <div class="content-row">
                <span class="label">NIP</span>
                <span class="colon">:</span>
                <span>{{ $progress->kompen->user->ni }}</span>
            </div>
            
            <div class="content-row" style="margin: 20px 0 10px 0;">
                <p>Memberikan rekomendasi kompensasi kepada:</p>
            </div>
            
            <div class="content-row">
                <span class="label">Nama Mahasiswa</span>
                <span class="colon">:</span>
                <span>{{ $progress->nama }}</span>
            </div>
            <div class="content-row">
                <span class="label">NIM</span>
                <span class="colon">:</span>
                <span>{{ $progress->ni }}</span>
            </div>
            <div class="content-row">
                <span class="label">Kelas</span>
                <span class="colon">:</span>
                <span>{{ $progress->kelas }}</span>
            </div>
            <div class="content-row">
                <span class="label">Semester</span>
                <span class="colon">:</span>
                <span>{{ $progress->semester }}</span>
            </div>
            <div class="content-row">
                <span class="label">Pekerjaan</span>
                <span class="colon">:</span>
<<<<<<< HEAD
                <span>{{ $progress->kompen->nama }}</span>
=======
                <span>{{ $progress->kompen->nama_kompen }}</span>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
            </div>
            <div class="content-row">
                <span class="label">Jumlah Jam</span>
                <span class="colon">:</span>
                <span>{{ $progress->kompen->jam_kompen }} jam</span>
            </div>
        </div>

        <table class="signature-table">
            <tr>
                <td>
                    <p class="signature-text">Mengetahui,</p>
                    <p class="signature-text">Ka. Program Studi</p>
                    <br><br><br>
                    <p class="signature-text">(Hendra Pradibta, SE., M.Sc.)</p>
                    <p class="signature-text">NIP. 198305212006041003</p>
                </td>
                <td>
                    <div class="qr-code">
                        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
                    </div>
                </td>
                <td>
                    <p class="signature-text">Malang, ........................</p>
                    <p class="signature-text">Yang memberikan rekomendasi,</p>
                    <br><br><br>
                    <p class="signature-text">(.....................................)</p>
                    <p class="signature-text">NIP.</p>
                </td>
            </tr>
        </table>

        <div class="footer-note">
            <p>FRM.RIF.01.07.03</p>
            <p>NB: Form ini wajib disimpan untuk keperluan bebas tanggungan</p>
        </div>
    </div>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
