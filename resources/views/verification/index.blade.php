<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <title>Document</title>
</head>
<body>
    <div class="max-w-sm mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
        <div class="text-center">
          <img class="h-8 w-auto mx-auto" src="https://www.svgrepo.com/show/353414/apple.svg" alt="Apple">
          <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Sign in to your account</h2>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">Sign Up →</a>
          </p>
        </div>

        <!-- Handle session or validation errors -->
        @if(session('failed'))
            <div class="alert alert-danger text-center text-red-600 bg-red-100 p-2 rounded-md mt-4">
                {{ session('failed') }}
            </div>
        @endif




            <!-- Submit Button -->
            <div>
                <button type="submit" class="inline-flex items-center border font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 text-base bg-black font-medium text-white hover:bg-gray-800 border border-black focus:ring-black w-full justify-center">
                    Sign in
                </button>
            </div>
    </div>
</body>
</html>
