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
        .header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }
        .header-text {
            flex: 1;
            text-align: center;
        }
        .header-text h3 {
            font-size: 16px;
            margin: 5px 0;
            font-weight: bold;
        }
        .header-text p {
            font-size: 11px;
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
            margin-left: 20px;
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
        .signatures-container {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            padding: 0 20px;
        }
        .signature-left {
            width: 250px;
            text-align: left;
        }
        .signature-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            width: 250px;
        }
        .qr-code {
            width: 120px;
            height: 120px;
        }
        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .signature-text {
            margin: 0;
            line-height: 1.8;
        }
        .footer-note {
            margin-top: 50px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo Polinema" class="logo">
            <div class="header-text">
                <h3>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h3>
                <h3>POLITEKNIK NEGERI MALANG</h3>
                <h3>PROGRAM STUDI TEKNIK INFORMATIKA</h3>
                <p>Jl. Soekarno Hatta No.9 Malang 65141</p>
                <p>Telp. 0341404424 Fax. 0341404420, http://www.poltek-malang.ac.id</p>
            </div>
        </div>

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
                <span>{{ $progress->kompen->nama }}</span>
            </div>
            <div class="content-row">
                <span class="label">Jumlah Jam</span>
                <span class="colon">:</span>
                <span>{{ $progress->kompen->jam_kompen }} jam</span>
            </div>
        </div>

        <div class="signatures-container">
            <div class="signature-left">
                <p class="signature-text">Mengetahui,</p>
                <p class="signature-text">Ka. Program Studi</p>
                <br><br><br>
                <p class="signature-text">(Hendra Pradibta, SE., M.Sc.)</p>
                <p class="signature-text">NIP. 198305212006041003</p>
            </div>
            <div class="signature-right">
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
                </div>
                <p class="signature-text">Malang, ........................</p>
                <p class="signature-text">Yang memberikan rekomendasi,</p>
                <p class="signature-text">(.....................................)</p>
                <p class="signature-text">NIP.</p>
            </div>
        </div>

        <div class="footer-note">
            <p>FRM.RIF.01.07.03</p>
            <p>NB: Form ini wajib disimpan untuk keperluan bebas tanggungan</p>
        </div>
    </div>
</body>
</html>
