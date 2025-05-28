@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Phiếu đặt phòng</h4>
                </div>
                <div class="card-body">
                    <p><strong>Mã đặt phòng:</strong> {{ $booking->id ?? '...' }}</p>
                    <p><strong>Khách hàng:</strong> {{ $booking->customer_name ?? '...' }}</p>
                    <p><strong>Phòng:</strong> {{ $booking->room->name ?? '...' }}</p>
                    <p><strong>Ngày nhận:</strong> {{ $booking->check_in ?? '...' }}</p>
                    <p><strong>Ngày trả:</strong> {{ $booking->check_out ?? '...' }}</p>
                    <form method="POST" action="{{ route('receptionist.checkin.process', $booking->id ?? 0) }}">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection