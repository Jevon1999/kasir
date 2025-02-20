<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Pastikan versi Alpine.js benar -->
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <title>Daftar Barang</title>

  <!-- Agar elemen dengan x-cloak tidak berkedip sebelum Alpine siap -->
      <style>[x-cloak] { display: none !important; }</style>

</head>
<body class="bg-gray-100">

  @include('layout.sidebar')

  <!-- Wrapper untuk Main Content -->
  <div class="flex flex-col flex-1 overflow-hidden">
    <!-- Navbar -->
    <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200 px-4">
      <div class="flex items-center">
        <button class="text-gray-500 focus:outline-none focus:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        <input class="mx-4 w-full border rounded-md px-4 py-2"
               type="text" placeholder="Search">
      </div>
    </div>

    <div class="container mx-auto p-6">
      <h2 class="text-2xl font-bold mb-4">Daftar Barang</h2>

      <!-- Tombol Tambah Barang -->
      <a href="{{ route('barang.create') }}"
         class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
         Tambah Barang
      </a>

      <!-- Flash Message -->
      @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
          {{ session('success') }}
        </div>
      @endif

      <!-- Tabel Barang -->
      <div class="bg-white p-4 shadow rounded-lg">
        <table class="w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-200">
              <th class="border p-2">Nama</th>
              <th class="border p-2">Harga</th>
              <th class="border p-2">Deskripsi</th>
              <th class="border p-2">Gambar</th>
              <th class="border p-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($barang as $item)
              <tr>
                <td class="border p-2">{{ $item->name }}</td>
                <td class="border p-2">{{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="border p-2">{{ $item->description }}</td>
                <td class="border p-2">
                  <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar {{ $item->name }}" class="h-12">
                </td>
                <td class="border p-2">
                <div class="flex space-x-2">
                  <a href="{{ route('barang.edit' , $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md flex items-center space-x-2 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    <span>Edit</span>
                  </a>
                    <!-- Tombol Delete -->
                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md flex items-center space-x-2 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 011-1h6a1 1 0 011 1v1h5a1 1 0 110 2h-1v11a2 2 0 01-2 2H5a2 2 0 01-2-2V5H2a1 1 0 110-2h5V2zm2 3a1 1 0 00-1 1v9a1 1 0 102 0V6a1 1 0 00-1-1zm4 0a1 1 0 00-1 1v9a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>Hapus</span>
                        </button>
                    </form>
                    </div>
                </td>



                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
