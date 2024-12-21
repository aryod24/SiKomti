@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-center" style="font-family: 'Montserrat', sans-serif; height: 100px;">
        <h3 class="card-title" style="font-size: 2rem; color: #415f8d;">Selamat datang di SiKomti</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Menampilkan data untuk level_id 1, 3, dan 4 -->
            @if (in_array(auth()->user()->level_id, [1, 3, 4]))
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Menampilkan Jumlah Kompen -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <div class="inner">
                                    <h3>{{ $jumlahKompen }}</h3>
                                    <p>Jumlah Kompen</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tasks"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Menampilkan Jumlah User -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background: linear-gradient(45deg, #28a745, #32CD32); color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <div class="inner">
                                    <h3>{{ $jumlahUser }}</h3>
                                    <p>Jumlah User</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Menampilkan Jumlah Kompen Selesai -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background: linear-gradient(45deg, #20c997, #17a2b8); color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <div class="inner">
                                    <h3>{{ $jumlahKompenSelesai }}</h3>
                                    <p>Jumlah Kompen Selesai</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Menampilkan Jumlah Bidang Kompetensi -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background: linear-gradient(45deg, #ffc107, #ffdd57); color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <div class="inner">
                                    <h3>{{ $jumlahKompentensi }}</h3>
                                    <p>Jumlah Bidang Kompetensi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-th"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Menampilkan Jumlah Mahasiswa Kompen -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background: linear-gradient(45deg, #ff4757, #ff6b81); color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <div class="inner">
                                    <h3>{{ $jumlahMahasiswaKompen }}</h3>
                                    <p>Jumlah Mahasiswa Kompen</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Menampilkan Jumlah Jenis Kompen -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background: linear-gradient(45deg, #6c757d, #adb5bd); color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <div class="inner">
                                    <h3>{{ $jumlahJenisKompen }}</h3>
                                    <p>Jumlah Jenis Kompen</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Chart section -->
                    <div class="col-lg-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Grafik Data Kompen</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" width="1200" height="500"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Kompen'],
            datasets: [
                {
                    label: 'Jumlah Kompen Selesai',
                    data: [{{ $jumlahKompenSelesai }}],
                    backgroundColor: 'rgba(28, 200, 138, 0.6)',
                    borderColor: 'rgba(28, 200, 138, 1)',
                    borderWidth: 2,
                },
                {
                    label: 'Jumlah Kompen',
                    data: [{{ $jumlahKompen }}],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
