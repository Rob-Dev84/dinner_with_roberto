<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delete Post images') }}
        </h2>
    </x-slot>

{{-- @foreach ($post->postImages as $image) --}}
    

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border">
                    <div class="p-6 text-gray-900">
                        @forelse($images as $image)
                        <div class="w-full flex justify-evenly">
                            

                            <div class="p-6 text-gray-900">
                                <img class="w-40"
                                    src="{{ asset( $image->path) }}" 
                                    alt="{{ $image->alt }}"
                                />
                            </div>

                            <div class="p-6 text-gray-900">
                                <p>{{ __('Image location: ') }}</p>
                                <p><b>{{ $image->position }}</b></p>
                            </div>
                        

                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('posts.images.modals.delete-image-form')
                                </div>
                            </div>
                        </div>
                        @empty
                            <p><b>{{ __('No image is found') }}<b></p>
                        @endforelse
                        
                    </div>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652c-.39-.39-1.023-.39-1.414 0L10 8.586 6.066 4.652c-.39-.39-1.023-.39-1.414 0-.39.39-.39 1.023 0 1.414L8.586 10l-3.934 3.934c-.39.39-.39 1.023 0 1.414.39.39 1.023.39 1.414 0L10 11.414l3.934 3.934c.39.39 1.023.39 1.414 0 .39-.39.39-1.023 0-1.414L11.414 10l3.934-3.934c.39-.39.39-1.023 0-1.414z"/></svg>
                            </span>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


    

</x-app-layout>


