@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">My Dashboard</h2>
                <p class="text-gray-600">Manage your lost and found items</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Message -->
            <div class="glass-effect rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-8 py-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center">
                            <span class="text-white text-xl font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h3>
                            <p class="text-gray-600">Here's what's happening with your items today.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('items.create') }}" class="group">
                    <div class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100 card-hover group-hover:border-blue-300 transition-all duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">Post Item</h4>
                                <p class="text-gray-600 text-sm">Report a lost or found item</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('items.index') }}" class="group">
                    <div class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100 card-hover group-hover:border-blue-300 transition-all duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">Browse Items</h4>
                                <p class="text-gray-600 text-sm">Search lost and found items</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="group">
                    <div class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100 card-hover group-hover:border-blue-300 transition-all duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">Edit Profile</h4>
                                <p class="text-gray-600 text-sm">Update your account settings</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- My Items Section -->
            <div class="glass-effect rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">My Items</h3>
                        </div>
                        @if($myItems->count() > 0)
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                {{ $myItems->count() }} {{ $myItems->count() === 1 ? 'item' : 'items' }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-8">
                    @if($myItems->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($myItems as $item)
                                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden card-hover group">
                                    @if($item->hasImages())
                                        <div class="relative">
                                            <img src="{{ Storage::url($item->images[0]) }}" alt="{{ $item->title }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                            <div class="absolute top-3 right-3">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full backdrop-blur-sm border {{ $item->type == 'lost' ? 'bg-red-100/90 text-red-800 border-red-200' : 'bg-green-100/90 text-green-800 border-green-200' }}">
                                                    {{ $item->type == 'lost' ? '🔍 Lost' : '✅ Found' }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="h-40 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative">
                                            <div class="text-4xl text-gray-300">
                                                {{ $item->category->icon ?? '📦' }}
                                            </div>
                                            <div class="absolute top-3 right-3">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full backdrop-blur-sm border {{ $item->type == 'lost' ? 'bg-red-100/90 text-red-800 border-red-200' : 'bg-green-100/90 text-green-800 border-green-200' }}">
                                                    {{ $item->type == 'lost' ? '🔍 Lost' : '✅ Found' }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="p-5">
                                        <h4 class="font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">{{ $item->title }}</h4>
                                        <p class="text-sm text-gray-600 mb-3 leading-relaxed">{{ Str::limit($item->description, 80) }}</p>
                                        
                                        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                </svg>
                                                {{ $item->location ?: 'No location' }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        
                                        @if($item->expires_at)
                                            <div class="mb-3 text-xs">
                                                @if($item->expires_at->isPast())
                                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full">
                                                        Expired {{ $item->expires_at->diffForHumans() }}
                                                    </span>
                                                @else
                                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">
                                                        Expires {{ $item->expires_at->diffForHumans() }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                        
                                        <div class="flex space-x-2">
                                            <a href="{{ route('items.show', $item) }}" class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-700 text-center py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200">
                                                View
                                            </a>
                                            <a href="{{ route('items.edit', $item) }}" class="flex-1 bg-gray-50 hover:bg-gray-100 text-gray-700 text-center py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200">
                                                Edit
                                            </a>
                                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-700 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($myItems->hasPages())
                            <div class="mt-8">
                                {{ $myItems->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No items yet</h3>
                            <p class="text-gray-600 mb-6 max-w-md mx-auto">You haven't posted any lost or found items yet. Start helping your community by posting your first item!</p>
                            <a href="{{ route('items.create') }}" class="btn-primary inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Post Your First Item
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
