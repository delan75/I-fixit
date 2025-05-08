<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <!-- First Name -->
                        <div class="mt-4">
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name', $user->first_name)" required autofocus />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div class="mt-4">
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $user->phone)" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Gender -->
                        <div class="mt-4">
                            <x-input-label :value="__('Gender')" />
                            <div class="mt-2 flex space-x-6">
                                <div class="flex items-center">
                                    <input id="gender-male" name="gender" type="radio" value="male" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                    <label for="gender-male" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Male') }}</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="gender-female" name="gender" type="radio" value="female" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                    <label for="gender-female" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Female') }}</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="gender-other" name="gender" type="radio" value="other" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('gender', $user->gender) == 'other' ? 'checked' : '' }}>
                                    <label for="gender-other" class="ml-2 block text-sm font-medium leading-6 text-gray-900">{{ __('Other') }}</label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <!-- Role (Only visible to admins and superusers) -->
                        @if(Auth::user()->hasAdminAccess())
                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="user" {{ (old('role', $user->role) == 'user') ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>
                        @endif

                        <!-- Superuser Status (Only visible to superusers) -->
                        @if(Auth::user()->isSuperuser())
                        <div class="mt-4">
                            <div class="flex items-center">
                                <input id="is_superuser" name="is_superuser" type="checkbox" value="1" {{ old('is_superuser', $user->is_superuser) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_superuser" class="ml-2 block text-sm text-gray-900">{{ __('Grant Superuser Privileges') }}</label>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">{{ __('Superusers have full access to all system features, including activity logs and user management.') }}</p>
                            <x-input-error :messages="$errors->get('is_superuser')" class="mt-2" />
                        </div>
                        @endif

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password (leave blank to keep current)')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ Auth::user()->role === 'admin' ? route('users.index') : route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update User') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
