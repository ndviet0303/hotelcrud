@extends('layouts.app')
@section('content')
    <h3 class="mb-4">Đặt phòng của tôi</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã đặt phòng</th>
                <th>Phòng</th>
                <th>Loại phòng</th>
                <th>Ngày nhận</th>
                <th>Ngày trả</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->room->name }}</td>
                    <td>{{ $booking->room->type }}</td>
                    <td>{{ $booking->check_in }}</td>
                    <td>{{ $booking->check_out }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Bạn chưa có đặt phòng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection