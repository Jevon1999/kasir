<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Input Data Karyawan</title>
</head>

<body>
    @include('layout.sidebar')

    <!-- Main Content -->
    <div class="flex flex-col min-h-screen flex-1">
        <!-- Navbar -->
        <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200 px-6 shadow">
            <!-- You can add your navbar content here -->
        </div>

        <div class="container mx-auto p-6 max-w-4xl">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Input Data Karyawan</h2>

            <!-- Form Input Data Karyawan -->
            <div class="bg-white p-6 shadow rounded-lg">
                <form action="{{ route('karyawan.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama Karyawan</label>
                        <input type="text" id="name" name="name" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300" required>
                        <p id="password_error" class="text-red-500 text-sm mt-2 hidden">Password tidak cocok!</p>
                    </div>

                    <input type="hidden" name="role" value="staff">
                    <input type="hidden" name="status" value="verify">

                    <button type="submit" class="w-full bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600 transition duration-200">
                        Simpan Data
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password_confirmation").value;
            var errorText = document.getElementById("password_error");

            if (password !== confirmPassword) {
                errorText.classList.remove("hidden");
                return false;
            } else {
                errorText.classList.add("hidden");
                return true;
            }
        }
    </script>
</body>
</html>
