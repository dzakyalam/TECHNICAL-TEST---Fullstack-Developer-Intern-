@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-title">Daftar Kendaraan</h3>
</div>

<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <form action="/vehicles" method="POST" class="row g-3">
            @csrf
            <div class="col-md-5">
                <label class="form-label">Plat Nomor</label>
                <input type="text" name="plate_number" class="form-control" placeholder="Contoh: N 1234 AB" required>
            </div>
            <div class="col-md-5">
                <label class="form-label">Nama Kendaraan</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Avanza" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($vehicles->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th width="80">No</th>
                            <th>Plat Nomor</th>
                            <th>Nama Kendaraan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vehicle->plate_number }}</td>
                                <td>{{ $vehicle->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div style="font-size:40px;">🚗</div>
                <h5>Belum ada kendaraan</h5>
                <p>Tambahkan data kendaraan terlebih dahulu.</p>
            </div>
        @endif
    </div>
</div>
@endsection