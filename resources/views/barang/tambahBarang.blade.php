<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tambah Barang</title>
</head>
<body class="bg-gray-100">

    @include('layout.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200 px-6 shadow">
            <div class="flex items-center">
                <h1 class="text-xl font-semibold text-gray-800">Tambah Barang Baru</h1>
            </div>
        </div>

        <!-- Form Content -->
        <div class="container mx-auto p-6 flex-1">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form action="{{ route('tambah-barang') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Barang -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" name="price" id="price" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700">Gambar Barang</label>
                        <input type="file" name="image" id="image"
                            class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Tambah Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
