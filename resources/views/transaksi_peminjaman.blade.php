<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Peminjaman | KampusPinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .bg-birutua { background-color: #23253A !important; }
        .bg-birutua2 { background-color: #181A23 !important; }
        .border-birutua2 { border-color: #181A23 !important; }
        .border-birutua { border-color: #23253A !important; }
        .status-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 6px; }
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
                        <a href="{{ route('transaksi_peminjaman') }}" class="flex items-center px-6 py-3 bg-birutua2 rounded text-white font-semibold border-l-4 border-orange-400">
                            <i class="fa-solid fa-coins mr-3 text-orange-400 text-lg"></i>
                            <span>Transaksi Peminjaman</span>
                        </a>
                    </li>
                </ul>
                <div class="border-b border-birutua2 my-4"></div>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 flex flex-col bg-white">
            <div class="bg-birutua">
                <header class="flex items-center justify-between px-8 py-6">
                    <div></div>
                    <div class="flex items-center space-x-6 relative">
                        <button class="text-gray-400 text-xl">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button id="profileBtn" class="flex items-center focus:outline-none">
                                <span class="bg-green-500 text-white font-bold rounded-full w-10 h-10 flex items-center justify-center">
                                    {{ strtoupper(substr($full_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $full_name)[1] ?? '', 0, 1)) }}
                                </span>
                                <span class="text-white ml-2">{{ $full_name }}</span>
                            </button>
                            <div id="profileMenu" class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg py-2 z-20 hidden">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">View Profile</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Edit Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
                                </form>
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
                        </script>
                    </div>
                </header>
                <div class="px-8 pt-2 pb-8">
                    <div class="mb-4">
                        <input type="text" id="searchInput" placeholder="Search" class="px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 w-64" autocomplete="off">
                    </div>
                    <div class="flex items-center space-x-2 mb-6">
                        <a href="{{ route('dashboard_user') }}" class="flex items-center bg-white text-blue-600 px-3 py-2 rounded font-semibold shadow hover:bg-blue-50 transition">
                            <i class="fa-solid fa-house mr-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-1 px-8 pb-8 bg-white">
                <div class="bg-white rounded shadow overflow-x-auto w-full max-w-5xl mx-auto mt-8">
                    <div class="flex items-center justify-between px-6 py-3 border-b font-semibold">
                        <span>Transaksi Peminjaman</span>
                        <button onclick="window.location='{{ route('pinjam_barang') }}'" type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold flex items-center">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Peminjaman
                        </button>
                    </div>
                    <table class="min-w-full text-sm" id="peminjamanTable">
                        <thead>
                            <tr class="border-b">
                                <th class="py-3 px-4 text-left">No</th>
                                <th class="py-3 px-4 text-left">Tanggal Pinjam</th>
                                <th class="py-3 px-4 text-left">Tanggal Kembali</th>
                                <th class="py-3 px-4 text-left">Nama Peminjam</th>
                                <th class="py-3 px-4 text-left">Nama Barang</th>
                                <th class="py-3 px-4 text-left">Jumlah</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $item)
                            <tr class="border-b">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $item->tanggal_pinjam }}</td>
                                <td class="py-3 px-4">{{ $item->tanggal_kembali }}</td>
                                <td class="py-3 px-4">{{ $item->nama_peminjam }}</td>
                                <td class="py-3 px-4">{{ $item->nama_barang }}</td>
                                <td class="py-3 px-4">{{ $item->jumlah }}</td>
                                <td class="py-3 px-4">
                                    @if($item->status == 'Menunggu Konfirmasi')
                                        <span class="status-dot" style="background:#fbbf24"></span>
                                        <span class="text-yellow-600 font-semibold">Menunggu Konfirmasi</span>
                                    @elseif($item->status == 'Disetujui')
                                        <span class="status-dot" style="background:#22c55e"></span>
                                        <span class="text-green-600 font-semibold">Disetujui</span>
                                    @elseif($item->status == 'Ditolak')
                                        <span class="status-dot" style="background:#ef4444"></span>
                                        <span class="text-red-600 font-semibold">Ditolak</span>
                                    @else
                                        <span class="status-dot" style="background:#a3a3a3"></span>
                                        <span class="text-gray-600 font-semibold">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('peminjaman.detail', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                    @if($item->status == 'Menunggu Konfirmasi')
                                        <form action="{{ route('peminjaman.cancel', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Batalkan peminjaman ini?')">Batalkan</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500">Belum ada data peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>
        // Client-side filter for transaksi_peminjaman, nomor tetap sesuai data asli
        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#peminjamanTable tbody tr');
            rows.forEach(row => {
                // Cek jika baris adalah baris data (bukan baris kosong)
                if (row.querySelectorAll('td').length === 8) {
                    const tglPinjam = row.children[1]?.textContent.toLowerCase() || '';
                    const tglKembali = row.children[2]?.textContent.toLowerCase() || '';
                    const namaPeminjam = row.children[3]?.textContent.toLowerCase() || '';
                    const namaBarang = row.children[4]?.textContent.toLowerCase() || '';
                    const status = row.children[6]?.textContent.toLowerCase() || '';
                    if (
                        filter === '' ||
                        tglPinjam.includes(filter) ||
                        tglKembali.includes(filter) ||
                        namaPeminjam.includes(filter) ||
                        namaBarang.includes(filter) ||
                        status.includes(filter)
                    ) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    </script>
</body>
</html>