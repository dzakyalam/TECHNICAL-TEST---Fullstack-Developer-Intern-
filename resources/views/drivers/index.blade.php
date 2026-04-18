@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white py-3">
        <h4 class="mb-0">Daftar Driver</h4>
    </div>

    <div class="card-body">
        <form action="/drivers" method="POST" class="row g-3 mb-4">
            @csrf
            <div class="col-md-5">
                <input type="text" name="name" class="form-control" placeholder="Nama driver">
            </div>
            <div class="col-md-5">
                <input type="text" name="phone" class="form-control" placeholder="No HP">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Simpan</button>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Driver</th>
                    <th>No HP</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($drivers as $driver)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->phone }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data driver</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection