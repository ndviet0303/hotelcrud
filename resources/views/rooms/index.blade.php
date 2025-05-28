@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-md-3">
            <form method="GET" action="">
                <div class="mb-3">
                    <label for="price" class="form-label">Lọc theo giá</label>
                    <select class="form-select" id="price" name="price">
                        <option value="">Tất cả</option>
                        <option value="1" {{ request('price') == 1 ? 'selected' : '' }}>Dưới 500.000đ</option>
                        <option value="2" {{ request('price') == 2 ? 'selected' : '' }}>500.000đ - 1.000.000đ</option>
                        <option value="3" {{ request('price') == 3 ? 'selected' : '' }}>Trên 1.000.000đ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="check_in" class="form-label">Ngày nhận phòng</label>
                    <input type="date" class="form-control" id="check_in" name="check_in" value="{{ request('check_in') }}">
                </div>
                <div class="mb-3">
                    <label for="check_out" class="form-label">Ngày trả phòng</label>
                    <input type="date" class="form-control" id="check_out" name="check_out"
                        value="{{ request('check_out') }}">
                </div>
                <button type="submit" class="btn btn-outline-primary w-100">Lọc</button>
            </form>
        </div>
        <div class="col-md-9">
            <form method="GET" action="" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm khách sạn, loại phòng..."
                        value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </div>
            </form>
            <div class="row">
                {{-- Duyệt danh sách phòng --}}
                @foreach($rooms as $room)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ $room->image }}" class="card-img-top" alt="Hình ảnh phòng">
                            <div class="card-body">
                                <h5 class="card-title">{{ $room->name }}</h5>
                                <p class="card-text">{{ $room->type }} - Sức chứa: {{ $room->capacity }}</p>
                                <p class="card-text">{{ $room->description }}</p>
                                <p class="card-text fw-bold text-danger">{{ number_format($room->price, 0, ',', '.') }}đ/đêm</p>
                                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-outline-info">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $rooms->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection