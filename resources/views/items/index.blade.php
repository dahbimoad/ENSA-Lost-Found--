@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Browse Items</h2>
                    <p class="text-gray-600">Find lost items or browse found belongings</p>
                </div>
            </div>            @auth
                <a href="{{ route('items.create') }}" class="inline-flex items-center px-6 py-3 text-white font-semibold rounded-xl bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Post Item
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filters -->
            <div class="glass-effect rounded-2xl shadow-lg mb-8 border">
                <div class="p-6">
                    <form method="GET" action="{{ route('items.index') }}" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search items..." class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300">
                            </div>
                            
                            <!-- Type Filter -->
                            <div class="relative">
                                <select name="type" class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300 appearance-none bg-white">
                                    <option value="">All Types</option>
                                    <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>🔍 Lost Items</option>
                                    <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>✅ Found Items</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Category Filter -->
                            <div class="relative">
                                <select name="category" class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300 appearance-none bg-white">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->icon }} {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                              <!-- Search Button -->
                            <div>
                                <button type="submit" class="w-full px-6 py-3 text-white font-semibold rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition duration-200 ease-in-out shadow-lg hover:shadow-xl inline-flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            <!-- Items Grid -->
            @if($items->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($items as $item)
                        <div class="glass-effect rounded-2xl shadow-lg overflow-hidden card-hover border border-gray-100 group">                            @if($item->images && count($item->images) > 0)
                                <div class="relative overflow-hidden">
                                    <!-- Debug: Show the image URL -->
                                    @if(config('app.debug'))
                                        <div class="absolute top-0 left-0 bg-black bg-opacity-75 text-white text-xs p-1 z-10">
                                            URL: {{ Storage::url($item->images[0]) }}
                                        </div>
                                    @endif
                                    <img src="{{ Storage::url($item->images[0]) }}" 
                                         alt="{{ $item->title }}" 
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                         onerror="console.log('Image failed to load:', this.src); this.parentElement.innerHTML='<div class=\'h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center\'><div class=\'text-center\'><div class=\'text-4xl text-gray-400 mb-2\'>📷</div><p class=\'text-sm text-gray-500\'>Image not found</p><p class=\'text-xs text-gray-400\'>' + this.src + '</p></div></div>';">
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full backdrop-blur-sm border {{ $item->type == 'lost' ? 'bg-red-100/90 text-red-800 border-red-200' : 'bg-green-100/90 text-green-800 border-green-200' }}">
                                            {{ $item->type == 'lost' ? '🔍 Lost' : '✅ Found' }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative">
                                    <div class="text-6xl text-gray-300">
                                        {{ $item->category->icon ?? '📦' }}
                                    </div>
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full backdrop-blur-sm border {{ $item->type == 'lost' ? 'bg-red-100/90 text-red-800 border-red-200' : 'bg-green-100/90 text-green-800 border-green-200' }}">
                                            {{ $item->type == 'lost' ? '🔍 Lost' : '✅ Found' }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <!-- Category and Type -->
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl">{{ $item->category->icon ?? '📦' }}</span>
                                        <span class="text-sm text-gray-600 font-medium">{{ $item->category->name ?? 'Other' }}</span>
                                    </div>
                                    @if($item->reward)
                                        <div class="flex items-center text-green-600 text-sm font-semibold">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ number_format($item->reward, 2) }} MAD
                                        </div>
                                    @endif
                                </div>

                                <!-- Title -->
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $item->title }}
                                </h3>

                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    {{ Str::limit($item->description, 100) }}
                                </p>

                                <!-- Location and Date -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $item->location }}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $item->date_found ? $item->date_found->format('M d, Y') : 'Date not specified' }}
                                    </div>
                                </div>

                                <!-- Contact Options -->
                                @auth
                                    <div class="flex items-center space-x-3 mb-4">
                                        @if($item->user->show_email && $item->user->email)
                                            <a href="mailto:{{ $item->user->email }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200 text-sm font-medium">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                Email
                                            </a>
                                        @endif
                                        @if($item->user->show_whatsapp && $item->user->whatsapp)
                                            <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $item->user->whatsapp) }}" 
                                               target="_blank" 
                                               class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors duration-200 text-sm font-medium">
                                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.346"/>
                                                </svg>
                                                WhatsApp
                                            </a>
                                        @endif
                                    </div>
                                @endauth
                                  <!-- Action Area -->
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <a href="{{ route('items.show', $item) }}" class="inline-flex items-center px-4 py-2 text-white font-semibold text-sm rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-md hover:shadow-lg group">
                                        View Details
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                    <div class="flex items-center text-xs text-gray-400">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $item->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $items->appends(request()->query())->links() }}
                </div>
            @else
                <div class="glass-effect rounded-2xl shadow-lg p-12 text-center border">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No items found</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto leading-relaxed">
                        We couldn't find any items matching your search criteria. Try adjusting your filters or search terms.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">                        @auth
                            <a href="{{ route('items.create') }}" class="inline-flex items-center justify-center px-6 py-3 text-white font-semibold rounded-xl bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Post New Item
                            </a>
                        @else<a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 text-white font-semibold rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                Register to Post Items
                            </a>
                        @endauth                        <a href="{{ route('items.index') }}" class="inline-flex items-center justify-center px-6 py-3 text-gray-700 font-semibold rounded-xl bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Clear Filters
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
