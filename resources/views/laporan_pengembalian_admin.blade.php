<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengembalian | KampusPinjam</title>
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
                        <a href="{{ route('dashboard_admin') }}"
                           class="flex items-center px-6 py-3 hover:bg-birutua2 rounded text-white font-semibold transition">
                            <i class="fa-solid fa-display mr-3 text-blue-600 text-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('data_barang_admin') }}"
                           class="flex items-center px-6 py-3 hover:bg-birutua2 rounded text-white font-semibold transition">
                            <i class="fa-solid fa-box mr-3 text-orange-400 text-lg"></i>
                            <span>Data Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('data_peminjam') }}"
                           class="flex items-center px-6 py-3 hover:bg-birutua2 rounded text-white font-semibold transition">
                            <i class="fa-solid fa-users mr-3 text-orange-400 text-lg"></i>
                            <span>Data Peminjam</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transaksi_peminjaman_admin') }}"
                           class="flex items-center px-6 py-3 hover:bg-birutua2 rounded text-white font-semibold transition">
                            <i class="fa-solid fa-coins mr-3 text-orange-400 text-lg"></i>
                            <span>Transaksi Peminjaman</span>
                        </a>
                    </li>
                </ul>
                <div class="border-b border-birutua2 my-4"></div>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('laporan_peminjaman') }}"
                           class="flex items-center px-6 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
                            <i class="fa-solid fa-chart-line mr-3 text-blue-600 text-lg"></i>
                            <span>Laporan Peminjaman</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laporan_pengembalian_admin') }}"
                           class="flex items-center px-6 py-3 bg-birutua2 border-l-4 border-blue-600 text-white rounded transition font-semibold">
                            <i class="fa-solid fa-rotate-left mr-3 text-blue-600 text-lg"></i>
                            <span>Laporan Pengembalian</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col bg-white">
            <div class="bg-birutua">
                <header class="flex items-center justify-between px-8 py-6">
                    <div></div>
                    <div class="flex items-center space-x-6">
                        <button class="text-gray-400 text-xl">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                        <div class="flex items-center space-x-2">
                            <span class="bg-green-500 text-white font-bold rounded-full w-10 h-10 flex items-center justify-center">AD</span>
                            <span class="text-white">Admin</span>
                        </div>
                    </div>
                </header>
                <div class="px-8 pt-2 pb-8">
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="bg-white text-blue-600 px-3 py-2 rounded font-semibold flex items-center shadow">
                            <i class="fa-solid fa-rotate-left mr-2"></i>
                            / Laporan Pengembalian
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex-1 px-8 pb-8 bg-white">
                <div class="bg-white rounded shadow overflow-x-auto w-full max-w-5xl mx-auto mt-8">
                    <div class="flex items-center justify-between px-6 py-3 border-b font-semibold">
                        <span>Laporan Pengembalian</span>
                    </div>
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="py-3 px-4 text-left">No</th>
                                <th class="py-3 px-4 text-left">Tanggal Pinjam</th>
                                <th class="py-3 px-4 text-left">Nama Peminjam</th>
                                <th class="py-3 px-4 text-left">Nama Barang</th>
                                <th class="py-3 px-4 text-left">Jumlah</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $item)
                                <tr class="border-b">
                                    <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-4">{{ $item->tanggal_pinjam }}</td>
                                    <td class="py-3 px-4">{{ $item->nama_peminjam }}</td>
                                    <td class="py-3 px-4">{{ $item->nama_barang }}</td>
                                    <td class="py-3 px-4">{{ $item->jumlah }}</td>
                                    <td class="py-3 px-4">
                                        <span class="status-dot" style="background:#22c55e"></span>{{ $item->status }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <form action="{{ route('pengembalian.konfirmasi', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:underline">Sudah Dikembalikan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-3 px-4 text-center text-gray-400">Belum ada pengembalian yang perlu dikonfirmasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
