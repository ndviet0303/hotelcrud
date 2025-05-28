<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $ids = collect(explode(',', $search))->map(fn($id) => trim($id))->filter()->all();

            $bookings = Booking::with('room')
                ->whereIn('id', $ids)
                ->get();
        } else {
            // Lấy các booking đang checked_in hoặc booked
            $bookings = Booking::with('room')
                ->whereIn('status', ['checked_in', 'booked'])
                ->get();

        }
        return view('receptionist.rooms', compact('bookings'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('receptionist.room_detail', compact('room'));
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

    public function storeService(Request $request, Room $room)
    {
        // Ghi nhận dịch vụ (giả lập)
        // Thực tế sẽ lưu vào bảng dịch vụ, ở đây chỉ thông báo
        return back()->with('success', 'Đã ghi nhận dịch vụ cho phòng!');
    }

    public function checkout(Room $room)
    {
        // Tìm booking đang active của phòng này
        $booking = Booking::where('room_id', $room->id)
            ->where('status', 'checked_in')
            ->latest()
            ->first();
        if (!$booking) {
            return back()->with('error', 'Không tìm thấy booking đang hoạt động!');
        }
        // Redirect sang trang hóa đơn
        return redirect()->route('receptionist.invoice', $booking->id);
    }
}
