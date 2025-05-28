@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('receptionist.rooms.index') }}" class="btn btn-link">&lt; Quay lại</a>
                </div>
                <div class="card-body">
                    <h4>{{ $room->name }}</h4>
                    <p><strong>Loại phòng:</strong> {{ $room->type }}</p>
                    <p><strong>Sức chứa:</strong> {{ $room->capacity }}</p>
                    <p><strong>Mô tả:</strong> {{ $room->description }}</p>
                    <p><strong>Trạng thái:</strong> {{ $room->status }}</p>
                    <form method="POST" action="{{ route('receptionist.services.store', $room->id) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning">Ghi nhận DV</button>
                    </form>
                    <form method="GET" action="{{ route('receptionist.checkout', $room->id) }}" class="d-inline">
                        <button type="submit" class="btn btn-danger">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection