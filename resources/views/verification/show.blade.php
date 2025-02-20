<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Account Verification</title>
</head>
<body>
    <div class="flex items-center justify-center h-screen">
        <div class="max-w-sm mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
            <div class="text-center">
                <img class="h-8 w-auto mx-auto" src="https://www.svgrepo.com/show/353414/apple.svg" alt="Apple">
                <p class="mt-6 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Please verify your account</p>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">We have sent a verification code to your email address. Please enter the code below to proceed.</p>
            </div>

            <!-- Handle session or validation errors -->
            @if(session('failed'))
                <div class="alert alert-danger text-center text-red-600 bg-red-100 p-2 rounded-md mt-4">
                    {{ session('failed') }}
                </div>
            @endif

            <!-- Verification Form -->
            <form action="/verify/{{ $unique_id }}" method="POST" class="mt-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="otp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Verification Code</label>
                    <input type="number" name="otp" id="otp" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your OTP" required>
                </div>

                <button type="submit" class="w-full mt-4 p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Verify Code</button>
            </form>

            <!-- Resend OTP Button -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-300">Didn't receive the code? <a href="#!" class="text-blue-600 hover:underline">Resend OTP</a></p>
            </div>
        </div>
    </div>
</body>
</html>
