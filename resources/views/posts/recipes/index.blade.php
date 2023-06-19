<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipes') }}
        </h2>
    </x-slot>
    

    <div class="py-2">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- @include('partials._success-banner') --}}
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                @forelse ($posts as $post)
                
                <div class="py-2">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        
                        <a href="{{ route('posts.recipes.show', $post->slug) }}">
                
                            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg flex-col items-center">
                                <div class="border">
                                    <div class="p-1 text-gray-900">
                                        
                                        @forelse ($post->postImages as $image)
                                        
                                            @if ($image->position === 'intro')
                                                <img class="w-80" 
                                                    src="{{ asset($image->path) }}" 
                                                    alt="{{ $image->alt }}"
                                                />
                                            @endif
                    
                                        @empty
                                            {{ __("Post hasn't main image yet") }}
                                        @endforelse
    
                                    </div>
                                </div>
                                <div class="w-80">
                                    <div class="p-1 text-gray-900">
                                        <h3 class="uppercase"><b>{{ $post->title}}</b></h3>
                                        {{-- <p><pre>{{ $post->intro }}</pre></p> --}}
                                        <p>{!! nl2br(e($post->intro)) !!}</p>
                                    </div>
                                </div>
                
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>

</x-app-layout>


