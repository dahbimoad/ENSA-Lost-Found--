<x-guest-layout>
    <!-- Page Title -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-3">Create Account</h2>
        <p class="text-gray-600 text-lg">Join ENSA Lost & Found community</p>
    </div>    <form method="POST" action="{{ route('register') }}" class="space-y-6 w-full">
        @csrf        <!-- Name -->
        <div class="space-y-3 w-full">
            <label for="name" class="block text-lg font-semibold text-gray-700 w-full">
                <div class="flex items-center space-x-2 mb-3 w-full">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <span class="flex-1">Full Name <span class="text-red-500">*</span></span>
                </div>
            </label>
            <div class="w-full">
                <input id="name" 
                       class="input-modern @error('name') border-red-500 ring-red-500 @enderror" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Enter your full name" />
            </div>
            @error('name')
                <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 p-3 rounded-lg w-full">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>        <!-- Email Address -->
        <div class="space-y-3 w-full">
            <label for="email" class="block text-lg font-semibold text-gray-700 w-full">
                <div class="flex items-center space-x-2 mb-3 w-full">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <span class="flex-1">Email Address <span class="text-red-500">*</span></span>
                </div>
            </label>
            <div class="w-full">
                <input id="email" 
                       class="input-modern @error('email') border-red-500 ring-red-500 @enderror" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       required 
                       autocomplete="username"
                       placeholder="Enter your email address" />
            </div>
            @error('email')
                <div class="mt-2 flex items-center text-red-600 text-sm w-full">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>        <!-- Student ID -->
        <div class="space-y-3 w-full">
            <label for="student_id" class="block text-lg font-semibold text-gray-700 w-full">
                <div class="flex items-center space-x-2 mb-3 w-full">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                        </svg>
                    </div>
                    <span class="flex-1">Student ID <span class="text-gray-500 text-base font-normal">(Optional)</span></span>
                </div>
            </label>
            <div class="w-full">
                <input id="student_id" 
                       class="input-modern @error('student_id') border-red-500 ring-red-500 @enderror" 
                       type="text" 
                       name="student_id" 
                       value="{{ old('student_id') }}"
                       placeholder="Enter your student ID (optional)" />
            </div>
            @error('student_id')
                <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 p-3 rounded-lg w-full">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>        <!-- WhatsApp -->
        <div class="space-y-3 w-full">
            <label for="whatsapp" class="block text-lg font-semibold text-gray-700 w-full">
                <div class="flex items-center space-x-2 mb-3 w-full">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="flex-1">WhatsApp Number <span class="text-gray-500 text-base font-normal">(Optional)</span></span>
                </div>
            </label>
            <div class="w-full">
                <input id="whatsapp" 
                       class="input-modern @error('whatsapp') border-red-500 ring-red-500 @enderror" 
                       type="text" 
                       name="whatsapp" 
                       value="{{ old('whatsapp') }}" 
                       placeholder="+212 6XX XXX XXX" />
            </div>
            <p class="text-sm text-gray-500 mt-2 ml-1 bg-gray-50 p-2 rounded-lg w-full">📱 Include country code (e.g., +212 for Morocco)</p>
            @error('whatsapp')
                <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 p-3 rounded-lg w-full">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div><!-- Privacy Settings -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-5 border border-blue-200 space-y-4">
            <label class="block text-lg font-semibold text-gray-700">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <span>Contact Visibility Settings</span>
                </div>
            </label>
            <div class="space-y-4">
                <div class="bg-white rounded-lg p-4 border border-blue-100">
                    <div class="flex items-start">
                        <input id="show_email" 
                               type="checkbox" 
                               name="show_email" 
                               value="1" 
                               {{ old('show_email', true) ? 'checked' : '' }} 
                               class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 w-4 h-4">
                        <div class="ml-3">
                            <label for="show_email" class="text-sm font-semibold text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                                Show my email to other users
                            </label>
                            <p class="text-xs text-gray-500 mt-1">Other users can contact you via email about lost/found items</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-4 border border-blue-100">
                    <div class="flex items-start">
                        <input id="show_whatsapp" 
                               type="checkbox" 
                               name="show_whatsapp" 
                               value="1" 
                               {{ old('show_whatsapp', true) ? 'checked' : '' }} 
                               class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 w-4 h-4">
                        <div class="ml-3">
                            <label for="show_whatsapp" class="text-sm font-semibold text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Show my WhatsApp number to other users
                            </label>
                            <p class="text-xs text-gray-500 mt-1">Other users can contact you via WhatsApp about lost/found items</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        <!-- Password -->
        <div class="space-y-3 w-full">
            <label for="password" class="block text-lg font-semibold text-gray-700 w-full">
                <div class="flex items-center space-x-2 mb-3 w-full">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <span class="flex-1">Password <span class="text-red-500">*</span></span>
                </div>
            </label>
            <div class="w-full">
                <input id="password" 
                       class="input-modern @error('password') border-red-500 ring-red-500 @enderror" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="new-password"
                       placeholder="Choose a strong password" />
            </div>
            @error('password')
                <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 p-3 rounded-lg w-full">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>        <!-- Confirm Password -->
        <div class="space-y-3 w-full">
            <label for="password_confirmation" class="block text-lg font-semibold text-gray-700 w-full">
                <div class="flex items-center space-x-2 mb-3 w-full">
                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="flex-1">Confirm Password <span class="text-red-500">*</span></span>
                </div>
            </label>
            <div class="w-full">
                <input id="password_confirmation" 
                       class="input-modern @error('password_confirmation') border-red-500 ring-red-500 @enderror" 
                       type="password" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       placeholder="Confirm your password" />
            </div>
            @error('password_confirmation')
                <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 p-3 rounded-lg w-full">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div><!-- Register Button -->
        <div class="pt-4">
            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 text-white font-semibold rounded-xl bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-green-500/25">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Create Account
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm mb-3">Already have an account?</p>
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 text-gray-700 font-semibold rounded-xl bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-md hover:shadow-lg w-full">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Sign In Instead
            </a>
        </div>
    </form>
</x-guest-layout>
