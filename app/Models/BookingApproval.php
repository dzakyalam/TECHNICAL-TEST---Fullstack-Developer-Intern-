<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingApproval extends Model
{
    protected $fillable = [
        'booking_id',
        'approver_name',
        'approval_level',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}