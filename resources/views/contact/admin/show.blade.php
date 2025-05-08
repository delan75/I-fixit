<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Contact Message Details') }}
            </h2>
            <a href="{{ route('contact.admin.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ __('Message from') }} {{ $contact->name ?? __('Anonymous') }}</h3>
                                <p class="text-sm text-gray-500">{{ __('Received on') }} {{ $contact->created_at->format('F j, Y, g:i a') }}</p>
                            </div>
                            <form action="{{ route('contact.admin.destroy', $contact) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('{{ __('Are you sure you want to delete this message?') }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    {{ __('Delete Message') }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">{{ __('Name') }}</h4>
                                <p class="mt-1">{{ $contact->name ?? __('Not provided') }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">{{ __('Email') }}</h4>
                                <p class="mt-1">
                                    @if($contact->email)
                                        <a href="mailto:{{ $contact->email }}" class="text-green-600 hover:text-green-800">
                                            {{ $contact->email }}
                                        </a>
                                    @else
                                        {{ __('Not provided') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">{{ __('Message') }}</h4>
                            <div class="mt-1 p-4 bg-white rounded border border-gray-200">
                                <p class="whitespace-pre-line">{{ $contact->message }}</p>
                            </div>
                        </div>
                    </div>

                    @if($contact->email)
                        <div class="mt-6">
                            <a href="mailto:{{ $contact->email }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ __('Reply via Email') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
