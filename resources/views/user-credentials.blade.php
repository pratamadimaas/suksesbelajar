<!DOCTYPE html>
<html>
<head>
    <title>Informasi Akun Anda</title>
</head>
<body>
    <h1>Selamat Datang, {{ $user->name }}!</h1>
    <p>Akun Anda telah berhasil dibuat. Berikut adalah detail untuk login:</p>
    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Silakan login ke aplikasi kami menggunakan kredensial di atas.</p>
    <p>Terima kasih,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>