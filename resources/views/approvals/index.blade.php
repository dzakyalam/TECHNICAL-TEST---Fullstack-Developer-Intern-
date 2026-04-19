@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-title">Daftar Approval</h3>
</div>

<div class="card toolbar-card mb-3">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Cari Approval</label>
                <input type="text" id="approvalSearch" class="form-control" placeholder="Cari approver, booking, kendaraan...">
            </div>
            <div class="col-md-4">
                <label class="form-label">Filter Status</label>
                <select id="approvalStatusFilter" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($approvals->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" id="approvalTable">
                    <thead class="table-dark">
                        <tr>
                            <th>Booking</th>
                            <th>Approver</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvals as $approval)
                            <tr data-status="{{ strtolower($approval->status) }}">
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
                                <td>
                                    <form action="/approvals/{{ $approval->id }}/approve" method="POST" class="d-inline approval-form" data-action-text="approve">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>

                                    <form action="/approvals/{{ $approval->id }}/reject" method="POST" class="d-inline approval-form" data-action-text="reject">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="approvalNoResults" class="empty-state d-none">
                <div style="font-size:40px;">🔍</div>
                <h5>Data approval tidak ditemukan</h5>
                <p class="mb-0">Coba ubah kata kunci atau filter status.</p>
            </div>
        @else
            <div class="empty-state">
                <div style="font-size:40px;">✅</div>
                <h5>Belum ada approval</h5>
                <p>Data approval akan tampil di sini ketika booking dibuat.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    const approvalSearch = document.getElementById('approvalSearch');
    const approvalStatusFilter = document.getElementById('approvalStatusFilter');
    const approvalTable = document.getElementById('approvalTable');
    const approvalNoResults = document.getElementById('approvalNoResults');

    function filterApprovalTable() {
        if (!approvalTable) return;

        const rows = approvalTable.querySelectorAll('tbody tr');
        const keyword = approvalSearch.value.toLowerCase();
        const status = approvalStatusFilter.value.toLowerCase();
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

        if (approvalNoResults) {
            approvalNoResults.classList.toggle('d-none', visibleCount > 0);
        }
    }

    if (approvalSearch) approvalSearch.addEventListener('input', filterApprovalTable);
    if (approvalStatusFilter) approvalStatusFilter.addEventListener('change', filterApprovalTable);

    document.querySelectorAll('.approval-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const actionText = form.getAttribute('data-action-text');
            const ok = confirm(`Yakin ingin ${actionText} approval ini?`);
            if (!ok) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection