@extends('layouts.template')

@section('content')
<div class="container-fluid" style="padding: 0; margin: 0;">
    <div class="row justify-content-center" style="min-height: 100vh; align-items: flex-start;">
        <div class="col-12">
            <div class="card" style="background-color: #ffffff; border-radius: 10px; width: 100%; margin-top: 20px;">
                <h2 class="font-weight-bold text-center" style="color: #2C3E50; padding: 20px;">Profile Anda</h2>
                <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-center" style="flex: 1;">

                    <!-- Foto Profil -->
                    <div class="profile-picture text-center mb-4 mb-md-0" style="flex: 1; max-width: 300px; margin-bottom: 20px;">
                        <img src="{{ asset('images/' . auth()->user()->avatar) }}" alt="Profile Picture" 
                            class="rounded-circle" 
                            style="width: 250px; height: 250px; object-fit: cover; border: 3px solid #2C3E50;">
                        <div class="mt-3">
                            <a href="{{ route('profile.update.images') }}" class="btn btn-secondary btn-sm" 
                                style="background-color: #2C3E50; border-color: #2C3E50;">Ubah Foto</a>
                        </div>
                    </div>

                    <!-- Detail Profil -->
                    <div class="profile-details text-left mt-4 mt-md-0 ml-md-4" style="flex: 2; width: 100%; margin-bottom: 20px;">
                        <table class="table" style="background: linear-gradient(90deg, #5c759c, #2C3E50); color: white;">
                            <tr>
                                <th style="border-bottom: 1px solid white;">Level</th>
                                <td style="border-bottom: 1px solid white;">: {{ auth()->user()->level->level_nama }}</td>
                            </tr>
                            <tr>
                                <th style="border-bottom: 1px solid white;">Nama</th>
                                <td style="border-bottom: 1px solid white;">: {{ auth()->user()->nama }}</td>
                            </tr>
                            <tr>
                                <th style="border-bottom: 1px solid white;">Jurusan</th>
                                <td style="border-bottom: 1px solid white;">: {{ auth()->user()->jurusan }}</td>
                            </tr>
                            <tr>
                                <th style="border-bottom: 1px solid white;">NIM/NIK/NIP</th>
                                <td style="border-bottom: 1px solid white;">: {{ auth()->user()->ni }}</td>
                            </tr>
                            <tr>
                                <th style="border-bottom: 1px solid white;">Username</th>
                                <td style="border-bottom: 1px solid white;">: {{ auth()->user()->username }}</td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>: ********</td>
                            </tr>
                        </table>
                        <div class="text-center mt-3">
                            <a href="{{ route('profile.update') }}" class="btn btn-primary btn-sm" 
                                style="background-color: #2C3E50; border-color: #2C3E50;">Ubah Profil dan Password</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection