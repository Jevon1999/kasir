<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Edit Karyawan</title>
</head>
<body class="bg-gray-100">

  @include('layout.sidebar')

  <div class="flex flex-col flex-1 overflow-hidden">
    <!-- Navbar -->
    <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200 px-4">
      <div class="flex items-center">
        <button class="text-gray-500 focus:outline-none focus:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

    <div class="container mx-auto p-6">
      <h2 class="text-2xl font-bold mb-4">Edit Karyawan</h2>

      <form method="POST" action="{{ route('karyawan.update', $karyawan->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
            <input type="text" name="name" value="{{ $karyawan->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $karyawan->email }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
          </div>
        </div>

        <div class="mt-6 flex justify-end space-x-2">
          <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
