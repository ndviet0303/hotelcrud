<div class="row mb-3">
    <div class="col-md-8">
        <form method="GET" action="" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="search"
                    placeholder="Tìm kiếm theo tên phòng, loại phòng..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <form method="GET" action="" class="mb-3">
            <select class="form-select" name="status" onchange="this.form.submit()">
                <option value="">Tất cả trạng thái</option>
                <option value="checked_in" {{ request('status') == 'checked_in' ? 'selected' : '' }}>Đang sử dụng</option>
                <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Đã đặt</option>
            </select>
        </form>
    </div>
</div>

<div class="row">
    @foreach($rooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text">{{ $room->type }}</p>
                    @if($room->bookings->isNotEmpty())
                        <div class="alert alert-info">
                            <p class="mb-1">Mã đặt phòng: {{ $room->bookings->first()->id }}</p>
                            <p class="mb-1">Khách hàng: {{ $room->bookings->first()->customer_name }}</p>
                            <p class="mb-1">Trạng thái: {{ $room->bookings->first()->status }}</p>
                        </div>
                    @else
                        <div class="alert alert-success">Phòng trống</div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>