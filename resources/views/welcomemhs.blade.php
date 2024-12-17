@extends('layouts.template')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Akumulasi Data Kompen per Semester</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-light">
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
                            <td>{{ $semester }}</td>
                            <td>{{ $jamAlpha }} jam</td>
                            <td>{{ $jamKompen }} jam</td>
                            <td>{{ $sisaKompen }} jam</td>
                        </tr>
                    @endfor
                    <tr class="bg-light font-weight-bold">
                        <td>Total</td>
                        <td>{{ $totalJamAlpha }} jam</td>
                        <td>{{ $totalJamKompen }} jam</td>
                        <td>{{ $totalSisaKompen }} jam</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
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
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Jam Kompen',
                    data: data.map(item => item.total_jam_kompen),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Jam'
                    }
                }
            }
        }
    });
});
</script>
@endpush
