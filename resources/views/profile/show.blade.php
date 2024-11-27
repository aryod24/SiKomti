@extends('layouts.template')

@section('content')
<div class="container" style="padding: 120px;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8"> 
            <div class="card" style="background-color: #7c93b8; border-radius: 10px;">
                <h2 class="font-weight-bold text-center" style="color: #ffffff; padding-top: 20px; padding-left: 20px; padding-right: 20px;">Profile Anda</h2>
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <!-- Foto Profil -->
                        <div class="profile-picture text-center mb-4 mb-md-0" style="flex: 1; max-width: 200px;">
                            <img src="{{ asset('images/' . auth()->user()->avatar) }}" alt="Profile Picture" 
                                class="rounded-circle" 
                                style="width: 180px; height: 180px; object-fit: cover; border: 2px solid #000;">
                            <div class="mt-3">
                                <a href="{{ route('profile.update.images') }}" class="btn btn-secondary btn-sm" style="background-color:#2C3E50; border-color: #2C3E50;">Ubah Foto</a>
                            </div>
                        </div>

                        <!-- Detail Profil -->
                        <div class="profile-details ml-md-4 mt-4 mt-md-0" style="flex: 2; max-width: 100%; overflow: hidden;">
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
                            <a href="{{ route('profile.update') }}" class="btn btn-primary btn-sm" style="background-color: #2C3E50; border-color: #2C3E50;">Ubah Profile dan Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
