@extends('layouts.template')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-center" style="font-family: 'Montserrat', sans-serif; height: 100px; background-color: #f8f9fa; border: none;">
        <h2 class="card-title" style="font-size: 2rem; color: #415f8d;">Selamat Datang di SiKomti</h2>
    </div>
</div>
<div class="card">
    <div class="card-header bg-gradient-primary text-white">
        <h3 class="card-title">Akumulasi Data Kompen per Semester</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-gradient-secondary text-white text-center">
                        <th>Semester</th>
                        <th>Total Jam Alpha</th>
                        <th>Total Jam Kompen</th>
                        <th>Sisa Jam Kompen</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalJamAlpha = 0;
                        $totalJamKompen = 0;
                        $totalSisaKompen = 0;
                    @endphp
                    @for ($semester = 1; $semester <= 8; $semester++)
                        @php
                            $semesterData = $akumulasiData->where('semester', $semester)->first();
                            $jamAlpha = $semesterData ? $semesterData->total_jam_alpha : 0;
                            $jamKompen = $semesterData ? $semesterData->total_jam_kompen : 0;
                            $sisaKompen = $jamAlpha - $jamKompen;
                            
                            $totalJamAlpha += $jamAlpha;
                            $totalJamKompen += $jamKompen;
                            $totalSisaKompen += $sisaKompen;
                        @endphp
                        <tr>
                            <td class="text-center"><strong>Semester {{ $semester }}</strong></td>
                            <td class="text-end">{{ number_format($jamAlpha) }} jam</td>
                            <td class="text-end">{{ number_format($jamKompen) }} jam</td>
                            <td class="text-end {{ $sisaKompen < 0 ? 'text-danger' : 'text-success' }}">
                                <i class="fas {{ $sisaKompen < 0 ? 'fa-times-circle' : 'fa-check-circle' }}"></i> 
                                {{ number_format($sisaKompen) }} jam
                            </td>
                        </tr>
                    @endfor
                    <tr class="bg-gradient-light font-weight-bold text-center">
                        <td>Total</td>
                        <td class="text-end">{{ number_format($totalJamAlpha) }} jam</td>
                        <td class="text-end">{{ number_format($totalJamKompen) }} jam</td>
                        <td class="text-end">{{ number_format($totalSisaKompen) }} jam</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-gradient-success text-white">
        <h3 class="card-title">Grafik Akumulasi Kompen</h3>
    </div>
    <div class="card-body">
        <canvas id="kompenChart" width="1200" height="400"></canvas>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('kompenChart').getContext('2d');
    const data = @json($akumulasiData);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => 'Semester ' + item.semester),
            datasets: [
                {
                    label: 'Jam Alpha',
                    data: data.map(item => item.total_jam_alpha),
                    backgroundColor: 'rgba(255, 99, 132, 0.6)', // Red with transparency
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Jam Kompen',
                    data: data.map(item => item.total_jam_kompen),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue with transparency
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                        color: '#333'
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#333',
                        font: {
                            size: 12
                        }
                    },
                    title: {
                        display: true,
                        text: 'Semester',
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#333'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333',
                        font: {
                            size: 12
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Jam',
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#333'
                    }
                }
            }
        }
    });
});
</script>
@endpush