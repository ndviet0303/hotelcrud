@extends('layouts.app')
@section('content')
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