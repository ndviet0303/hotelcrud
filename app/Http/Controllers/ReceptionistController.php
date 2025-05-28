<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function rooms(Request $request)
    {
        $query = Room::query();

        // Tìm kiếm theo tên phòng, loại phòng
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('type', 'like', "%$search%");
            });
        }

        // Lọc theo trạng thái phòng
        if ($request->filled('status')) {
            $query->whereHas('bookings', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $rooms = $query->with([
            'bookings' => function ($q) {
                $q->whereIn('status', ['checked_in', 'booked'])
                    ->latest();
            }
        ])->get();

        return view('receptionist.rooms.index', compact('rooms'));
    }

    public function checkin(Request $request)
    {
        $query = Booking::query()->where('status', 'pending');

        // Tìm kiếm theo mã đặt phòng, tên khách hàng
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                    ->orWhere('customer_name', 'like', "%$search%")
                    ->orWhere('customer_username', 'like', "%$search%");
            });
        }

        $bookings = $query->with('room')->latest()->get();
        return view('receptionist.checkin', compact('bookings'));
    }
}