<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <title>Register</title>
</head>
<body>
    <div class="max-w-sm mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
        <div class="text-center">
          <img class="h-8 w-auto mx-auto" src="https://www.svgrepo.com/show/353414/apple.svg" alt="Apple">
          <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Register to create your account</h2>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            You have an account?
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300">Login →</a>
          </p>
        </div>

        <!-- Handle session or validation errors -->
        @if(session('failed'))
            <div class="alert alert-danger text-center text-red-600 bg-red-100 p-2 rounded-md mt-4">
                {{ session('failed') }}
            </div>
        @endif

        <form action="/register" method="POST" class="space-y-6 mt-8">
            @csrf

            <!--Name Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="name">Name</label>
                <div class="mt-1">
                    <input class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none sm:text-sm border-gray-300 placeholder-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                           id="name" type="name" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="your name" required autofocus>
                </div>
                @error('name')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>

            <!-- Email Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="email">Email address</label>
                <div class="mt-1">
                    <input class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none sm:text-sm border-gray-300 placeholder-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                           id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="your@email.com" required autofocus>
                </div>
                @error('email')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="password">Password</label>
                <div class="mt-1 relative">
                    <input class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none sm:text-sm border-gray-300 placeholder-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                           id="password" type="password" name="password" placeholder="••••••••" required>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword()">
                        <svg id="eyeIcon" class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>
                @error('password')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>

            <!-- Confirm Password Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="confirm_password">Confirm Password</label>
                <div class="mt-1 relative">
                    <input class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none sm:text-sm border-gray-300 placeholder-gray-400 dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                           id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Your Password" required>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="toggleConfirmPassword()">
                        <svg id="eyeIcon" class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>
                @error('confirm_password')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>
            
            <script>
                function togglePassword() {
                    var passwordField = document.getElementById("password");
                    var eyeIcon1 = document.getElementById("eyeIcon");
                    
                    if (passwordField.type === "password") {
                        passwordField.type = "text";
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7 1.274-4.057 5.065-7 9.542-7 1.89 0 3.682.533 5.205 1.458M21 21l-5.197-5.197M15 12a3 3 0 00-6 0 3 3 0 006 0z" />';
                    } else {
                        passwordField.type = "password";
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />';
                    }
                }
            </script>

            <script>
                function toggleConfirmPassword() {
                    var passwordField = document.getElementById("confirm_password");
                    var eyeIcon2 = document.getElementById("eyeIcon");
                    
                    if (passwordField.type === "password") {
                        passwordField.type = "text";
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7 1.274-4.057 5.065-7 9.542-7 1.89 0 3.682.533 5.205 1.458M21 21l-5.197-5.197M15 12a3 3 0 00-6 0 3 3 0 006 0z" />';
                    } else {
                        passwordField.type = "password";
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />';
                    }
                }
            </script>


            <!-- Login with Google and Facebook -->
            <div class="mt-4 flex justify-between">
                <button class="py-2 px-4 max-w-md flex justify-center items-center bg-[#FBBC05] hover:bg-[#F1A800] focus:ring-[#F1A800] focus:ring-offset-[#F1A800] text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="-0.5 0 48 48" version="1.1">
                        <title>Google-color</title>
                        <desc>Created with Sketch.</desc>
                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Color-" transform="translate(-401.000000, -860.000000)">
                                <g id="Google" transform="translate(401.000000, 860.000000)">
                                    <path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"> </path>
                                    <path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"> </path>
                                    <path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"> </path>
                                    <path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"> </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Continue with Google
                </button>
            </div>
            <div class="mt-4 flex justify-between">
                    <button type="button" class="py-2 px-4 max-w-md  flex justify-center items-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                        <svg width="20" height="20" fill="currentColor" class="mr-2" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759h-306v-759h-255v-296h255v-218q0-186 104-288.5t277-102.5q147 0 228 12z"></path>
                        </svg>
                        Continue with Facebook
                      </button>
                    
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="inline-flex items-center border font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 text-base bg-black font-medium text-white hover:bg-gray-800 border border-black focus:ring-black w-full justify-center">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>
