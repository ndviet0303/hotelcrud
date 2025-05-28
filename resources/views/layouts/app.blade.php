<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li>
                    @auth
                        @if(Auth::user()->role === 'receptionist')
                            <li class="nav-item"><a class="nav-link" href="{{ route('receptionist.dashboard') }}">Trang chủ lễ
                                    tân</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('receptionist.rooms.index') }}">Quản lý
                                    phòng</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('receptionist.checkin') }}">Checkin</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="/rooms">Khách sạn</a></li>
                            <li class="nav-item"><a class="nav-link" href="/bookings/my">Đặt phòng của tôi</a></li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="/login">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register">Đăng ký</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="#">{{ Auth::user()->name }}</a></li>
                        <li class="nav-item" style="align-items: center; display: flex">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link p-0"
                                    style="border:none; background:none; cursor:pointer;">Đăng xuất</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>

</html>