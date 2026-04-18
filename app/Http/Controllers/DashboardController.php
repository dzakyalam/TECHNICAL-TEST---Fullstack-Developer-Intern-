<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $usagePerVehicle = Booking::select(
                'vehicles.name',
                DB::raw('COUNT(bookings.id) as total')
            )
            ->join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->groupBy('vehicles.name')
            ->get();

        $bookingStatus = Booking::select(
                'status',
                DB::raw('COUNT(id) as total')
            )
            ->groupBy('status')
            ->get();

        return view('dashboard.index', compact('usagePerVehicle', 'bookingStatus'));
    }
}