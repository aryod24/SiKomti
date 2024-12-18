<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Pengguna</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&display=swap">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    <style>
         body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Montserrat', sans-serif;
        }

        .login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('{{ asset("images/polinema.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .login-box {
            background: rgb(255, 246, 246);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            position: fixed; /* Tetap pada posisi */
            top: 50%; /* Posisi vertikal */
            left: 50%; /* Posisi horizontal */
            transform: translate(-50%, -50%); /* Pusatkan elemen */
            text-align: center;
        }
        
        .login-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #000000; /* Warna teks putih */
            margin-bottom: 1.5rem;
        }
    
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1rem;
        }

        /* Gaya untuk logo pertama */
        .logo-first {
            width: 100px;
            height: 100px;
            object-fit: contain; /* Menjaga rasio gambar agar tidak terdistorsi */
            margin-right: 10px; /* Memberikan jarak antar logo */
        }

        /* Gaya untuk logo kedua */
        .logo-second {
            width: 100px;
            height: 100px;
            object-fit: contain; /* Menjaga rasio gambar agar tidak terdistorsi */
            margin-left: 10px; /* Memberikan jarak antar logo */
        }
   
        /* Gaya untuk logo ketiga */
        .logo-three {
            width: 100px;
            height: 100px;
            object-fit: contain; /* Menjaga rasio gambar agar tidak terdistorsi */
            margin-left: 10px; /* Memberikan jarak antar logo */
        }

        .login-subtitle {
            font-size: 1.2rem;
            color: #000000;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
    
        .input-group input {
            font-size: 1.1rem;
            padding: 0.8rem;
            border-radius: 10px;
            width: 100%;
            margin-bottom: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.315); /* Menambahkan border tipis dengan transparansi */
            background: rgba(255, 255, 255, 0.7); /* Latar belakang input transparan putih */
            box-sizing: border-box;
        }

        .btn-login {
            font-size: 1.2rem;
            padding: 1rem;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(135deg, #556b8a, #354261);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 1rem;
            width: 100%;
        }
    
        .btn-login:hover {
            background: linear-gradient(135deg, #43506e, #273244);
        }
    
        .register-prompt {
            font-size: 1rem;
            color: #000000;
            text-decoration: underline;
            margin-top: 1rem;
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-title">Register to Sikomti</div>
        <div class="logo">
            <img src="{{ asset('adminlte/dist/img/polinema.png') }}" alt="AdminLTE Logo" class="logo-first">
            <img src="{{ asset('adminlte/dist/img/Jti_polinema.svg.png') }}" alt="AdminLTE Logo" class="logo-second">
            <img src="{{ asset('adminlte/dist/img/LOGO.png') }}" alt="AdminLTE Logo" class="logo-three">
        </div>
        <p class="login-subtitle">Silahkan Daftar untuk memulai sesi Anda</p>

        <form action="{{ url('register') }}" method="POST" id="form-register">
            @csrf
            <div class="input-group mb-3">
                <select name="level_id" id="level_id" class="form-control" required>
                    <option value="">- Pilih Level -</option>
                    @foreach ($level as $l)
                        <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                    @endforeach
                </select>
                <label class="error-message" id="level-error"></label>
            </div>
        
            <div class="input-group mb-3">
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username" required>
                <label class="error-message" id="username-error"></label>
            </div>
        
            <div id="nama-field" class="input-group mb-3" style="display: none;">
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama">
                <label class="error-message" id="nama-error"></label>
            </div>
        
            <div id="nim-field" class="input-group mb-3" style="display: none;">
                <input type="text" id="ni" name="ni" class="form-control" placeholder="Masukkan NIM" maxlength="16" pattern="[0-9]*">
                <label class="error-message" id="nim-error"></label>
            </div>
        
            <div id="kelas-field" class="input-group mb-3" style="display: none;">
                <input type="text" id="kelas" name="kelas" class="form-control" placeholder="Masukkan Kelas">
                <label class="error-message" id="kelas-error"></label>
            </div>
        
            <div id="jurusan-field" class="input-group mb-3" style="display: none;">
                <input type="text" id="jurusan" name="jurusan" class="form-control" placeholder="Masukkan Jurusan">
                <label class="error-message" id="jurusan-error"></label>
            </div>
        
            <div id="semester-field" class="input-group mb-3" style="display: none;">
                <input type="text" id="semester" name="semester" class="form-control" placeholder="Masukkan Semester">
                <label class="error-message" id="semester-error"></label>
            </div>
        
            <div id="nomorinduk-field" class="input-group mb-3" style="display: none;">
                <input type="text" id="ni" name="ni" class="form-control" placeholder="Masukkan Nomor Induk" maxlength="16" pattern="[0-9]*">
                <label class="error-message" id="nomorinduk-error"></label>
            </div>
        
            <div class="input-group mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                <label class="error-message" id="password-error"></label>
            </div>
        
            <button type="submit" class="btn-login">Sign Up</button>
        </form>
        
            <a href="{{ url('/') }}" class="register-prompt">Sudah punya akun? Login</a>
        </form>

        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
        <script>
            $(document).ready(function() {
            $('#level_id').change(function() {
                const level = $(this).val();
                
                // Hide all fields first
                $('#nama-field, #nim-field, #kelas-field, #jurusan-field, #semester-field, #nomorinduk-field').hide();
                
                // Remove all required attributes
                $('input').not('#username, #password').prop('required', false);
                
                if (level === '2') {
                    $('#nama-field, #nomorinduk-field, #kelas-field, #jurusan-field, #semester-field').show();
                    $('#nama, #ni, #kelas, #jurusan, #semester').prop('required', true);
                } else if (level === '3' || level === '4') {
                    $('#nama-field, #nomorinduk-field, #jurusan-field').show();
                    $('#nama, #ni, #jurusan').prop('required', true);
                }
            });

        // Modify the validation for nomor induk
        $.validator.addMethod("nomorIndukValidation", function(value, element) {
            return this.optional(element) || /^\d+$/.test(value);
        }, "Nomor Induk harus berupa angka");

            $("#form-register").validate({
                rules: {
                    level_id: { required: true },
                    username: { required: true, minlength: 3, maxlength: 20 },
                    nama: { 
                        required: function() {
                            return $('#level_id').val() !== '1';
                        }
                    },
                    ni: { 
                        required: function() {
                            return ['2','3','4'].includes($('#level_id').val());
                        },
                        nomorIndukValidation: true
                    },
                    password: { required: true, minlength: 5, maxlength: 20 },
                    kelas: { 
                        required: function() {
                            return $('#level_id').val() === '2';
                        }
                    },
                    jurusan: { 
                        required: function() {
                            return $('#level_id').val() !== '1';
                        }
                    },
                    semester: { 
                        required: function() {
                            return $('#level_id').val() === '2';
                        }
                    }
                },
                messages: {
                    ni: {
                        required: "Nomor Induk wajib diisi",
                        nomorIndukValidation: "Nomor Induk harus 16 digit angka"
                    }
                },
                // Prevent non-numeric input
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else {
                                $('.error-message').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#' + prefix + '-error').text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                }
            });

    // Prevent non-numeric input
    $('#ni').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

        </script>
    </div>
</body>
</html>
