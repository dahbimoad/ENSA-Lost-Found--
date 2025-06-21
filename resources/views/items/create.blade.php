<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Post New Item</h2>
                <p class="text-gray-600">Help your community find lost belongings</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-effect rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-8 py-6 border-b border-gray-100">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Create New Listing</h3>
                        <p class="text-gray-600">Fill out the form below to post your lost or found item</p>
                    </div>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data" class="space-y-8" id="itemForm">
                        @csrf
                        
                        <!-- Item Type Selection (Visual Cards) -->
                        <div class="space-y-4">
                            <label class="block text-lg font-semibold text-gray-900">
                                What type of item is this? <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="type" value="lost" class="sr-only peer" {{ old('type') == 'lost' ? 'checked' : '' }} required>
                                    <div class="p-6 bg-white border-2 border-gray-200 rounded-2xl peer-checked:border-red-500 peer-checked:bg-red-50 transition-all duration-300 hover:border-red-300 group">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center group-hover:bg-red-200 peer-checked:bg-red-500 transition-colors duration-300">
                                                <svg class="w-6 h-6 text-red-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">Lost Item</h4>
                                                <p class="text-sm text-gray-600">I've lost something and need help finding it</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="type" value="found" class="sr-only peer" {{ old('type') == 'found' ? 'checked' : '' }} required>
                                    <div class="p-6 bg-white border-2 border-gray-200 rounded-2xl peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-300 hover:border-green-300 group">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center group-hover:bg-green-200 peer-checked:bg-green-500 transition-colors duration-300">
                                                <svg class="w-6 h-6 text-green-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">Found Item</h4>
                                                <p class="text-sm text-gray-600">I found something and want to return it</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="text-red-600 text-sm mt-1 hidden" id="type-error">Please select whether this is a lost or found item</div>
                            @error('type')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="space-y-2">
                            <label for="title" class="block text-lg font-semibold text-gray-900">
                                Item Title <span class="text-red-500">*</span>
                            </label>
                            <p class="text-sm text-gray-600">Give your item a clear, descriptive title</p>
                            <input id="title" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" 
                                   type="text" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required 
                                   autofocus 
                                   maxlength="255"
                                   placeholder="e.g., Black iPhone 13 with purple case" />
                            <div class="text-red-600 text-sm mt-1 hidden" id="title-error">Please enter a descriptive title for your item</div>
                            @error('title')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="space-y-2">
                            <label for="description" class="block text-lg font-semibold text-gray-900">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <p class="text-sm text-gray-600">Provide as many details as possible to help identify the item</p>
                            <textarea id="description" 
                                      name="description" 
                                      rows="5" 
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" 
                                      required 
                                      placeholder="Describe the item in detail - color, size, brand, distinctive features, condition, etc.">{{ old('description') }}</textarea>
                            <div class="text-red-600 text-sm mt-1 hidden" id="description-error">Please provide a detailed description of the item</div>
                            @error('description')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="space-y-2">
                            <label for="category_id" class="block text-lg font-semibold text-gray-900">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <p class="text-sm text-gray-600">Select the category that best describes your item</p>
                            <div class="relative">
                                <select id="category_id" 
                                        name="category_id" 
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300 appearance-none bg-white" 
                                        required>
                                    <option value="">Choose a category...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            <div class="text-red-600 text-sm mt-1 hidden" id="category-error">Please select a category for your item</div>
                            @error('category_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Location and Date in a Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Location -->
                            <div class="space-y-2">
                                <label for="location" class="block font-semibold text-gray-900">
                                    <svg class="w-5 h-5 inline mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Location
                                </label>
                                <input id="location" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" 
                                       type="text" 
                                       name="location" 
                                       value="{{ old('location') }}" 
                                       placeholder="e.g., Library 2nd floor, Building A" />
                                @error('location')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Date Found/Lost -->
                            <div class="space-y-2">
                                <label for="date_found" class="block font-semibold text-gray-900">
                                    <svg class="w-5 h-5 inline mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Date Found/Lost
                                </label>
                                <input id="date_found" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" 
                                       type="date" 
                                       name="date_found" 
                                       value="{{ old('date_found') }}" />
                                @error('date_found')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Images Upload -->
                        <div class="space-y-4">
                            <label for="images" class="block text-lg font-semibold text-gray-900">
                                <svg class="w-5 h-5 inline mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Photos
                            </label>
                            <p class="text-sm text-gray-600">Add photos to help others identify the item (optional but recommended)</p>
                            
                            <div class="relative">
                                <input id="images" 
                                       class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" 
                                       type="file" 
                                       name="images[]" 
                                       multiple 
                                       accept="image/*" />
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="text-sm text-gray-500">Drop images here or click to browse</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">Supported formats: JPG, PNG, GIF. Maximum 5 images.</p>
                            @error('images')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Optional Reward (for lost items) -->
                        <div class="space-y-2" id="reward-section" style="display: none;">
                            <label for="reward" class="block font-semibold text-gray-900">
                                <svg class="w-5 h-5 inline mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                </svg>
                                Reward (Optional)
                            </label>
                            <p class="text-sm text-gray-600">Offer a reward to encourage people to help find your item</p>
                            <div class="relative">
                                <input id="reward" 
                                       class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" 
                                       type="number" 
                                       name="reward" 
                                       value="{{ old('reward') }}" 
                                       min="0" 
                                       step="0.01"
                                       placeholder="0.00" />
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">MAD</span>
                                </div>
                            </div>
                            @error('reward')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Expires At -->
                        <div class="space-y-2">
                            <label for="expires_at" class="block font-semibold text-gray-900">
                                <svg class="w-5 h-5 inline mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Auto-remove Date (Optional)
                            </label>
                            <p class="text-sm text-gray-600">Set a date when this listing should be automatically removed</p>
                            <input id="expires_at" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-0 transition-all duration-300" 
                                   type="date" 
                                   name="expires_at" 
                                   value="{{ old('expires_at') }}" />
                            @error('expires_at')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>                        <!-- Submit Area -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                            <a href="{{ route('items.index') }}" 
                               class="flex-1 text-center inline-flex items-center justify-center px-6 py-3 text-gray-700 font-semibold rounded-xl bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" 
                                    id="submitBtn" 
                                    class="flex-1 inline-flex items-center justify-center px-6 py-3 text-white font-semibold rounded-xl bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 ease-in-out shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-green-500/25">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span id="submit-text">Create Listing</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('itemForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submit-text');
            const typeRadios = document.querySelectorAll('input[name="type"]');
            const rewardSection = document.getElementById('reward-section');
            
            // Required fields
            const requiredFields = {
                'title': 'title-error',
                'description': 'description-error', 
                'category_id': 'category-error'
            };

            // Show/hide reward section based on item type
            function toggleRewardSection() {
                const selectedType = document.querySelector('input[name="type"]:checked');
                if (selectedType && selectedType.value === 'lost') {
                    rewardSection.style.display = 'block';
                } else {
                    rewardSection.style.display = 'none';
                }
            }

            // Add event listeners to type radio buttons
            typeRadios.forEach(radio => {
                radio.addEventListener('change', toggleRewardSection);
            });

            // Initial check
            toggleRewardSection();

            // Validation functions
            function validateField(fieldName) {
                const field = document.getElementById(fieldName);
                const errorElement = document.getElementById(requiredFields[fieldName]);
                
                if (!field.value.trim()) {
                    field.classList.add('border-red-300', 'ring-red-500');
                    field.classList.remove('border-gray-200');
                    if (errorElement) errorElement.classList.remove('hidden');
                    return false;
                } else {
                    field.classList.remove('border-red-300', 'ring-red-500');
                    field.classList.add('border-gray-200');
                    if (errorElement) errorElement.classList.add('hidden');
                    return true;
                }
            }

            function validateType() {
                const typeSelected = document.querySelector('input[name="type"]:checked');
                const errorElement = document.getElementById('type-error');
                
                if (!typeSelected) {
                    errorElement.classList.remove('hidden');
                    return false;
                } else {
                    errorElement.classList.add('hidden');
                    return true;
                }
            }

            function validateForm() {
                let isValid = true;
                
                // Validate type
                if (!validateType()) {
                    isValid = false;
                }
                
                // Validate other required fields
                Object.keys(requiredFields).forEach(fieldName => {
                    if (!validateField(fieldName)) {
                        isValid = false;
                    }
                });
                
                return isValid;
            }

            // Real-time validation
            Object.keys(requiredFields).forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field) {
                    field.addEventListener('blur', () => validateField(fieldName));
                    field.addEventListener('input', () => validateField(fieldName));
                    field.addEventListener('change', () => validateField(fieldName));
                }
            });

            // Type validation
            typeRadios.forEach(radio => {
                radio.addEventListener('change', validateType);
            });

            // File input enhancement
            const fileInput = document.getElementById('images');
            fileInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                if (files.length > 0) {
                    const fileNames = files.map(file => file.name).join(', ');
                    console.log('Selected files:', fileNames);
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    
                    // Scroll to first error
                    const firstError = document.querySelector('.border-red-300') || document.querySelector('.text-red-600:not(.hidden)');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        if (firstError.focus) firstError.focus();
                    }
                    
                    return false;
                }
                  // Disable submit button and show loading state
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                submitBtn.classList.remove('hover:scale-105'); // Remove hover effect during loading
                submitText.textContent = 'Creating...';
                
                // Add loading spinner
                submitText.innerHTML = `
                    <svg class="animate-spin w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Creating Listing...
                `;
            });
        });
    </script>
</x-app-layout>
