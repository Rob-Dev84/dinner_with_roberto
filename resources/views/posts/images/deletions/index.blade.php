<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Delete Post images: ') }}
                {{ $post->title }}
            </h2>
            <x-a-link-call-to-action 
                :href="route('posts')"
                :active="request()->routeIs('posts')" 
                :text=" __('Back')"
                :title=" __('Back')"
            >
            </x-a-link-call-to-action>
        </div>
    </x-slot>

{{-- @foreach ($post->postImages as $image) --}}
    

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border">
                    <div class="p-6 text-gray-900">
                     
                        @include('partials._success-banner')

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
                                    @include('posts.images.modals.soft-delete-image-form')
                                </div>
                            </div>
                        </div>
                        @empty
                            <p><b>{{ __('No image is found') }}<b></p>
                        @endforelse
                        
                    </div>
                    

                </div>
            </div>
        </div>
    </div>


    

</x-app-layout>


