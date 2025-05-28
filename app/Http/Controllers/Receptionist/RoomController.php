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
            $rooms = Room::with([
                'bookings' => function ($q) {
                    $q->whereIn('status', ['checked_in', 'booked']);
                }
            ])
                ->whereHas('bookings', function ($q) use ($search) {
                    $q->where('id', 'like', "%$search%");
                })
                ->paginate(12);
        } else {
            // Lấy các phòng có booking đang checked_in hoặc booked
            $rooms = Room::whereHas('bookings', function ($q) {
                $q->whereIn('status', ['checked_in', 'booked']);
            })->paginate(12);

        }
        return view('receptionist.rooms', compact('rooms'));
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
