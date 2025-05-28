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
        @foreach($bookings as $booking)
            <div class="col-md-2 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $booking->room->name }}</h6>
                        <div class="mb-2">
                            <span class="badge bg-info">Mã đặt phòng: {{ $booking->id }}</span>
                            <a href="{{ route('receptionist.rooms.show', $booking->room->id) }}"
                                class="btn btn-outline-info btn-sm mt-2">Quản lý</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection