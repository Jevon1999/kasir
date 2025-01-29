<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Siderbar</title>
</head>
<body>
    
</body>
</html>
<div class="flex h-screen bg-gray-100">

    <!-- sidebar -->
    <div class="hidden md:flex flex-col w-64 bg-gray-800">
        <div class="flex items-center justify-center h-16 bg-gray-900">
            <span class="text-white font-bold uppercase">Kasir</span>
        </div>

        <div class="info bg-gray-800 text-white p-4 rounded-lg shadow-md flex items-center space-x-4">
            <img class="h-10 w-10 rounded-full" src="{{asset('profil.jpeg')}}" alt="Profile Picture">
            <div>
                <a href="#" class="text-lg font-semibold hover:text-indigo-400">{{ auth()->user()->name }}</a>
                {{-- <p class="text-sm text-gray-400">{{ auth()->user()->role}}</p> <!-- Tampilkan role atau jabatan jika ada --> --}}
            </div>
        </div>
        

        <div class="flex flex-col flex-1 overflow-y-auto">
            <nav class="flex-1 px-2 py-4 bg-gray-800">
                <a href="/dashboard" class="nav-link{{ request()->is('dashboard') ? ' bg-blue-600 text-white' : ' text-gray-100' }} flex items-center px-4 py-2 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Dashboard
                </a>

                @if(auth()->user()->role == 'admin')
                <a href="/staff" class="nav-link{{ request()->is('staff') ? ' bg-blue-600 text-white' : ' text-gray-100' }} flex items-center px-4 py-2 hover:bg-gray-700">
                    <!-- Ganti dengan ikon pesan -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15c0 1.104-.896 2-2 2H5c-1.104 0-2-.896-2-2V5c0-1.104.896-2 2-2h14c1.104 0 2 .896 2 2v10zM21 8h-2v1h-1V7h3v1zm-7 0h-1v1h-1V7h2v1zm-7 0h-1v1H6V7h2v1z"/>
                    </svg>
                    Staff
                </a>
                @endif

                <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Settings
                </a>

                <a href="/logout" class="nav-link{{ request()->is('logout') ? ' bg-blue-600 text-white' : ' text-gray-100' }} flex items-center px-4 py-2 hover:bg-gray-700">
                    <svg class="h-8 w-8 text-red-900"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                      </svg>
                    LogOut
                </a>
                
            </nav>
        </div>
    </div>

   