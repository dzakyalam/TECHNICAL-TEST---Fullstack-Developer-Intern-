@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h3 class="fw-bold">Dashboard Pemakaian Kendaraan</h3>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                Grafik Pemakaian per Kendaraan
            </div>
            <div class="card-body">
                <canvas id="vehicleChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white">
                Grafik Status Booking
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const vehicleLabels = @json($usagePerVehicle->pluck('name'));
    const vehicleTotals = @json($usagePerVehicle->pluck('total'));

    new Chart(document.getElementById('vehicleChart'), {
        type: 'bar',
        data: {
            labels: vehicleLabels,
            datasets: [{
                label: 'Jumlah Pemakaian',
                data: vehicleTotals
            }]
        }
    });

    const statusLabels = @json($bookingStatus->pluck('status'));
    const statusTotals = @json($bookingStatus->pluck('total'));

    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Jumlah Status',
                data: statusTotals
            }]
        }
    });
</script>
@endsection