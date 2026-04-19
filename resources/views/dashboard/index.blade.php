@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="page-title">Dashboard Pemakaian Kendaraan</h3>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="text-muted small">Total Kendaraan</div>
                <h2 class="mb-0">{{ $totalVehicles }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="text-muted small">Total Driver</div>
                <h2 class="mb-0">{{ $totalDrivers }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="text-muted small">Total Booking</div>
                <h2 class="mb-0">{{ $totalBookings }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="text-muted small">Pending Booking</div>
                <h2 class="mb-0 text-warning">{{ $pendingBookings }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="text-muted small">Approved</div>
                <h3 class="mb-0 text-success">{{ $approvedBookings }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="text-muted small">Pending</div>
                <h3 class="mb-0 text-warning">{{ $pendingBookings }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="text-muted small">Rejected</div>
                <h3 class="mb-0 text-danger">{{ $rejectedBookings }}</h3>
            </div>
        </div>
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
@endsection

@section('scripts')
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
                data: vehicleTotals,
                borderWidth: 1
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