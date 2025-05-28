@extends('layouts.app')
@section('content')
    <h3 class="mb-4">Quản lý phòng</h3>
    <form method="GET" action="" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm phòng...">
            <button class="btn btn-primary" type="submit">Nút tìm kiếm</button>
        </div>
    </form>
    <div class="row">
        @foreach($rooms as $room)
            <div class="col-md-2 mb-4">
                <div class="card h-100">
                    <img src="{{ $room->image }}" class="card-img-top" alt="Hình ảnh phòng">
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $room->name }}</h6>
                        @php
                            $activeBooking = $room->bookings()->whereIn('status', ['checked_in', 'booked'])->latest()->first();
                        @endphp
                        @if($activeBooking)
                            <div class="mb-2">
                                <span class="badge bg-info">Mã đặt phòng: {{ $activeBooking->id }}</span>
                            </div>
                        @endif
                        <a href="{{ route('receptionist.rooms.show', $room->id) }}"
                            class="btn btn-outline-info btn-sm mt-2">Quản lý</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection