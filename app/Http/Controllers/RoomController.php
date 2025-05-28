<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Room::query();

        // Lọc theo giá
        if ($request->filled('price')) {
            if ($request->price == 1) {
                $query->where('price', '<', 500000);
            } elseif ($request->price == 2) {
                $query->whereBetween('price', [500000, 1000000]);
            } elseif ($request->price == 3) {
                $query->where('price', '>', 1000000);
            }
        }

        // Lọc theo ngày
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        if ($checkIn && $checkOut) {
            $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->where(function ($q2) use ($checkIn, $checkOut) {
                    $q2->where('status', '!=', 'cancelled')
                        ->where(function ($q3) use ($checkIn, $checkOut) {
                            $q3->whereBetween('check_in', [$checkIn, $checkOut])
                                ->orWhereBetween('check_out', [$checkIn, $checkOut])
                                ->orWhere(function ($q4) use ($checkIn, $checkOut) {
                                    $q4->where('check_in', '<=', $checkIn)
                                        ->where('check_out', '>=', $checkOut);
                                });
                        });
                });
            });
        }

        // Tìm kiếm theo tên, loại phòng, mô tả
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('type', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        $rooms = $query->paginate(12);
        return view('rooms.index', compact('rooms'));
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
        return view('rooms.show', compact('room'));
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
}
