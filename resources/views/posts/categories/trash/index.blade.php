<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trashed Post images for: ') }}
            <b>{{ __($post->title) }}</b>
        </h2>
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
                            
                            @if ($image->deleted_at)
                                {{-- TODO: display the deleted image path --}}

                                <div class="p-6 text-gray-900">
                                    <img class="w-40"
                                        {{-- src="{{ asset( $image->path) }}"  --}}
                                        src="{{ asset($image->deleted_path) }}"
                                        alt="{{ $image->alt }}"
                                    />
                                </div>
                            @endif
                            

                            <div class="p-6 text-gray-900">
                                <p>{{ __('Image location: ') }}</p>
                                <p><b>{{ $image->position }}</b></p>
                            </div>
                            
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('posts.images.modals.restore-image-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('posts.images.modals.force-delete-image-form')
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


