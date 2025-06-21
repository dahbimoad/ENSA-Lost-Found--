<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ENSA Lost & Found') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                    }
                }
            }
        }
    </script>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceGentle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg animate-fade-in">
                        <div class="flex">
                            <svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-green-700 font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg animate-fade-in">
                        <div class="flex">
                            <svg class="h-5 w-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-red-700 font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>            @endif            <!-- Demo Notice Banner - Always Visible -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-lg font-semibold">🚀 This is a Demo Application</p>
                                <p class="text-blue-100 text-sm">
                                    Explore the features of ENSA Lost & Found platform
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <a href="https://drive.google.com/file/d/1R7US8Zsi7cxH2-fc9AObroWojF5rnqxz/view?usp=sharing" 
                               target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg text-white font-medium transition-all duration-200 hover:scale-105 backdrop-blur-sm border border-white/20">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                Watch Demo
                            </a>
                            
                            <a href="https://github.com/dahbimoad/ENSA-Lost-Found--.git" 
                               target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg text-white font-medium transition-all duration-200 hover:scale-105 backdrop-blur-sm border border-white/20">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.30.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                                Source Code
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="relative gradient-bg overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="absolute inset-0 h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                        <defs>
                            <pattern id="grid" width="4" height="4" patternUnits="userSpaceOnUse">
                                <path d="M 4 0 L 0 0 0 4" fill="none" stroke="white" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100" height="100" fill="url(#grid)" />
                    </svg>
                </div>
                
                <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
                    <div class="text-center animate-fade-in">
                        <!-- Main Logo/Icon -->
                        <div class="flex justify-center mb-8">
                            <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center animate-bounce-gentle">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                            ENSA Lost & Found
                        </h1>
                        <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto leading-relaxed">
                            Help your fellow students reunite with their lost belongings. 
                            <span class="block mt-2 text-lg opacity-80">Quick, easy, and secure way to find what matters most.</span>
                        </p>
                          <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                            @auth
                                <a href="{{ route('items.create') }}" class="inline-flex items-center px-8 py-4 text-purple-600 font-bold rounded-2xl bg-white hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-3xl border border-white/20">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Report Item
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 text-purple-600 font-bold rounded-2xl bg-white hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-3xl border border-white/20">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    Get Started
                                </a>
                            @endauth
                            <a href="{{ route('items.index') }}" class="inline-flex items-center px-8 py-4 text-white font-bold rounded-2xl bg-white/10 hover:bg-white/20 border border-white/30 transition-all duration-300 backdrop-blur-sm transform hover:scale-105 shadow-xl hover:shadow-2xl">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Browse Items
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Decorative bottom wave -->
                <div class="absolute bottom-0 left-0 right-0">
                    <svg class="w-full h-16 text-gray-50" preserveAspectRatio="none" viewBox="0 0 1200 120" fill="currentColor">
                        <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"></path>
                    </svg>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12 animate-slide-up">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Platform Statistics</h2>
                        <p class="text-lg text-gray-600">See how we're helping students find their belongings</p>
                    </div>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div class="glass-card p-8 rounded-2xl text-center hover-lift">
                            <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <div class="text-4xl font-bold text-gray-900 mb-2">{{ $stats['total_items'] ?? 0 }}</div>
                            <div class="text-gray-600 font-medium">Total Items</div>
                        </div>
                        <div class="glass-card p-8 rounded-2xl text-center hover-lift">
                            <div class="w-16 h-16 bg-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="text-4xl font-bold text-gray-900 mb-2">{{ $stats['lost_items'] ?? 0 }}</div>
                            <div class="text-gray-600 font-medium">Lost Items</div>
                        </div>
                        <div class="glass-card p-8 rounded-2xl text-center hover-lift">
                            <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <div class="text-4xl font-bold text-gray-900 mb-2">{{ $stats['found_items'] ?? 0 }}</div>
                            <div class="text-gray-600 font-medium">Found Items</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Browse by Category</h2>
                        <p class="text-lg text-gray-600">Find items quickly by browsing through categories</p>
                    </div>
                    @if(isset($categories) && $categories->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                            @foreach($categories as $category)
                                <a href="{{ route('items.index', ['category' => $category->id]) }}" class="glass-card p-6 rounded-2xl text-center hover-lift group">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-2xl">{{ $category->icon ?? '📦' }}</span>
                                    </div>
                                    <div class="text-gray-900 font-medium">{{ $category->name }}</div>
                                    <div class="text-sm text-gray-500 mt-1">{{ $category->items_count ?? 0 }} items</div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No categories yet</h3>
                            <p class="text-gray-500">Categories will appear here once items are posted.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Items Section -->
            <div class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Recent Lost Items -->
                        <div>
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">Recent Lost Items</h2>
                                    <p class="text-gray-600 mt-1">Help find these missing items</p>
                                </div>
                                <a href="{{ route('items.index', ['type' => 'lost']) }}" class="text-blue-600 hover:text-blue-700 font-medium">View all →</a>
                            </div>
                            
                            @if(isset($recentLostItems) && $recentLostItems->count() > 0)
                                <div class="space-y-4">
                                    @foreach($recentLostItems as $item)
                                        <div class="glass-card p-6 rounded-2xl hover-lift">
                                            <div class="flex items-start space-x-4">
                                                <div class="w-16 h-16 bg-red-100 rounded-xl flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <h3 class="font-semibold text-gray-900">{{ $item->title }}</h3>
                                                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($item->description, 80) }}</p>
                                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                                        <span>{{ $item->category->name ?? 'Uncategorized' }}</span>
                                                        <span class="mx-2">•</span>
                                                        <span>{{ $item->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No lost items yet</h3>
                                    <p class="text-gray-500">Recent lost items will appear here.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Recent Found Items -->
                        <div>
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">Recent Found Items</h2>
                                    <p class="text-gray-600 mt-1">Claim these found items</p>
                                </div>
                                <a href="{{ route('items.index', ['type' => 'found']) }}" class="text-blue-600 hover:text-blue-700 font-medium">View all →</a>
                            </div>
                            
                            @if(isset($recentFoundItems) && $recentFoundItems->count() > 0)
                                <div class="space-y-4">
                                    @foreach($recentFoundItems as $item)
                                        <div class="glass-card p-6 rounded-2xl hover-lift">
                                            <div class="flex items-start space-x-4">
                                                <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <h3 class="font-semibold text-gray-900">{{ $item->title }}</h3>
                                                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($item->description, 80) }}</p>
                                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                                        <span>{{ $item->category->name ?? 'Uncategorized' }}</span>
                                                        <span class="mx-2">•</span>
                                                        <span>{{ $item->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No found items yet</h3>
                                    <p class="text-gray-500">Recent found items will appear here.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="py-16 bg-white">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div class="glass-card p-12 rounded-3xl">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to get started?</h2>
                        <p class="text-lg text-gray-600 mb-8">Join thousands of students helping each other find their belongings</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            @guest
                                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    Create Account
                                </a>
                                <a href="{{ route('items.index') }}" class="inline-flex items-center px-8 py-4 bg-white text-gray-800 font-semibold rounded-2xl border border-gray-200 hover:bg-gray-50 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Browse Items
                                </a>
                            @else
                                <a href="{{ route('items.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Post an Item
                                </a>
                            @endguest
                        </div>                    </div>
                </div>
            </div>
        </main>

        <!-- MVP Notice Banner for Guests -->
        @guest
            <div id="mvp-notice" class="fixed bottom-0 left-0 right-0 bg-gradient-to-r from-amber-50 to-orange-50 border-t-4 border-amber-400 shadow-2xl z-50 transition-transform duration-500 ease-in-out" style="display: none;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-3 sm:space-y-0">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-amber-800 mb-1">
                                    🚧 MVP Version - ENSA Lost & Found
                                </h3>                                <p class="text-sm text-amber-700 leading-relaxed">
                                    This is a <strong>Minimum Viable Product (MVP)</strong> built exclusively with Laravel. 
                                    It's a demonstration project and may not be production-ready. Some features might be limited or simplified for rapid development and testing purposes.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 flex-shrink-0">
                            <button onclick="closeMvpNotice()" class="inline-flex items-center px-4 py-2 bg-amber-100 hover:bg-amber-200 text-amber-800 text-sm font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Got it
                            </button>
                        </div>
                    </div>
                </div>
            </div>        @endguest        @guest
        <script>
            // Show MVP notice immediately when page loads (unless previously dismissed)
            document.addEventListener('DOMContentLoaded', function() {
                // Check if user has already dismissed the notice
                if (!localStorage.getItem('mvp-notice-dismissed')) {
                    const notice = document.getElementById('mvp-notice');
                    if (notice) {
                        notice.style.display = 'block';
                    }
                }
            });
        </script>
        @endguest        <script>
            // Close MVP notice function
            function closeMvpNotice() {
                const notice = document.getElementById('mvp-notice');
                if (notice) {
                    notice.style.display = 'none';
                    // Remember that user dismissed the notice
                    localStorage.setItem('mvp-notice-dismissed', 'true');
                }
            }
        </script>
    </div>
</body>
</html>
