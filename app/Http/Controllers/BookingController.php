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
        $data['customer_name'] = Auth::user()->name;
        $data['customer_username'] = Auth::user()->username;
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';
        $booking = Booking::create($data);
        return redirect()->route('bookings.my')->with('success', 'Đặt phòng thành công! Mã Phòng Đặt Phòng: ' . $booking['id']);
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
}
