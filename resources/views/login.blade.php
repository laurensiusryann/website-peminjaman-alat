<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KampusPinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Left: Form -->
    <div class="w-full md:w-1/2 flex flex-col justify-center px-8 md:px-24 py-12 bg-white min-h-screen relative">
        <!-- Role Switcher -->
        <form id="roleForm" method="POST" action="{{ route('login') }}" class="absolute top-8 right-8 flex items-center gap-2 z-10">
            @csrf
            <input type="hidden" name="role" id="roleInput" value="user">
            <button type="button" id="userBtn" class="rounded-full w-10 h-10 flex items-center justify-center bg-blue-600 text-white text-xl border-2 border-blue-600 focus:outline-none" title="Login sebagai User">
                <i class="fa-solid fa-user"></i>
            </button>
            <button type="button" id="adminBtn" class="rounded-full w-10 h-10 flex items-center justify-center bg-gray-200 text-gray-600 text-xl border-2 border-gray-200 focus:outline-none" title="Login sebagai Admin">
                <i class="fa-solid fa-user-tie"></i>
            </button>
        </form>
        <h2 class="text-2xl font-bold text-center mb-2">Selamat Datang</h2>
        <h1 class="text-3xl font-bold text-center mb-4">KampusPinjam</h1>
        <p class="text-center text-gray-500 mb-8">Sistem Peminjaman Peralatan Kampus UKDC</p>
        @if(session('success'))
            <div class="mb-4 text-green-600 text-center">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-4 text-red-600 text-center">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="w-full max-w-md mx-auto" id="loginForm">
            @csrf
            <input type="hidden" name="role" id="roleInputMain" value="user">
            <input type="text" name="npm" placeholder="NPM" class="w-full mb-4 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            <input type="password" name="password" placeholder="Password" class="w-full mb-2 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:underline">Lupa Password?</a>
            </div>
            <button type="submit" class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800 transition">Masuk</button>
        </form>
        <div class="text-center mt-6">
            <span class="text-gray-600">Belum punya akun? </span>
            <a href="{{ route('register') }}" class="font-bold hover:underline">Buat Akun</a>
        </div>
    </div>
    <!-- Right: Image & Logo -->
    <div class="hidden md:flex w-1/2 relative items-center justify-center min-h-screen">
        <img src="{{ asset('images/storage-room.png') }}" alt="Gudang" class="absolute inset-0 w-full h-full object-cover opacity-70">
        <div class="relative z-10 flex flex-col items-center w-full">
            <div class="bg-white rounded-full w-40 h-40 flex items-center justify-center shadow-lg mb-4">
                <span class="text-5xl font-bold font-serif text-gray-800">KP</span>
            </div>
            <span class="text-xl font-semibold text-white drop-shadow-lg">KampusPinjam</span>
        </div>
    </div>
    <script>
        // Role switcher logic
        const userBtn = document.getElementById('userBtn');
        const adminBtn = document.getElementById('adminBtn');
        const roleInput = document.getElementById('roleInput');
        const roleInputMain = document.getElementById('roleInputMain');
        const loginForm = document.getElementById('loginForm');

        let selectedRole = 'user';

        function setRole(role) {
            selectedRole = role;
            roleInput.value = role;
            roleInputMain.value = role;
            if (role === 'user') {
                userBtn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                userBtn.classList.remove('bg-gray-200', 'text-gray-600', 'border-gray-200');
                adminBtn.classList.add('bg-gray-200', 'text-gray-600', 'border-gray-200');
                adminBtn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
            } else {
                adminBtn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                adminBtn.classList.remove('bg-gray-200', 'text-gray-600', 'border-gray-200');
                userBtn.classList.add('bg-gray-200', 'text-gray-600', 'border-gray-200');
                userBtn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
            }
        }

        userBtn.addEventListener('click', function(e) {
            e.preventDefault();
            setRole('user');
        });
        adminBtn.addEventListener('click', function(e) {
            e.preventDefault();
            setRole('admin');
        });

        // Set default role
        setRole('user');

        // Sync role on submit
        loginForm.addEventListener('submit', function() {
            roleInputMain.value = selectedRole;
        });
    </script>
</body>
</html>