<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingApproval;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['vehicle', 'driver', 'approvals'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('bookings.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required',
            'driver_id' => 'required',
            'requester_name' => 'required',
            'purpose' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'approver_1' => 'required',
            'approver_2' => 'required',
        ]);

        $booking = Booking::create([
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'requester_name' => $request->requester_name,
            'purpose' => $request->purpose,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending',
        ]);

        BookingApproval::create([
            'booking_id' => $booking->id,
            'approver_name' => $request->approver_1,
            'approval_level' => 1,
            'status' => 'pending',
        ]);

        BookingApproval::create([
            'booking_id' => $booking->id,
            'approver_name' => $request->approver_2,
            'approval_level' => 2,
            'status' => 'pending',
        ]);

        return redirect('/bookings');
    }
}