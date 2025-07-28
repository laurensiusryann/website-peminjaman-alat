<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman | KampusPinjam</title>
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
                    <div class="flex items-center space-x-6">
                        <button class="text-gray-400 text-xl">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                        <div class="flex items-center space-x-2">
                            <span class="bg-green-500 text-white font-bold rounded-full w-10 h-10 flex items-center justify-center">
                                {{ strtoupper(substr($full_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $full_name)[1] ?? '', 0, 1)) }}
                            </span>
                            <span class="text-white">{{ $full_name }}</span>
                        </div>
                    </div>
                </header>
                <div class="px-8 pt-2 pb-8">
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="bg-white text-blue-600 px-3 py-2 rounded font-semibold flex items-center shadow">
                            <i class="fa-solid fa-coins mr-2"></i>
                            / Detail Peminjaman
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex-1 px-8 pb-8 bg-white flex justify-center items-start">
                <div class="bg-white rounded shadow border w-full max-w-xl mt-12 p-8">
                    <div class="mb-6">
                        <a href="{{ route('transaksi_peminjaman') }}" class="text-blue-600 hover:underline flex items-center mb-4">
                            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Peminjaman
                        </a>
                        <h2 class="text-xl font-bold mb-4">Detail Peminjaman</h2>
                        <table class="w-full text-sm">
                            <tr>
                                <td class="font-semibold py-2 w-40">Nama Peminjam</td>
                                <td class="py-2">{{ $peminjaman->nama_peminjam }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2">Nama Barang</td>
                                <td class="py-2">{{ $peminjaman->nama_barang }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2">Jumlah</td>
                                <td class="py-2">{{ $peminjaman->jumlah }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2">Tanggal Pinjam</td>
                                <td class="py-2">{{ $peminjaman->tanggal_pinjam }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2">Tanggal Kembali</td>
                                <td class="py-2">{{ $peminjaman->tanggal_kembali }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2">Tujuan</td>
                                <td class="py-2">{{ $peminjaman->tujuan }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2">Status</td>
                                <td class="py-2">
                                    <span class="inline-flex items-center {{ $peminjaman->status == 'Dikembalikan' ? 'text-blue-600' : ($peminjaman->status == 'Disetujui' ? 'text-green-600' : ($peminjaman->status == 'Ditolak' ? 'text-red-600' : 'text-yellow-600')) }}">
                                        <span class="w-2 h-2 rounded-full mr-2
                                            {{ $peminjaman->status == 'Dikembalikan' ? 'bg-blue-600' : ($peminjaman->status == 'Disetujui' ? 'bg-green-600' : ($peminjaman->status == 'Ditolak' ? 'bg-red-600' : 'bg-yellow-400')) }}">
                                        </span>
                                        {{ $peminjaman->status }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('transaksi_peminjaman') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded font-semibold">Tutup</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>