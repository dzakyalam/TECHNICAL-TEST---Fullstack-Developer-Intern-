<?php

namespace App\Http\Controllers;

use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function export()
    {
        return Excel::download(new BookingExport, 'laporan-booking.xlsx');
    }
}