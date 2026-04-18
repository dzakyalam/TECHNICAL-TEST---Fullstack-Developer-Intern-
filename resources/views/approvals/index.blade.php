@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white py-3">
        <h4 class="mb-0">Daftar Approval</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Booking</th>
                        <th>Approver</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($approvals as $approval)
                        <tr>
                            <td>
                                {{ $approval->booking->vehicle->plate_number }} -
                                {{ $approval->booking->vehicle->name }} /
                                {{ $approval->booking->requester_name }}
                            </td>
                            <td>{{ $approval->approver_name }}</td>
                            <td>{{ $approval->approval_level }}</td>
                            <td>
                                @if ($approval->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($approval->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <form action="/approvals/{{ $approval->id }}/approve" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>

                                <form action="/approvals/{{ $approval->id }}/reject" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data approval</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection