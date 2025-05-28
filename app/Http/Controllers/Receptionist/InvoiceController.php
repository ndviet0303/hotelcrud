<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class InvoiceController extends Controller
{
    public function show($bookingId)
    {
        $booking = Booking::with('room')->findOrFail($bookingId);
        // Giả lập hóa đơn
        $invoice = [
            'room' => $booking->room->price ?? 0,
            'service' => 100000, // giả lập dịch vụ
            'extra' => 50000, // phụ thu giả lập
            'total' => ($booking->room->price ?? 0) + 100000 + 50000,
        ];
        return view('receptionist.invoice', compact('booking', 'invoice'));
    }

    public function process($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->status = 'checked_out';
        $booking->save();
        return redirect()->route('receptionist.dashboard')->with('success', 'Checkout thành công!');
    }
}
