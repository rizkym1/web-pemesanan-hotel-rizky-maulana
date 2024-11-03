<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pemesanan Hotel</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">HotelKu</div>
            <ul class="nav-links">
                <li><a href="#">Daftar</a></li>
            </ul>
        </div>
    </nav>

    <div class="background-image">
        <div class="login-container">
            <h1>Login</h1>
            <form action="{{ route('auth.verify') }}" method="post">
                @csrf
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Masuk</button>
            </form>
            <p>Belum punya akun? <a href="#">Daftar sekarang!</a></p>
        </div>
    </div>
</body>

</html>
