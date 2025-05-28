@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Checkin - Nhập mã đặt phòng</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('receptionist.checkin.confirm') }}">
                        <div class="mb-3">
                            <label for="booking_code" class="form-label">Mã đặt phòng</label>
                            <input type="text" class="form-control" id="booking_code" name="booking_code" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Check In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection