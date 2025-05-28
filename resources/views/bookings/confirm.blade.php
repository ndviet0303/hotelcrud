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
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <div class="mb-3">
                            <label for="check_in" class="form-label">Ngày nhận phòng</label>
                            <input type="date" class="form-control @error('check_in') is-invalid @enderror" id="check_in"
                                name="check_in" value="{{ old('check_in') }}" required>
                            @error('check_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">Ngày trả phòng</label>
                            <input type="date" class="form-control @error('check_out') is-invalid @enderror" id="check_out"
                                name="check_out" value="{{ old('check_out') }}" required>
                            @error('check_out')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Xác nhận đặt phòng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection