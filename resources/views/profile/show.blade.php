@extends('layouts.template')

@section('content')
<div class="container-fluid" style="background-color: #f5f5f5;"> <!-- Adding a lighter background for the container -->
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <!-- Header Panel -->
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <div class="card-header text-white text-center" style="background-color: #6b83a8; padding: 20px;">
                    <h4 class="mb-0 font-weight-bold">Profil Anda</h4>
                </div>
                
                <!-- Body Panel with enhanced background visibility -->
                <div class="card-body" style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);"> <!-- White background with shadow -->
                    <!-- Foto Profil dan Nama -->
                    <div class="row align-items-center mb-3">
                        <!-- Foto Profil -->
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('images/' . auth()->user()->avatar) }}" alt="Profile Picture" 
                                class="rounded-circle img-thumbnail" 
                                style="width: 250px; height: 250px; object-fit: cover; border: 3px solid #6b83a8;">
                        </div>
                        
                        <!-- Nama dan Level -->
                        <div class="col-md-8">
                            <h5 class="font-weight-bold" style="color: #34495e; margin-top: 0;">{{ auth()->user()->nama }}</h5>
                            <p class="text-muted" style="font-size: 16px; margin-top: 5px;">{{ auth()->user()->level->level_nama }}</p>
                        </div>

                        <!-- Tombol Ubah Foto -->
                        <div class="col-md-12 text-right mt-3">
                            <a href="{{ route('profile.update.images') }}" class="btn" style="background-color: #6b83a8; color: white; border: none;">Ubah Foto</a>
                        </div>
                    </div>
                    
                    <!-- Stylish Divider -->
                    <div class="col-12">
                        <hr class="styled-divider">
                    </div>
                     
                    <!-- Profil Identitas -->
                    <div class="row">
                        <!-- Identitas Kiri -->
                        <div class="col-md-6">
                            <h5 class="font-weight-bold" style="color: #34495e;">Identitas</h5>
                            <table class="table table-borderless" style="margin-bottom: 0;">
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; width: 120px;"><i class="fas fa-user-shield"></i> Level</td>
                                    <td style="padding-left: 5px; padding-right: 5px;">: {{ auth()->user()->level->level_nama }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; width: 120px;"><i class="fas fa-user"></i> Nama</td>
                                    <td style="padding-left: 5px; padding-right: 5px;">: {{ auth()->user()->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; width: 120px;"><i class="fas fa-school"></i> Jurusan</td>
                                    <td style="padding-left: 5px; padding-right: 5px;">: {{ auth()->user()->jurusan }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; width: 120px;"><i class="fas fa-id-card"></i> NIM/NIK/NIP</td>
                                    <td style="padding-left: 5px; padding-right: 5px;">: {{ auth()->user()->ni }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Identitas Kanan -->
                        <div class="col-md-6">
                            <h5 class="font-weight-bold" style="color: #34495e;">Akun</h5>
                            <table class="table table-borderless" style="margin-bottom: 0;">
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; width: 120px;"><i class="fas fa-user-circle"></i> Username</td>
                                    <td style="padding-left: 5px; padding-right: 5px;">: {{ auth()->user()->username }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; width: 120px;"><i class="fas fa-lock"></i> Password</td>
                                    <td style="padding-left: 5px; padding-right: 5px;">: ********</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Tombol Edit Full Width -->
                    <div class="text-center mt-4">
                        <a href="{{ route('profile.update') }}" class="btn" style="background-color: #6b83a8; color: white; border: none; width: 100%;">Ubah Profil dan Password</a> <!-- Full width button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    /* Stylish Divider */
    .styled-divider {
        border-top: 4px solid transparent;
        background-image: linear-gradient(to right, #6b83a8, #ecf0f1, #6b83a8);
        height: 4px;
        margin-top: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
