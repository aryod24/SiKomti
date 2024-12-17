<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(90deg, #ffffff, #fdfeff);
            color: white;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background-color: #7c93b8;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            color: white;
        }
        .card-header {
            background-color: #2C3E50;
            color: white;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #2C3E50;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1A242F;
        }
        .btn-secondary {
            background-color: #5c759c;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #4A617D;
        }
        .form-control {
            background-color: #e9ecef;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2>Update Profil dan Password</h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
<<<<<<< HEAD
                
=======

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
                <form action="{{ route('profile.update.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ auth()->user()->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
<<<<<<< HEAD
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ auth()->user()->jurusan }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">NIM/NIK/NIP</label>
                        <input type="text" class="form-control" id="ni" name="ni" value="{{ auth()->user()->ni }}" required>
                    </div>
=======
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ auth()->user()->jurusan }}">
                    </div>
                    <div class="form-group">
                        <label for="ni">NIM/NIK/NIP</label>
                        <input type="text" class="form-control" id="ni" name="ni" value="{{ auth()->user()->ni }}" required>
                    </div>
                    @if (auth()->user()->level_id == 2)
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ auth()->user()->kelas }}">
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control" id="semester" name="semester" value="{{ auth()->user()->semester }}">
                        </div>
                    @endif
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
                    <div class="form-group">
                        <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('profile/') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
