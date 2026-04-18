@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0">Form Booking Kendaraan</h4>
            </div>

            <div class="card-body p-4">
                <form action="/bookings" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kendaraan</label>
                            <select name="vehicle_id" class="form-select">
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->plate_number }} - {{ $vehicle->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Driver</label>
                            <select name="driver_id" class="form-select">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Pemohon</label>
                            <input type="text" name="requester_name" class="form-control" placeholder="Masukkan nama pemohon">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Keperluan</label>
                            <input type="text" name="purpose" class="form-control" placeholder="Masukkan keperluan">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Asal</label>
                            <input type="text" name="origin" class="form-control" placeholder="Masukkan asal">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tujuan</label>
                            <input type="text" name="destination" class="form-control" placeholder="Masukkan tujuan">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Mulai</label>
                            <input type="datetime-local" name="start_time" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Selesai</label>
                            <input type="datetime-local" name="end_time" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Approver Level 1</label>
                            <input type="text" name="approver_1" class="form-control" placeholder="Masukkan approver level 1">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Approver Level 2</label>
                            <input type="text" name="approver_2" class="form-control" placeholder="Masukkan approver level 2">
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="/bookings" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection