<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);
        // Kiểm tra phòng còn trống không
        $exists = \App\Models\Booking::where('room_id', $data['room_id'])
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'checked_out')
            ->where(function (Booking $q) use ($data) {
                $q->whereBetween('check_in', [$data['check_in'], $data['check_out']])
                    ->orWhereBetween('check_out', [$data['check_in'], $data['check_out']])
                    ->orWhere(function ($q2) use ($data) {
                        $q2->where('check_in', '<=', $data['check_in'])
                            ->where('check_out', '>=', $data['check_out']);
                    });
            })
            ->exists();
        if ($exists) {
            return back()->withErrors(['check_in' => 'Phòng đã có người đặt trong khoảng thời gian này!'])->withInput();
        }
        $data['customer_name'] = Auth::user()->name;
        $data['customer_username'] = Auth::user()->username;
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';
        $booking = Booking::create($data);
        return redirect()->route('bookings.my')->with('success', 'Đặt phòng thành công! Mã đặt phòng của bạn là: ' . $booking->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function confirm(Room $room)
    {
        return view('bookings.confirm', compact('room'));
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('room')->latest()->get();
        return view('bookings.my_bookings', compact('bookings'));
    }

    public function checkin(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Không thể check-in phòng này!');
        }

        $booking->update(['status' => 'checked_in']);
        return redirect()->route('receptionist.rooms.index')->with('success', 'Check-in thành công!');
    }

    public function checkout(Booking $booking)
    {
        if ($booking->status !== 'checked_in') {
            return back()->with('error', 'Không thể check-out phòng này!');
        }

        $booking->update(['status' => 'checked_out']);
        return redirect()->route('receptionist.rooms.index')->with('success', 'Check-out thành công!');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Không thể hủy đặt phòng này!');
        }

        $booking->update(['status' => 'cancelled']);
        return redirect()->route('bookings.my')->with('success', 'Hủy đặt phòng thành công!');
    }
}
