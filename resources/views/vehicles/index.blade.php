@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white py-3">
        <h4 class="mb-0">Daftar Kendaraan</h4>
    </div>

    <div class="card-body">
        <form action="/vehicles" method="POST" class="row g-3 mb-4">
            @csrf
            <div class="col-md-5">
                <input type="text" name="plate_number" class="form-control" placeholder="Plat nomor">
            </div>
            <div class="col-md-5">
                <input type="text" name="name" class="form-control" placeholder="Nama kendaraan">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Simpan</button>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Nama Kendaraan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vehicle->plate_number }}</td>
                        <td>{{ $vehicle->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data kendaraan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection