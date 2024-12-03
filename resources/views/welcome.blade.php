@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Selamat datang di SiKomti</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Menampilkan Jumlah Kompen -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jumlahKompen }}</h3>
                        <p>Jumlah Kompen</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Menampilkan Jumlah Kompen Selesai -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $jumlahKompenSelesai }}</h3>
                        <p>Jumlah Kompen Selesai</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Menampilkan Jumlah User -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $jumlahUser }}</h3>
                        <p>Jumlah User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Menampilkan Jumlah Bidang Kompetensi -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $jumlahKompentensi }}</h3>
                        <p>Jumlah Bidang Kompetensi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Menampilkan Jumlah Mahasiswa Kompen -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $jumlahMahasiswaKompen }}</h3>
                        <p>Jumlah Mahasiswa Kompen</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Menampilkan Jumlah Jenis Kompen -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $jumlahJenisKompen }}</h3>
                        <p>Jumlah Jenis Kompen</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Data Chart section moved below the info boxes -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Chart</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('css')
<!-- Include any additional CSS files here -->
<link rel="stylesheet" href="{{ asset('path/to/adminlte.min.css') }}">
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    console.log("Chart.js loaded");
     // Assuming you have these variables available from your backend
  var jumlahKompen = {{ $jumlahKompen }}; // Total compensations
  var jumlahKompenSelesai = {{ $jumlahKompenSelesai }}; // Completed compensations
  
  // Create a canvas context for the chart
  var ctx = document.getElementById('myChart').getContext('2d');
  
  // Create the bar chart with two bars
  var myChart = new Chart(ctx, {
      type: 'bar', // Bar chart type
      data: {
          labels: ['Kompen'], // Label for the x-axis, only one value for both bars
          datasets: [
              {
                  label: 'Jumlah Kompen Selesai', // First bar for completed compensations
                  data: [jumlahKompenSelesai], // Data point for completed compensations
                  backgroundColor: 'rgba(28, 200, 138, 0.2)', // Light green background color
                  borderColor: 'rgba(28, 200, 138, 1)', // Green border color
                  borderWidth: 2,
              },
              {
                  label: 'Jumlah Kompen', // Second bar for total compensations
                  data: [jumlahKompen], // Data point for total compensations
                  backgroundColor: 'rgba(54, 162, 235, 0.2)', // Light blue background color
                  borderColor: 'rgba(54, 162, 235, 1)', // Blue border color
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
                      stepSize: 1, // Set the step size to ensure no fractional numbers are displayed
                      precision: 0 // This ensures that no decimals are shown
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
