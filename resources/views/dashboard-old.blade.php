@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Welcome back, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-600">Manage your posted items and browse the latest lost and found items.</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('items.create') }}" class="bg-indigo-600 text-white p-6 rounded-lg hover:bg-indigo-700 transition duration-150">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <div>
                            <h4 class="text-lg font-semibold">Post New Item</h4>
                            <p class="text-indigo-200">Report lost or found items</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('items.index') }}" class="bg-green-600 text-white p-6 rounded-lg hover:bg-green-700 transition duration-150">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <div>
                            <h4 class="text-lg font-semibold">Browse Items</h4>
                            <p class="text-green-200">Search lost and found items</p>
                        </div>
                    </div>
                </a>

                <div class="bg-gray-600 text-white p-6 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <div>
                            <h4 class="text-lg font-semibold">{{ $myItems->total() }}</h4>
                            <p class="text-gray-200">Items you posted</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Items -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">My Items</h3>
                        <a href="{{ route('items.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Post New Item
                        </a>
                    </div>

                    @if($myItems->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($myItems as $item)                                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition duration-150">
                                    @if($item->hasImages())
                                        <img src="{{ Storage::url($item->images[0]) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-500">No image</span>
                                        </div>
                                    @endif
                                    
                                    <div class="p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="text-lg font-semibold text-gray-900">{{ $item->title }}</h4>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($item->type) }}
                                            </span>
                                        </div>
                                        
                                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($item->description, 80) }}</p>
                                        
                                        <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                                            <span>{{ $item->category->name }}</span>
                                            <span>{{ $item->created_at->diffForHumans() }}</span>
                                        </div>

                                        @if($item->expires_at && $item->expires_at->isPast())
                                            <div class="text-red-600 text-sm mb-3">
                                                Expired {{ $item->expires_at->diffForHumans() }}
                                            </div>
                                        @elseif($item->expires_at)
                                            <div class="text-yellow-600 text-sm mb-3">
                                                Expires {{ $item->expires_at->diffForHumans() }}
                                            </div>
                                        @endif
                                        
                                        <div class="flex justify-between items-center">
                                            <a href="{{ route('items.show', $item) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                                                View Details
                                            </a>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('items.edit', $item) }}" class="text-yellow-600 hover:text-yellow-900 text-sm">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('items.destroy', $item) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm" 
                                                            onclick="return confirm('Are you sure you want to delete this item?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $myItems->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No items</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by posting your first item.</p>
                            <div class="mt-6">
                                <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Post Item
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
