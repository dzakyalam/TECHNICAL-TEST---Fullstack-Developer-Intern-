@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Daftar Booking</h3>
    <div class="d-flex gap-2">
        <a href="/reports/export" class="btn btn-success">Export Excel</a>
        <a href="/bookings/create" class="btn btn-primary">Tambah Booking</a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kendaraan</th>
                        <th>Driver</th>
                        <th>Pemohon</th>
                        <th>Keperluan</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Status</th>
                        <th>Approval</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->vehicle->plate_number }} - {{ $booking->vehicle->name }}</td>
                            <td>{{ $booking->driver->name }}</td>
                            <td>{{ $booking->requester_name }}</td>
                            <td>{{ $booking->purpose }}</td>
                            <td>{{ $booking->origin }}</td>
                            <td>{{ $booking->destination }}</td>
                            <td>{{ $booking->start_time }}</td>
                            <td>{{ $booking->end_time }}</td>
                            <td>
                                @if ($booking->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($booking->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>
                                @foreach ($booking->approvals as $approval)
                                    <div class="small mb-1">
                                        <strong>Level {{ $approval->approval_level }}</strong> -
                                        {{ $approval->approver_name }}
                                        <span class="text-muted">({{ $approval->status }})</span>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Belum ada data booking</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection