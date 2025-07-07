<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjam | KampusPinjam</title>
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
                        <a href="{{ route('dashboard_admin') }}" class="flex items-center px-6 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
                            <i class="fa-solid fa-display mr-3 text-blue-600 text-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('data_barang_admin') }}" class="flex items-center px-6 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
                            <i class="fa-solid fa-box mr-3 text-orange-400 text-lg"></i>
                            <span>Data Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('data_peminjam') }}" class="flex items-center px-6 py-3 bg-birutua2 rounded text-white font-semibold border-l-4 border-orange-400">
                            <i class="fa-solid fa-users mr-3 text-orange-400 text-lg"></i>
                            <span>Data Peminjam</span>
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
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
                            <i class="fa-solid fa-chart-line mr-3 text-blue-600 text-lg"></i>
                            <span>Laporan Peminjaman</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
                            <i class="fa-solid fa-rotate-left mr-3 text-blue-600 text-lg"></i>
                            <span>Laporan Pengembalian</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 flex flex-col bg-white">
            <!-- Header dan area atas -->
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
                <div class="px-8 pt-2 pb-8"></div>
            </div>
            <!-- Konten utama -->
            <div class="flex-1 px-8 pb-8 bg-white flex justify-center items-start">
                <div class="bg-white rounded shadow border w-full max-w-3xl mt-12 p-8">
                    <!-- Breadcrumb -->
                    <div class="flex items-center mb-6">
                        <span class="text-blue-600 font-semibold flex items-center">
                            <i class="fa-solid fa-users mr-2"></i>
                            Tambah Peminjam
                        </span>
                    </div>
                    @if($errors->any())
                        <div class="mb-4 text-red-600">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('tambah_peminjam.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block font-semibold mb-2">Nama Peminjam</label>
                                <input type="text" name="nama" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            </div>
                            <div>
                                <label class="block font-semibold mb-2">NPM</label>
                                <input type="text" name="npm" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block font-semibold mb-2">Password</label>
                            <input type="text" name="password" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded font-semibold">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>