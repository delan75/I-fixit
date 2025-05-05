<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Damaged Part') }}: {{ $car->year }} {{ $car->make }} {{ $car->model }}
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
                    <form action="{{ route('damaged_parts.update', [$car, $damagedPart]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Damaged Part Information') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="part_name" :value="__('Part Name')" />
                                    <x-text-input id="part_name" class="block mt-1 w-full" type="text" name="part_name" :value="old('part_name', $damagedPart->part_name)" required autofocus />
                                    <x-input-error :messages="$errors->get('part_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="part_location" :value="__('Part Location')" />
                                    <select id="part_location" name="part_location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                                        <option value="">{{ __('Select Location') }}</option>
                                        <option value="Front" {{ old('part_location', $damagedPart->part_location) == 'Front' ? 'selected' : '' }}>{{ __('Front') }}</option>
                                        <option value="Rear" {{ old('part_location', $damagedPart->part_location) == 'Rear' ? 'selected' : '' }}>{{ __('Rear') }}</option>
                                        <option value="Left Side" {{ old('part_location', $damagedPart->part_location) == 'Left Side' ? 'selected' : '' }}>{{ __('Left Side') }}</option>
                                        <option value="Right Side" {{ old('part_location', $damagedPart->part_location) == 'Right Side' ? 'selected' : '' }}>{{ __('Right Side') }}</option>
                                        <option value="Interior" {{ old('part_location', $damagedPart->part_location) == 'Interior' ? 'selected' : '' }}>{{ __('Interior') }}</option>
                                        <option value="Engine Bay" {{ old('part_location', $damagedPart->part_location) == 'Engine Bay' ? 'selected' : '' }}>{{ __('Engine Bay') }}</option>
                                        <option value="Undercarriage" {{ old('part_location', $damagedPart->part_location) == 'Undercarriage' ? 'selected' : '' }}>{{ __('Undercarriage') }}</option>
                                        <option value="Trunk" {{ old('part_location', $damagedPart->part_location) == 'Trunk' ? 'selected' : '' }}>{{ __('Trunk') }}</option>
                                        <option value="Roof" {{ old('part_location', $damagedPart->part_location) == 'Roof' ? 'selected' : '' }}>{{ __('Roof') }}</option>
                                        <option value="Other" {{ old('part_location', $damagedPart->part_location) == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('part_location')" class="mt-2" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="damage_description" :value="__('Damage Description')" />
                                    <textarea id="damage_description" name="damage_description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>{{ old('damage_description', $damagedPart->damage_description) }}</textarea>
                                    <x-input-error :messages="$errors->get('damage_description')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="estimated_repair_cost" :value="__('Estimated Repair Cost (R)')" />
                                    <x-text-input id="estimated_repair_cost" class="block mt-1 w-full" type="number" name="estimated_repair_cost" :value="old('estimated_repair_cost', $damagedPart->estimated_repair_cost)" min="0" step="0.01" required />
                                    <x-input-error :messages="$errors->get('estimated_repair_cost')" class="mt-2" />
                                </div>

                                <div class="flex items-center mt-8">
                                    <input id="is_repaired" type="checkbox" name="is_repaired" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" {{ old('is_repaired', $damagedPart->is_repaired) ? 'checked' : '' }}>
                                    <label for="is_repaired" class="ml-2 text-sm text-gray-600">{{ __('This part has been repaired') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Add More Images (Optional)') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="images" :value="__('Upload Images')" />
                                    <input id="images" type="file" name="images[]" multiple class="mt-1 block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-green-50 file:text-green-700
                                        hover:file:bg-green-100" />
                                    <p class="mt-1 text-sm text-gray-500">{{ __('You can upload multiple images of the damaged part. Accepted formats: JPG, PNG, GIF.') }}</p>
                                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="image_description" :value="__('Image Description (Optional)')" />
                                    <x-text-input id="image_description" class="block mt-1 w-full" type="text" name="image_description" :value="old('image_description')" />
                                    <x-input-error :messages="$errors->get('image_description')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        @if($damagedPart->images->count() > 0)
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Existing Images') }}</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach($damagedPart->images as $image)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->description }}" class="h-40 w-full object-cover rounded-md">
                                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center rounded-md">
                                                <div class="text-white text-center p-2">
                                                    @if($image->description)
                                                        <p class="text-xs">{{ $image->description }}</p>
                                                    @endif
                                                    <form action="{{ route('damaged_part_images.destroy', [$car, $damagedPart, $image]) }}" method="POST" class="mt-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-xs text-red-300 hover:text-red-100" onclick="return confirm('Are you sure you want to delete this image?')">{{ __('Delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-3">
                                {{ __('Update Damaged Part') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
