<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Login Pengguna</title>
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
        <div class="login-title">Welcome to Sikomti</div>
        <div class="logo">
            <img src="{{ asset('adminlte/dist/img/polinema.png') }}" alt="AdminLTE Logo" class="logo-first">
            <img src="{{ asset('adminlte/dist/img/Jti_polinema.svg.png') }}" alt="AdminLTE Logo" class="logo-second">
            <img src="{{ asset('adminlte/dist/img/LOGO.png') }}" alt="AdminLTE Logo" class="logo-three">
        </div>
        <p class="login-subtitle">Silahkan Login Ke akun anda</p>

        <form action="{{ url('login') }}" method="POST" id="form-login">
            @csrf
            <div class="input-group mb-3">
                <input type="text" id="username" name="username" class="username-field" placeholder="Masukkan Username">
                <label class="error-message" id="username-error"></label>
            </div>

            <div class="input-group mb-3">
                <input type="password" id="password" name="password" class="password-field" placeholder="Masukkan Password">
                <label class="error-message" id="password-error"></label>
            </div>

            <div class="remember-me-container">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember"><label for="remember">Remember Me</label>
                </div>
            </div>

            <button type="submit" class="btn-login">Login</button>

            <a href="{{ url('register') }}" class="register-prompt">Belum punya akun? Register</a>
        </form>

        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#form-login").validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 4,
                            maxlength: 20
                        },
                        password: {
                            required: true,
                            minlength: 5,
                            maxlength: 20
                        }
                    },
                    messages: {
                        username: {
                            required: "Username harus diisi",
                            minlength: "Username minimal 4 karakter",
                            maxlength: "Username maksimal 20 karakter"
                        },
                        password: {
                            required: "Password harus diisi",
                            minlength: "Password minimal 5 karakter",
                            maxlength: "Password maksimal 20 karakter"
                        }
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element).addClass('error-message');
                    },
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
            });
        </script>
    </div>
</body>
</html>
