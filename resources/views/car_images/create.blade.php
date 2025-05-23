<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Images') }}: {{ $car->year }} {{ $car->make }} {{ $car->model }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('cars.show', $car) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Back to Car Details') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('car_images.store', $car) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Upload Images') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="images" :value="__('Select Images')" />
                                    <input id="images" type="file" name="images[]" multiple class="mt-1 block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-green-50 file:text-green-700
                                        hover:file:bg-green-100" required />
                                    <p class="mt-1 text-sm text-gray-500">{{ __('You can upload multiple images. Accepted formats: JPG, PNG, GIF, WebP.') }}</p>
                                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="image_type" :value="__('Image Type')" />
                                    <select id="image_type" name="image_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="before_repair" {{ old('image_type') == 'before_repair' ? 'selected' : '' }}>{{ __('Before Repair') }}</option>
                                        <option value="during_repair" {{ old('image_type') == 'during_repair' ? 'selected' : '' }}>{{ __('During Repair') }}</option>
                                        <option value="after_repair" {{ old('image_type') == 'after_repair' ? 'selected' : '' }}>{{ __('After Repair') }}</option>
                                        <option value="damage" {{ old('image_type') == 'damage' ? 'selected' : '' }}>{{ __('Damage') }}</option>
                                        <option value="dealership" {{ old('image_type') == 'dealership' ? 'selected' : '' }}>{{ __('Dealership') }}</option>
                                        <option value="other" {{ old('image_type') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('image_type')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="description" :value="__('Description (Optional)')" />
                                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-3">
                                {{ __('Upload Images') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
