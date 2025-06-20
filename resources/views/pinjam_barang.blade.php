<!-- filepath: [pinjam_barang.blade.php](http://_vscodecontentref_/6) -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Barang | KampusPinjam</title>
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
                    <li>
                        <a href="{{ route('pinjam_barang') }}" class="flex items-center px-6 py-3 bg-birutua2 rounded text-white font-semibold border-l-4 border-blue-600">
                            <i class="fa-solid fa-plus mr-3 text-blue-600 text-lg"></i>
                            <span>Pinjam Barang</span>
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
                        <a href="#" class="flex items-center px-8 py-3 text-white hover:bg-birutua2 rounded transition font-semibold">
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
                            <span class="bg-green-500 text-white font-bold rounded-full w-10 h-10 flex items-center justify-center">LR</span>
                            <span class="text-white">Ryan</span>
                        </div>
                    </div>
                </header>
                <div class="px-8 pt-2 pb-8">
                    <div class="mb-4">
                        <input type="text" placeholder="Search" class="px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 w-64">
                    </div>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="bg-white text-blue-600 px-3 py-2 rounded font-semibold flex items-center shadow">
                            <i class="fa-solid fa-box mr-2"></i>
                            Pinjam Barang
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex-1 px-8 pb-8 bg-white">
                <div class="bg-white rounded shadow w-full max-w-3xl mx-auto mt-8 p-8 border">
                    <form action="{{ route('pinjam_barang.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block font-semibold mb-2">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required />
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold mb-2">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required />
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold mb-2">Nama Barang</label>
                            <select name="nama_barang" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                                <option value="">---Pilih Barang---</option>
                                <option>Sound System</option>
                                <option>Kabel HDMI</option>
                                <option>Splitter</option>
                                <option>PC</option>
                                <option>Meja</option>
                                <option>Kursi</option>
                            </select>
                        </div>
                        <div class="flex gap-4 mb-4">
                            <div class="flex-1">
                                <label class="block font-semibold mb-2">Jumlah Barang</label>
                                <input type="number" name="jumlah" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" min="1" required />
                            </div>
                            <div class="flex-1">
                                <label class="block font-semibold mb-2">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required />
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block font-semibold mb-2">Tujuan Peminjaman</label>
                            <input type="text" name="tujuan" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required />
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>