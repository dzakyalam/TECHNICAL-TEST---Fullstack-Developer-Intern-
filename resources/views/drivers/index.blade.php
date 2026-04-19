@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-title">Daftar Driver</h3>
</div>

<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <form action="/drivers" method="POST" class="row g-3">
            @csrf
            <div class="col-md-5">
                <label class="form-label">Nama Driver</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama driver" required>
            </div>
            <div class="col-md-5">
                <label class="form-label">No HP</label>
                <input type="text" name="phone" class="form-control" placeholder="Masukkan nomor HP">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($drivers->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th width="80">No</th>
                            <th>Nama Driver</th>
                            <th>No HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drivers as $driver)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div style="font-size:40px;">🧑‍✈️</div>
                <h5>Belum ada driver</h5>
                <p>Tambahkan data driver terlebih dahulu.</p>
            </div>
        @endif
    </div>
</div>
@endsection