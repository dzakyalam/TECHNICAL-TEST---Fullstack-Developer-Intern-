<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Booking::with(['vehicle', 'driver'])->get()->map(function ($booking) {
            return [
                'kendaraan' => $booking->vehicle->plate_number . ' - ' . $booking->vehicle->name,
                'driver' => $booking->driver->name,
                'pemohon' => $booking->requester_name,
                'keperluan' => $booking->purpose,
                'asal' => $booking->origin,
                'tujuan' => $booking->destination,
                'mulai' => $booking->start_time,
                'selesai' => $booking->end_time,
                'status' => $booking->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kendaraan',
            'Driver',
            'Pemohon',
            'Keperluan',
            'Asal',
            'Tujuan',
            'Mulai',
            'Selesai',
            'Status',
        ];
    }
}