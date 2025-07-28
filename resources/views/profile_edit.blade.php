<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | KampusPinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .bg-birutua { background-color: #23253A !important; }
        .bg-birutua2 { background-color: #181A23 !important; }
        .border-birutua2 { border-color: #181A23 !important; }
        .border-birutua { border-color: #23253A !important; }
    </style>
</head>
<body class="bg-white min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-72 bg-birutua min-h-screen flex flex-col">
            <div class="px-8 py-6 border-b border-birutua2">
                <h1 class="text-2xl font-bold text-white">KampusPinjam</h1>
            </div>
            <nav class="flex-1 py-4 flex flex-col gap-2">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard_user') }}" class="flex items-center px-6 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
                            <i class="fa-solid fa-display mr-3 text-blue-600 text-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('data_barang') }}" class="flex items-center px-6 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
                            <i class="fa-solid fa-box mr-3 text-orange-400 text-lg"></i>
                            <span>Data Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transaksi_peminjaman') }}" class="flex items-center px-6 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
                            <i class="fa-solid fa-coins mr-3 text-orange-400 text-lg"></i>
                            <span>Transaksi Peminjaman</span>
                        </a>
                    </li>
                </ul>
                <div class="border-b border-birutua2 my-4"></div>
                </ul>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 flex flex-col bg-white">
            <div class="bg-birutua">
                <header class="flex items-center justify-between px-8 py-6">
                    <div></div>
                    <div class="flex items-center space-x-6 relative">
                        <!-- Notification Bell & Dropdown -->
                        <div class="relative inline-block">
                            <button id="notifBtn" class="relative focus:outline-none text-gray-400 text-xl">
                                <i class="fa-regular fa-bell"></i>
                                @php $notifCount = $notifs->count(); @endphp
                                @if($notifCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $notifCount }}</span>
                                @endif
                            </button>
                            <div id="notifMenu" class="absolute right-0 mt-2 w-72 bg-white rounded shadow-lg z-30 hidden">
                                <div class="px-4 py-3 border-b font-semibold">Notifikasi</div>
                                <ul class="py-2 px-4 text-sm text-gray-800 space-y-2 max-h-72 overflow-y-auto">
                                    @forelse($notifs as $notif)
                                        <li>
                                            <form action="{{ route('notifikasi.baca', $notif->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full text-left flex items-start gap-2 hover:bg-gray-100 p-2 rounded">
                                                    <span class="mt-1">
                                                        @if($notif->status == 'Disetujui')
                                                            <i class="fa-solid fa-circle-check text-green-500"></i>
                                                        @else
                                                            <i class="fa-solid fa-circle-xmark text-red-500"></i>
                                                        @endif
                                                    </span>
                                                    <div>
                                                        <div>
                                                            Peminjaman <b>{{ $notif->nama_barang }}</b>
                                                            <span class="font-semibold {{ $notif->status == 'Disetujui' ? 'text-green-600' : 'text-red-600' }}">
                                                                {{ $notif->status }}
                                                            </span>
                                                        </div>
                                                        <div class="text-xs text-gray-400">{{ $notif->updated_at->format('d M Y H:i') }}</div>
                                                        <div class="text-xs text-blue-500 underline">Lihat Transaksi</div>
                                                    </div>
                                                </button>
                                            </form>
                                        </li>
                                    @empty
                                        <li class="text-gray-400">Belum ada notifikasi.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <script>
                            // Toggle profile dropdown
                            const btn = document.getElementById('profileBtn');
                            const menu = document.getElementById('profileMenu');
                            document.addEventListener('click', function(e) {
                                if (btn && btn.contains(e.target)) {
                                    menu.classList.toggle('hidden');
                                } else if (menu) {
                                    menu.classList.add('hidden');
                                }
                            });

                            // Toggle notification dropdown
                            const notifBtn = document.getElementById('notifBtn');
                            const notifMenu = document.getElementById('notifMenu');
                            document.addEventListener('click', function(e) {
                                if (notifBtn && notifBtn.contains(e.target)) {
                                    notifMenu.classList.toggle('hidden');
                                } else if (notifMenu && !notifMenu.contains(e.target)) {
                                    notifMenu.classList.add('hidden');
                                }
                            });
                        </script>
                    </div>
                </header>
                <div class="px-8 pt-2 pb-8">
                    <div class="mb-4">
                        <input type="text" placeholder="Search" class="px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 w-64">
                    </div>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="bg-white text-blue-600 px-3 py-2 rounded font-semibold flex items-center shadow">
                            <i class="fa-solid fa-house mr-2"></i>
                            / Edit Profile
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex-1 px-8 pb-8 bg-white flex justify-center items-start">
                <div class="bg-white rounded shadow w-full max-w-xl mt-12 p-8">
                    <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-1">Full Name</label>
                            <input type="text" name="full_name" value="{{ old('full_name', $full_name) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>