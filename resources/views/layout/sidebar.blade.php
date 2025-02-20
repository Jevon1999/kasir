<body class="bg-gray-100">

    <div class="flex h-screen">

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="hidden md:flex flex-col w-64 bg-gray-800 h-screen">
            <!-- Header -->
            <div class="flex items-center justify-center h-16 bg-gray-900">
                <span class="text-white font-bold uppercase">Kasir</span>
            </div>

            <!-- Profile Info -->
            <div class="p-4 text-white flex items-center space-x-4 bg-gray-800">
                <img class="h-10 w-10 rounded-full border border-gray-600" src="{{asset('profil.jpeg')}}" alt="Profile Picture">
                <div>
                    <a href="#" class="text-lg font-semibold hover:text-indigo-400">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto">
                <a href="/dashboard" class="flex items-center px-4 py-2 rounded {{ request()->is('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-100 hover:bg-gray-700' }}">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Dashboard
                </a>

                @if(auth()->user()->role == 'admin')
                <a href="{{route ('data-karyawan')}}" class="flex items-center px-4 py-2 rounded {{ request()->is('buat-akun-karyawan') ? 'bg-blue-600 text-white' : 'text-gray-100 hover:bg-gray-700' }}">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 11a4 4 0 10-6 0m8 8H7"></path>
                    </svg>
                    Karyawan
                </a>

                @endif

                @if(auth()->user()->role == 'staff')
                <a href="{{route ('data-member')}}" class="flex items-center px-4 py-2 rounded {{ request()->is('buat-akun-member') ? 'bg-blue-600 text-white' : 'text-gray-100 hover:bg-gray-700' }}">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 11a4 4 0 10-6 0m8 8H7"></path>
                    </svg>
                    Member
                </a>

                @endif

                @if(auth()->user()->role == 'admin')
                <a href="/tampil-barang" class="flex items-center px-4 py-2 rounded {{ request()->is('tampil-barang') ? 'bg-blue-600 text-white' : 'text-gray-100 hover:bg-gray-700' }}">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15c0 1.104-.896 2-2 2H5c-1.104 0-2-.896-2-2V5c0-1.104.896-2 2-2h14c1.104 0 2 .896 2 2v10z"/>
                    </svg>
                    Barang
                </a>
                @endif

                <a href="/kasir" class="flex items-center px-4 py-2 rounded {{ request()->is('kasir') ? 'bg-blue-600 text-white' : 'text-gray-100 hover:bg-gray-700' }}">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15c0 1.104-.896 2-2 2H5c-1.104 0-2-.896-2-2V5c0-1.104.896-2 2-2h14c1.104 0 2 .896 2 2v10z"/>
                    </svg>
                    Aplikasi Kasir
                </a>

                <a href="/history" class="flex items-center px-4 py-2 rounded {{ request()->is('history') ? 'bg-blue-600 text-white' : 'text-gray-100 hover:bg-gray-700' }}">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15c0 1.104-.896 2-2 2H5c-1.104 0-2-.896-2-2V5c0-1.104.896-2 2-2h14c1.104 0 2 .896 2 2v10z"/>
                    </svg>
                    History Transaksi
                </a>

                @if(auth()->user()->role == 'admin')
                <a href="/detailPenjualan" class="flex items-center px-4 py-2 rounded {{ request()->is('detailPenjualan') ? 'bg-blue-600 text-white' : 'text-gray-100 hover:bg-gray-700' }}">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15c0 1.104-.896 2-2 2H5c-1.104 0-2-.896-2-2V5c0-1.104.896-2 2-2h14c1.104 0 2 .896 2 2v10z"/>
                    </svg>
                    Detail Penjualan
                </a>
                @endif
            </nav>

            <!-- Logout -->
            <div class="p-4">
                <a href="/logout" class="flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Log Out
                </a>
            </div>
        </div>
    </div>
</body>
