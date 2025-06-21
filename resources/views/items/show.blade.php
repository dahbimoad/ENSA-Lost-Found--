@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-xl text-gray-800 leading-tight">{{ $item->title }}</h2>
                    <div class="flex items-center space-x-2 mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($item->type) }}
                        </span>
                        <span class="text-gray-500 text-sm">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            @can('update', $item)
                <div class="flex space-x-2">
                    <a href="{{ route('items.edit', $item) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 hover:border-yellow-300 transition duration-200 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <form method="POST" action="{{ route('items.destroy', $item) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition duration-200 ease-in-out" 
                                onclick="return confirm('Are you sure you want to delete this item?')">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Item Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- Item Images -->
                    <div class="relative">
                        @if($item->hasImages())
                            <div class="h-96 lg:h-full min-h-[400px]">
                                @if(count($item->images) > 1)
                                    <!-- Image carousel for multiple images -->
                                    <div class="relative h-full" x-data="{ currentImage: 0, images: {{ json_encode($item->images) }} }">
                                        <template x-for="(image, index) in images" :key="index">
                                            <img x-show="currentImage === index" 
                                                 :src="`{{ Storage::url('') }}${image}`" 
                                                 :alt="`{{ $item->title }} - Image ${index + 1}`" 
                                                 class="w-full h-full object-cover transition-opacity duration-300">
                                        </template>
                                        
                                        <!-- Navigation arrows -->
                                        <button @click="currentImage = currentImage > 0 ? currentImage - 1 : images.length - 1" 
                                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-70 transition duration-200">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </button>
                                        <button @click="currentImage = currentImage < images.length - 1 ? currentImage + 1 : 0" 
                                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-70 transition duration-200">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                        
                                        <!-- Image indicators -->
                                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                                            <template x-for="(image, index) in images" :key="index">
                                                <button @click="currentImage = index" 
                                                        :class="currentImage === index ? 'bg-white' : 'bg-white bg-opacity-50'" 
                                                        class="w-3 h-3 rounded-full transition duration-200"></button>
                                            </template>
                                        </div>
                                    </div>
                                @else
                                    <img src="{{ Storage::url($item->images[0]) }}" 
                                         alt="{{ $item->title }}" 
                                         class="w-full h-full object-cover">
                                @endif
                            </div>
                        @else
                            <div class="h-96 lg:h-full min-h-[400px] bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center">
                                <svg class="w-24 h-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-500 text-lg font-medium">No image available</span>
                            </div>
                        @endif
                        
                        <!-- Status badge overlay -->
                        <div class="absolute top-6 left-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium shadow-lg {{ $item->type === 'lost' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                                @if($item->type === 'lost')
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @endif
                                {{ ucfirst($item->type) }}
                            </span>
                        </div>
                    </div>

                    <!-- Item Details -->
                    <div class="p-8 lg:p-10">
                        <div class="space-y-6">
                            <!-- Title and Description -->
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $item->title }}</h1>
                                <p class="text-gray-700 leading-relaxed">{{ $item->description }}</p>
                            </div>

                            <!-- Details Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <h4 class="font-semibold text-gray-900">Category</h4>
                                    </div>
                                    <p class="text-gray-700">{{ $item->category->name }}</p>
                                </div>

                                @if($item->location)
                                    <div class="bg-green-50 rounded-lg p-4">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <h4 class="font-semibold text-gray-900">Location</h4>
                                        </div>
                                        <p class="text-gray-700">{{ $item->location }}</p>
                                    </div>
                                @endif

                                @if($item->date_found)
                                    <div class="bg-purple-50 rounded-lg p-4">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <h4 class="font-semibold text-gray-900">Date {{ $item->type === 'lost' ? 'Lost' : 'Found' }}</h4>
                                        </div>
                                        <p class="text-gray-700">{{ $item->date_found->format('F j, Y') }}</p>
                                    </div>
                                @endif

                                @if($item->expires_at)
                                    <div class="bg-orange-50 rounded-lg p-4">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h4 class="font-semibold text-gray-900">Expires</h4>
                                        </div>
                                        <p class="text-gray-700">{{ $item->expires_at->format('F j, Y') }}</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Posted by -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $item->user->name }}</h4>
                                        @if($item->user->student_id)
                                            <p class="text-sm text-gray-500">Student ID: {{ $item->user->student_id }}</p>
                                        @endif
                                        <p class="text-xs text-gray-400">Posted {{ $item->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>                            </div>

                            <!-- Item Management (Only for item owner) -->
                            @auth
                                @if(auth()->id() === $item->user_id)
                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200 mb-6">
                                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Manage Your Item
                                        </h4>
                                        <div class="flex flex-wrap gap-3">
                                            @if($item->status === 'active')                                                <form action="{{ route('items.resolve', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-4 py-2 text-white font-semibold rounded-lg bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-md hover:shadow-lg"
                                                            onclick="return confirm('Are you sure you want to mark this item as resolved?')">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Mark as {{ $item->type === 'lost' ? 'Found' : 'Returned' }}
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('items.reactivate', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-4 py-2 text-white font-semibold rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-md hover:shadow-lg"
                                                            onclick="return confirm('Reactivate this item listing?')">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                        </svg>
                                                        Reactivate
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <a href="{{ route('items.edit', $item) }}" 
                                               class="inline-flex items-center px-4 py-2 text-gray-700 font-semibold rounded-lg bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-md hover:shadow-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit Item
                                            </a>
                                            
                                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-4 py-2 text-white font-semibold rounded-lg bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-md hover:shadow-lg"
                                                        onclick="return confirm('Are you sure you want to delete this item? This action cannot be undone.')">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                        
                                        @if($item->status === 'resolved')
                                            <div class="mt-3 p-3 bg-green-100 border border-green-200 rounded-lg">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="text-green-800 font-medium">
                                                        This item has been marked as {{ $item->type === 'lost' ? 'found' : 'returned' }}!
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endauth

                            <!-- Contact Information -->
                            <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-200">
                                <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Contact Information
                                </h4>
                                @auth
                                    <div class="space-y-3">
                                        @if($item->user->show_email && $item->user->email)
                                            <a href="mailto:{{ $item->user->email }}" 
                                               class="flex items-center space-x-3 p-3 bg-white rounded-lg hover:bg-blue-50 transition duration-200 group">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition duration-200">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">Send Email</p>
                                                    <p class="text-sm text-gray-500">{{ $item->user->email }}</p>
                                                </div>
                                            </a>
                                        @endif
                                        
                                        @if($item->user->show_whatsapp && $item->user->whatsapp)
                                            <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $item->user->whatsapp) }}" 
                                               target="_blank" 
                                               class="flex items-center space-x-3 p-3 bg-white rounded-lg hover:bg-green-50 transition duration-200 group">
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200 transition duration-200">
                                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">WhatsApp</p>
                                                    <p class="text-sm text-gray-500">{{ $item->user->whatsapp }}</p>
                                                </div>
                                            </a>
                                        @endif
                                        
                                        @if((!$item->user->show_email || !$item->user->email) && 
                                            (!$item->user->show_whatsapp || !$item->user->whatsapp))
                                            <p class="text-gray-500 text-center py-4">
                                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                                No contact information available
                                            </p>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-center py-6">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        <p class="text-gray-500 mb-4">Please login to see contact details</p>
                                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-700 bg-indigo-100 border border-indigo-200 rounded-lg hover:bg-indigo-200 hover:border-indigo-300 transition duration-200 ease-in-out">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            Login to Contact
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Similar Items -->
            @if($similarItems->count() > 0)
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Similar Items</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($similarItems as $similarItem)
                            <div class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-lg transition duration-300 group">
                                <div class="relative">
                                    @if($similarItem->hasImages())
                                        <img src="{{ Storage::url($similarItem->images[0]) }}" 
                                             alt="{{ $similarItem->title }}" 
                                             class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center group-hover:from-gray-300 group-hover:to-gray-400 transition duration-300">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $similarItem->type === 'lost' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                                            {{ ucfirst($similarItem->type) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition duration-200">{{ $similarItem->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($similarItem->description, 80) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500">{{ $similarItem->created_at->diffForHumans() }}</span>
                                        <a href="{{ route('items.show', $similarItem) }}" 
                                           class="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 hover:border-indigo-300 transition duration-200 ease-in-out">
                                            View
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
