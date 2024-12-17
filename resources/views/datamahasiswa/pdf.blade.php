<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa Alpha</title>
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
            margin-left: 0px;
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
        .footer-note {
            margin-top: 10px;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
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
                    <h3>JURUSAN TEKNOLOGI INFORMASI</h3>
                    <p>Jl. Soekarno Hatta No.9 Malang 65141</p>
                    <p>Telp. 0341404424 Fax. 0341404420, http://www.poltek-malang.ac.id</p>
                </td>
            </tr>
        </table>

        <div class="divider"></div>

        <h1 class="title">Data Mahasiswa Alpha</h1>

        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Semester</th>
                    <th>Jam Alpha</th>
                    <th>Jam Kompen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $mahasiswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mahasiswa->ni }}</td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->semester }}</td>
                        <td>{{ $mahasiswa->jam_alpha }}</td>
                        <td>{{ $mahasiswa->jam_kompen }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
