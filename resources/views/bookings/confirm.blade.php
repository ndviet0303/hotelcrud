@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Phiếu xác nhận đặt phòng</h4>
                </div>
                <div class="card-body">
                    <p><strong>Phòng:</strong> {{ $room->name }}</p>
                    <p><strong>Loại phòng:</strong> {{ $room->type }}</p>
                    <p><strong>Giá:</strong> {{ number_format($room->price, 0, ',', '.') }}đ/đêm</p>
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <div class="mb-3">
                            <label for="check_in" class="form-label">Ngày nhận phòng</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" required>
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">Ngày trả phòng</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection