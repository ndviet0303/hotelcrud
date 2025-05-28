@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $room->image }}" class="img-fluid mb-3" alt="Hình ảnh phòng">
            {{-- Đánh giá (placeholder) --}}
            <div class="mb-2">
                <strong>Đánh giá:</strong> ⭐⭐⭐⭐⭐
            </div>
        </div>
        <div class="col-md-6">
            <h3>{{ $room->name }}</h3>
            <p><strong>Loại phòng:</strong> {{ $room->type }}</p>
            <p><strong>Sức chứa:</strong> {{ $room->capacity }} người</p>
            <p><strong>Mô tả:</strong> {{ $room->description }}</p>
            <p class="fw-bold text-danger"><strong>Giá thành:</strong> {{ number_format($room->price, 0, ',', '.') }}đ/đêm
            </p>
            <form method="GET" action="{{ route('bookings.confirm', $room->id) }}">
                <button type="submit" class="btn btn-success">Đặt phòng</button>
            </form>
        </div>
    </div>
@endsection