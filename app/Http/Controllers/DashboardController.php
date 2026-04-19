<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\Vehicle;
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

        $totalVehicles = Vehicle::count();
        $totalDrivers = Driver::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $approvedBookings = Booking::where('status', 'approved')->count();
        $rejectedBookings = Booking::where('status', 'rejected')->count();

        return view('dashboard.index', compact(
            'usagePerVehicle',
            'bookingStatus',
            'totalVehicles',
            'totalDrivers',
            'totalBookings',
            'pendingBookings',
            'approvedBookings',
            'rejectedBookings'
        ));
    }
}