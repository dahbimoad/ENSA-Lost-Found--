<x-guest-layout>
    <!-- Page Title -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-3">Welcome Back</h2>
        <p class="text-gray-600 text-lg">Sign in to your account to continue</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif    <form method="POST" action="{{ route('login') }}" class="space-y-8 w-full">
        @csrf<!-- Email Address -->
        <div class="space-y-3 w-full">
            <label for="email" class="block text-lg font-semibold text-gray-700 w-full">
                <div class="flex items-center space-x-2 mb-3 w-full">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <span class="flex-1">Email Address</span>
                </div>
            </label>
            <div class="w-full">
                <input id="email" 
                       class="input-modern @error('email') border-red-500 ring-red-500 @enderror" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="Enter your email address" />
            </div>
            @error('email')
                <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 p-3 rounded-lg w-full">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>        <!-- Password -->
        <div class="space-y-3 w-full">
            <label for="password" class="block text-lg font-semibold text-gray-700 w-full">
                <div class="flex items-center space-x-2 mb-3 w-full">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <span class="flex-1">Password</span>
                </div>
            </label>
            <div class="w-full">
                <input id="password" 
                       class="input-modern @error('password') border-red-500 ring-red-500 @enderror" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       placeholder="Enter your password" />
            </div>
            @error('password')
                <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 p-3 rounded-lg w-full">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div><!-- Remember Me -->
        <div class="flex items-center justify-between py-2">
            <label for="remember_me" class="flex items-center group cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 w-5 h-5" 
                       name="remember">
                <span class="ml-3 text-gray-600 group-hover:text-gray-800 font-medium">Remember me</span>
            </label>
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold text-sm hover:underline">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="pt-4">
            <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-4 text-white font-bold text-lg rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-xl hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Sign In to Your Account
            </button>
        </div>        <!-- Register Link -->
        <div class="text-center pt-6 border-t border-gray-200">
            <p class="text-gray-600 text-lg mb-4">Don't have an account yet?</p>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-gray-700 font-bold text-lg rounded-xl bg-white border-2 border-gray-200 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl w-full">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Create New Account
            </a>
        </div>
    </form>
</x-guest-layout>
