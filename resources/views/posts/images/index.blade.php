<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts images') }}
        </h2>
    </x-slot>

{{-- @foreach ($post->postImages as $image) --}}
    

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border">
                    <div class="p-6 text-gray-900">
                        {{-- @if ($post->img_link)
                            <img class="w-40"
                                src="{{ asset('storage/' . $post->img_link) }}" 
                                alt="{{ $post->title . '\'s photo' }}"
                            />
                        @endif --}}

                        @if ($post->postImages->count())
                            <img class="w-40"
                                src="{{ asset('storage/' . $post->img_link) }}" 
                                alt="{{ $post->title . '\'s photo' }}"
                            />
                        @else
                            
                        @endif
                        
                    </div>

                </div>
                
                @if ($post->postImages->count())
                <div class="w-full">
                    <div class="p-6 text-gray-900">
                        <h3 class="uppercase"><b>{{ __('Main image') }}</b></h3>
                        <p>{{ __('Image path: ') }}<b>{{ $post->postImages->path }}</b></p>
                        <p>{{ __('Image title: ') }}<b>{{ $post->postImages->title }}</b></p>
                        <p>{{ __('Image alt: ') }}<b>{{ $post->postImages->alt }}</b></p>
                        <p>{{ __('Image figcaption: ') }}<b>{{ $post->figcaption }}</b></p>
                        <p>{{ __('Image position: ') }}<b>{{ $post->postImages->position }}</b></p>
                    </div>
                </div>
                @endif
                
                <div class="border">
                    
                    <form method="POST" action="{{ route('posts.softDelete', [auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center justify-end mt-4">
                            <x-danger-button class="ml-3">
                                {{ __('Edit') }}
                            </x-danger-button>
                        </div>
                    </form>
                </div>

                
                
                <form method="POST" action="{{ route('posts.softDelete', [auth()->user(), $post]) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center justify-end mt-4">
                        <x-danger-button class="ml-3">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- @endforeach --}}

                        

    {{ __("There aren't recipes yet") }}

    

</x-app-layout>


