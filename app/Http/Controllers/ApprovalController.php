<?php

namespace App\Http\Controllers;

use App\Models\BookingApproval;

class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = BookingApproval::with('booking.vehicle', 'booking.driver')->get();
        return view('approvals.index', compact('approvals'));
    }

    public function approve($id)
    {
        $approval = BookingApproval::findOrFail($id);
        $approval->status = 'approved';
        $approval->save();

        $booking = $approval->booking;
        $pendingCount = $booking->approvals()->where('status', 'pending')->count();
        $rejectedCount = $booking->approvals()->where('status', 'rejected')->count();

        if ($rejectedCount > 0) {
            $booking->status = 'rejected';
        } elseif ($pendingCount == 0) {
            $booking->status = 'approved';
        } else {
            $booking->status = 'pending';
        }

        $booking->save();

        return redirect('/approvals');
    }

    public function reject($id)
    {
        $approval = BookingApproval::findOrFail($id);
        $approval->status = 'rejected';
        $approval->save();

        $booking = $approval->booking;
        $booking->status = 'rejected';
        $booking->save();

        return redirect('/approvals');
    }
}