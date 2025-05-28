@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Hóa đơn thanh toán</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-4">
                        <tr>
                            <th>Hóa đơn phòng</th>
                            <td>{{ number_format($invoice['room'] ?? 0, 0, ',', '.') }}đ</td>
                            <th>Phụ thu</th>
                            <td>{{ number_format($invoice['extra'] ?? 0, 0, ',', '.') }}đ</td>
                        </tr>
                        <tr>
                            <th>Hóa đơn dịch vụ</th>
                            <td>{{ number_format($invoice['service'] ?? 0, 0, ',', '.') }}đ</td>
                            <th>Tổng tiền</th>
                            <td class="fw-bold text-danger">{{ number_format($invoice['total'] ?? 0, 0, ',', '.') }}đ</td>
                        </tr>
                    </table>
                    <form method="POST" action="{{ route('receptionist.checkout.process', $booking->id ?? 0) }}">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection