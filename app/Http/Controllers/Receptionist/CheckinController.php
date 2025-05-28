<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class CheckinController extends Controller
{
    public function index()
    {
        return view('receptionist.checkin');
    }

    public function confirm(Request $request)
    {
        $booking = Booking::where('id', $request->booking_code)->with('room')->first();
        return view('receptionist.checkin_confirm', compact('booking'));
    }

    public function process($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->status = 'checked_in';
        $booking->save();
        return redirect()->route('receptionist.dashboard')->with('success', 'Checkin thành công!');
    }
}
