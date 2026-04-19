@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-title">Daftar Booking</h3>
    <div class="d-flex gap-2">
        <a href="/reports/export" class="btn btn-success">Export Excel</a>
        <a href="/bookings/create" class="btn btn-primary">Tambah Booking</a>
    </div>
</div>

<div class="card toolbar-card mb-3">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Cari Booking</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari kendaraan, driver, pemohon, tujuan...">
            </div>
            <div class="col-md-3">
                <label class="form-label">Filter Status</label>
                <select id="statusFilter" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="button" id="resetFilter" class="btn btn-outline-secondary w-100">Reset Filter</button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" id="bookingTable">
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
                        @foreach ($bookings as $booking)
                            <tr data-status="{{ strtolower($booking->status) }}">
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="noResults" class="empty-state d-none">
                <div style="font-size:40px;">🔍</div>
                <h5>Data tidak ditemukan</h5>
                <p class="mb-0">Coba ubah kata kunci pencarian atau filter status.</p>
            </div>
        @else
            <div class="empty-state">
                <div style="font-size:40px;">📄</div>
                <h5>Belum ada booking</h5>
                <p>Silakan tambahkan booking baru untuk mulai menggunakan sistem.</p>
                <a href="/bookings/create" class="btn btn-primary">Tambah Booking</a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const resetFilter = document.getElementById('resetFilter');
    const table = document.getElementById('bookingTable');
    const noResults = document.getElementById('noResults');

    function filterTable() {
        if (!table) return;

        const rows = table.querySelectorAll('tbody tr');
        const keyword = searchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const rowStatus = row.getAttribute('data-status');
            const matchKeyword = text.includes(keyword);
            const matchStatus = status === '' || rowStatus === status;

            if (matchKeyword && matchStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (noResults) {
            noResults.classList.toggle('d-none', visibleCount > 0);
        }
    }

    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (statusFilter) statusFilter.addEventListener('change', filterTable);

    if (resetFilter) {
        resetFilter.addEventListener('click', function () {
            searchInput.value = '';
            statusFilter.value = '';
            filterTable();
        });
    }
</script>
@endsection