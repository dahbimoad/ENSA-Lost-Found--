@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
                    <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
                </div>
            </div>
            <a href="{{ route('items.create') }}" class="inline-flex items-center px-6 py-3 text-white font-semibold rounded-xl bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Post New Item
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <div class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 00-2 2v2m0 0V9a2 2 0 012-2h14a2 2 0 012 2v2M7 7V6a2 2 0 012-2h6a2 2 0 012 2v1"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_items'] }}</p>
                            <p class="text-gray-600 text-sm">Total Items</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['active_items'] }}</p>
                            <p class="text-gray-600 text-sm">Active</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['resolved_items'] }}</p>
                            <p class="text-gray-600 text-sm">Resolved</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['lost_items'] }}</p>
                            <p class="text-gray-600 text-sm">Lost Items</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['found_items'] }}</p>
                            <p class="text-gray-600 text-sm">Found Items</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('items.create') }}" class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transform hover:scale-105 transition-all duration-300 group">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">Post New Item</h4>
                            <p class="text-gray-600">Report lost or found items</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('items.index') }}" class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transform hover:scale-105 transition-all duration-300 group">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-300">Browse Items</h4>
                            <p class="text-gray-600">Search lost and found items</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="glass-effect rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transform hover:scale-105 transition-all duration-300 group">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900 group-hover:text-orange-600 transition-colors duration-300">Edit Profile</h4>
                            <p class="text-gray-600">Update your information</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- My Items Section -->
            <div class="glass-effect rounded-2xl shadow-lg border border-gray-100 mb-8">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 00-2 2v2m0 0V9a2 2 0 012-2h14a2 2 0 012 2v2M7 7V6a2 2 0 012-2h6a2 2 0 012 2v1"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">My Items</h3>
                        </div>
                        
                        <!-- Filters -->
                        <div class="flex items-center space-x-3">
                            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center space-x-3">
                                <select name="status" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" onchange="this.form.submit()">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                                <select name="type" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" onchange="this.form.submit()">
                                    <option value="">All Types</option>
                                    <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Lost</option>
                                    <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Found</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if($myItems->count() > 0)
                        <div class="space-y-4">
                            @foreach($myItems as $item)
                                <div class="bg-white rounded-xl border border-gray-100 p-4 hover:shadow-md transition-shadow duration-300">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            @if($item->hasImages())
                                                <img src="{{ Storage::url($item->images[0]) }}" alt="{{ $item->title }}" class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                                    <span class="text-2xl">{{ $item->category->icon ?? '📦' }}</span>
                                                </div>
                                            @endif
                                            
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-3 mb-1">
                                                    <h4 class="font-semibold text-gray-900">{{ $item->title }}</h4>
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $item->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                        {{ ucfirst($item->type) }}
                                                    </span>
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $item->status === 'active' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-600 text-sm mb-1">{{ Str::limit($item->description, 100) }}</p>
                                                <p class="text-gray-500 text-xs">{{ $item->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('items.show', $item) }}" class="inline-flex items-center px-3 py-2 text-blue-600 font-medium rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('items.edit', $item) }}" class="inline-flex items-center px-3 py-2 text-gray-600 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            
                                            @if($item->status === 'active')
                                                <form action="{{ route('items.resolve', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-2 text-green-600 font-medium rounded-lg hover:bg-green-50 transition-colors duration-200"
                                                            onclick="return confirm('Mark this item as resolved?')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Resolve
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('items.reactivate', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-2 text-blue-600 font-medium rounded-lg hover:bg-blue-50 transition-colors duration-200"
                                                            onclick="return confirm('Reactivate this item?')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                        </svg>
                                                        Reactivate
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $myItems->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 00-2 2v2m0 0V9a2 2 0 012-2h14a2 2 0 012 2v2M7 7V6a2 2 0 012-2h6a2 2 0 012 2v1"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No items found</h3>
                            <p class="text-gray-600 mb-6">You haven't posted any items yet. Start by posting your first lost or found item.</p>
                            <a href="{{ route('items.create') }}" class="inline-flex items-center px-6 py-3 text-white font-semibold rounded-xl bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Post Your First Item
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            @if($recentActivity->count() > 0)
                <div class="glass-effect rounded-2xl shadow-lg border border-gray-100">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Recent Resolutions</h3>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentActivity as $activity)
                                <div class="flex items-center space-x-4 p-3 bg-green-50 rounded-lg border border-green-100">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">{{ $activity->title }}</p>
                                        <p class="text-green-700 text-sm">{{ ucfirst($activity->type) }} item marked as resolved</p>
                                        <p class="text-gray-500 text-xs">{{ $activity->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <a href="{{ route('items.show', $activity) }}" class="text-green-600 hover:text-green-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
