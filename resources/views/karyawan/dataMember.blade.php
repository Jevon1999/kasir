<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Data Member</title>
</head>

<body>
    @include('layout.sidebar')

    <div class="flex flex-col flex-1 overflow-hidden">
        <div class="flex flex-col min-h-screen flex-1">
            <!-- Navbar -->
            <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200 px-4">
                <div class="flex items-center">
                    <button class="text-gray-500 focus:outline-none focus:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <input class="mx-4 w-full border rounded-md px-4 py-2" type="text" placeholder="Search">
                </div>
                <div class="flex items-center pr-4">
                    <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l-7-7 7-7m5 14l7-7-7-7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-6 flex-1">
                <div class="container mx-auto">
                    <div class="bg-white p-6 shadow rounded-lg">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Member</h2>

                        <div class="overflow-x-auto rounded-lg shadow-sm">
                            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 tracking-wider">Nama</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 tracking-wider">Email</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 hover:bg-gray-50 transition-colors">
                                    @foreach($member as $members)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $members->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $members->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1.5 text-sm font-medium rounded-full
                                                {{ $members->status == 'active' ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
                                                {{ ucfirst($members->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap space-x-3">
                                            <a href="{{ route('member.edit', $members->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">Edit</a>
                                            <span class="text-gray-300">|</span>
                                            <form action="{{ route('member.destroy', $members->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus member ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('member.create') }}" class="bg-blue-500 text-white px-5 py-2.5 rounded-lg hover:bg-blue-600 transition-all duration-200 shadow-md hover:shadow-lg flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span>Tambah Member</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
