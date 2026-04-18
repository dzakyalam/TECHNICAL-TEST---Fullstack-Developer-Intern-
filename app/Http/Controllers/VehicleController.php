<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required',
            'name' => 'required',
        ]);

        Vehicle::create([
            'plate_number' => $request->plate_number,
            'name' => $request->name,
        ]);

        return redirect('/vehicles');
    }
}