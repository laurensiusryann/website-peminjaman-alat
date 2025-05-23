<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | KampusPinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Left: Form -->
    <div class="w-full md:w-1/2 flex flex-col justify-center px-8 md:px-24 py-12 bg-white min-h-screen">
        <h2 class="text-3xl font-bold text-center mb-2">Buat Akun</h2>
        <p class="text-center text-gray-500 mb-8">Sistem Peminjaman Peralatan Kampus UKDC</p>
        @if($errors->any())
            <div class="mb-4 text-red-600 text-center">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('register.post') }}" class="w-full max-w-md mx-auto">
            @csrf
            <input type="text" name="name" placeholder="Nama" class="w-full mb-4 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            <input type="text" name="npm" placeholder="NPM" class="w-full mb-4 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            <input type="password" name="password" placeholder="Password" class="w-full mb-4 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            <input type="password" name="password_confirmation" placeholder="RePassword" class="w-full mb-6 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            <button type="submit" class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800 transition">Daftar</button>
        </form>
        <div class="text-center mt-6">
            <span class="text-gray-600">Apakah kamu punya akun? </span>
            <a href="{{ route('login') }}" class="font-bold hover:underline">Masuk</a>
        </div>
    </div>
    <!-- Right: Image & Logo -->
    <div class="hidden md:flex w-1/2 relative items-center justify-center min-h-screen">
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Gudang" class="absolute inset-0 w-full h-full object-cover opacity-70">
        <div class="relative z-10 flex flex-col items-center w-full">
            <div class="bg-white rounded-full w-40 h-40 flex items-center justify-center shadow-lg mb-4">
                <span class="text-5xl font-bold font-serif text-gray-800">KP</span>
            </div>
            <span class="text-xl font-semibold text-white drop-shadow-lg">KampusPinjam</span>
        </div>
    </div>
</body>
</html>