<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang | KampusPinjam</title>
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
        <!-- Sidebar ... (sidebar code sama seperti sebelumnya) ... -->
        <aside class="w-72 bg-birutua min-h-screen flex flex-col">
            <div class="px-8 py-6 border-b border-birutua2">
                <h1 class="text-2xl font-bold text-white">KampusPinjam</h1>
            </div>
            <nav class="flex-1 py-4 flex flex-col gap-2">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard_admin') }}"
                        class="flex items-center px-6 py-3 {{ Route::is('dashboard_admin') ? 'bg-birutua2 border-l-4 border-blue-600' : 'hover:bg-birutua2' }} rounded text-white font-semibold transition">
                            <i class="fa-solid fa-display mr-3 text-blue-600 text-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('data_barang_admin') }}"
                        class="flex items-center px-6 py-3 {{ Route::is('data_barang_admin') ? 'bg-birutua2 border-l-4 border-orange-400' : 'hover:bg-birutua2' }} rounded text-white font-semibold transition">
                            <i class="fa-solid fa-box mr-3 text-orange-400 text-lg"></i>
                            <span>Data Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('data_peminjam') }}"
                        class="flex items-center px-6 py-3 {{ Route::is('data_peminjam') ? 'bg-birutua2 border-l-4 border-orange-400' : 'hover:bg-birutua2' }} rounded text-white font-semibold transition">
                            <i class="fa-solid fa-users mr-3 text-orange-400 text-lg"></i>
                            <span>Data Peminjam</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transaksi_peminjaman_admin') }}"
                        class="flex items-center px-6 py-3 {{ Route::is('transaksi_peminjaman_admin') ? 'bg-birutua2 border-l-4 border-orange-400' : 'hover:bg-birutua2' }} rounded text-white font-semibold transition">
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
                    <div class="mb-4">
                        <input type="text" placeholder="Search" class="px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 w-64">
                    </div>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="bg-white text-blue-600 px-3 py-2 rounded font-semibold flex items-center shadow">
                            <i class="fa-solid fa-house mr-2"></i>
                            / Data Barang
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex-1 px-8 pb-8 bg-white">
                <div class="bg-white rounded shadow overflow-x-auto w-full max-w-4xl mx-auto mt-8">
                    <div class="flex items-center justify-between px-6 py-3 border-b font-semibold">
                        <span>Data Barang</span>
                        <a href="{{ route('tambah_barang') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center font-semibold text-sm">
                            <i class="fa-solid fa-plus mr-2"></i>Tambah Barang
                        </a>
                    </div>
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="py-3 px-4 text-left">No</th>
                                <th class="py-3 px-4 text-left">Kode Barang</th>
                                <th class="py-3 px-4 text-left">Nama Barang</th>
                                <th class="py-3 px-4 text-left">Merk</th>
                                <th class="py-3 px-4 text-left">Jenis</th>
                                <th class="py-3 px-4 text-left">Unit</th>
                                <th class="py-3 px-4 text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $barang)
                            <tr class="border-b relative group">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 font-bold">{{ $barang->kode_barang }}</td>
                                <td class="py-3 px-4">{{ $barang->nama_barang }}</td>
                                <td class="py-3 px-4">{{ $barang->merk }}</td>
                                <td class="py-3 px-4">{{ $barang->jenis }}</td>
                                <td class="py-3 px-4">{{ $barang->unit }}</td>
                                <td class="py-3 px-4 text-center relative">
                                    <button type="button" onclick="toggleMenu({{ $barang->id }})" class="focus:outline-none">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <!-- Popup menu -->
                                    <div id="menu-{{ $barang->id }}" class="hidden absolute right-0 z-10 mt-2 w-24 bg-white border rounded shadow-lg">
                                        <a href="{{ route('barang.edit', $barang->id) }}" class="block px-4 py-2 hover:bg-gray-100 text-left w-full">Edit</a>
                                        <button type="button" onclick="showDeleteModal({{ $barang->id }})" class="block px-4 py-2 hover:bg-gray-100 text-left w-full text-red-600">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if($barangs->isEmpty())
                            <tr>
                                <td colspan="7" class="py-3 px-4 text-center text-gray-400">Belum ada data barang.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <!-- Modal Konfirmasi Hapus -->
    <div id="delete-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50 hidden">
        <div class="bg-white rounded shadow-lg p-6 w-80 text-center">
            <div class="mb-4 font-semibold">Anda yakin ingin menghapus?</div>
            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center gap-4">
                    <button type="submit" class="bg-gray-200 px-4 py-1 rounded hover:bg-gray-300">OK</button>
                    <button type="button" onclick="hideDeleteModal()" class="bg-gray-200 px-4 py-1 rounded hover:bg-gray-300">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function toggleMenu(id) {
            // Close all menus first
            document.querySelectorAll('[id^="menu-"]').forEach(el => el.classList.add('hidden'));
            // Toggle the selected menu
            const menu = document.getElementById('menu-' + id);
            if(menu) menu.classList.toggle('hidden');
            // Close menu if click outside
            document.addEventListener('click', function handler(e) {
                if (!menu.contains(e.target) && !e.target.closest('button[onclick^="toggleMenu"]')) {
                    menu.classList.add('hidden');
                    document.removeEventListener('click', handler);
                }
            });
        }
        function showDeleteModal(id) {
            const url = "{{ url('barang') }}/" + id;
            document.getElementById('delete-form').action = url;
            document.getElementById('delete-modal').classList.remove('hidden');
            // Tutup semua menu popup
            document.querySelectorAll('[id^="menu-"]').forEach(el => el.classList.add('hidden'));
        }
        function hideDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
</body>
</html>