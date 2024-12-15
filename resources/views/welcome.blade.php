@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h3 class="card-title" style="color: #415f8d; font-size: 36px; font-weight: bold;">Selamat datang di SiKomti</h3>
    </div>
    <div class="card-body">
        <!-- Section for the boxes -->
        <div class="row">
            <!-- Box 1: Kompen -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="small-box" style="background: linear-gradient(to right, #4e73df, #224abe); color: #fff;">
                    <div class="inner">
                        <h3>{{ $jumlahKompen }}</h3>
                        <p>Jumlah Kompen</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
            </div>
        
            <!-- Box 2: User -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="small-box" style="background: linear-gradient(to right, #1cc88a, #17a673); color: #fff;">
                    <div class="inner">
                        <h3>{{ $jumlahUser }}</h3>
                        <p>Jumlah User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        
            <!-- Box 3: Kompen Selesai -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="small-box" style="background: linear-gradient(to right, #36b9cc, #2c9faf); color: #fff;">
                    <div class="inner">
                        <h3>{{ $jumlahKompenSelesai }}</h3>
                        <p>Jumlah Kompen Selesai</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        
            <!-- Box 4: Kompetensi -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="small-box" style="background: linear-gradient(to right, #f6c23e, #d6a121); color: #fff;">
                    <div class="inner">
                        <h3>{{ $jumlahKompentensi }}</h3>
                        <p>Jumlah Bidang Kompetensi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th"></i>
                    </div>
                </div>
            </div>
        
            <!-- Box 5: Mahasiswa Kompen -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="small-box" style="background: linear-gradient(to right, #e74a3b, #c0392b); color: #fff;">
                    <div class="inner">
                        <h3>{{ $jumlahMahasiswaKompen }}</h3>
                        <p>Jumlah Mahasiswa Kompen</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        
            <!-- Box 6: Jenis Kompen -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="small-box" style="background: linear-gradient(to right, #858796, #636870); color: #fff;">
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

        <!-- Section for the chart -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Chart</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="700" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('path/to/adminlte.min.css') }}">
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    console.log("Chart.js loaded");

    // Assuming you have these variables available from your backend
    var jumlahKompen = {{ $jumlahKompen }};
    var jumlahKompenSelesai = {{ $jumlahKompenSelesai }};

    // Create a canvas context for the chart
    var ctx = document.getElementById('myChart').getContext('2d');

    // Create the bar chart with two bars
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Kompen'],
            datasets: [
                {
                    label: 'Jumlah Kompen Selesai',
                    data: [jumlahKompenSelesai],
                    backgroundColor: 'rgba(28, 200, 138, 0.2)',
                    borderColor: 'rgba(28, 200, 138, 1)',
                    borderWidth: 2,
                },
                {
                    label: 'Jumlah Kompen',
                    data: [jumlahKompen],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    },
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Status Kompen'
                    }
                }
            }
        }
    });
</script>
@endpush
