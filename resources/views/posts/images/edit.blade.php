<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit images info to your post: ') }} <u>{{ $post->title }}</u> 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('posts.images.update', [auth()->user(), $post->slug]) }}">
                        @csrf

                        <div class="flex flex-wrap -mx-4">
                        
                            @foreach($images as $image)
                          
                                <div class="w-full lg:w-1/2 px-4">
                                    <div class="border border-gray-300 rounded-lg p-6">

                                        {{-- Image --}}  
                                        <div class="mt-4">
                                            <x-input-label for="path" :value="__('To modify the image, delete it')" />
                                            <x-text-input id="" class="block mt-1 w-full" type="file" name="image_{{$image->id}}" disabled />
                                            <x-input-error :messages="$errors->get('image_{{$image->id}}')" class="mt-2" />
                                        </div>

                                        {{-- Title --}}                            
                                        <div class="mt-4">
                                            <x-input-label for="title_{{$image->id}}" :value="__('Title')" />
                                            {{-- <x-text-input id="title_{{$image->id}}" class="block mt-1 w-full" type="text" name="title_{{$image->id}}" :value="old('title_{{$image->title}}')" autofocus /> --}}
                                            {{-- <x-textarea class="block mt-1 w-full" id="title_{{$image->id}}" name="title_{{$image->id}}" label="" value="'title_{{$image->title}}" autofocus /> --}}
                                            <textarea class="block mt-1 w-full" id="title_{{$image->id}}" name="title_{{$image->id}}" label="" value="'title_{{$image->id}}" autofocus>{{ $image->title }}</textarea>
                                            <x-input-error :messages="$errors->get('title_{{$image->id}}')" class="mt-2" />
                                        </div>

                                        {{-- Alt --}}
                                        <div class="mt-4">
                                            <x-input-label for="alt_{{$image->id}}" :value="__('Alt')" />
                                            {{-- <x-text-input id="alt_{{$image->id}}" class="block mt-1 w-full" type="text" name="alt_{{$image->id}}" :value="old('alt_{{$image->alt}}')" autofocus /> --}}
                                            {{-- <x-textarea class="block mt-1 w-full" id="alt_{{$image->id}}" name="alt_{{$image->id}}" label="" :value="old('alt_{{$image->alt}}')" autofocus /> --}}
                                            <textarea class="block mt-1 w-full" id="title_{{$image->id}}" name="alt_{{$image->id}}" label="" value="'alt_{{$image->id}}" autofocus>{{ $image->alt }}</textarea>
                                            <x-input-error :messages="$errors->get('alt_{{$image->id}}')" class="mt-2" />
                                        </div>

                                        {{-- Figcaption --}}
                                        <div class="mt-4">
                                            <x-input-label for="figcaption_{{$image->id}}" :value="__('Figcaption')" />
                                            {{-- <x-text-input id="figcaption_{{$image->id}}" class="block mt-1 w-full" type="text" name="figcaption_{{$image->id}}" :value="old('figcaption_{{$image->id}}')" autofocus /> --}}
                                            {{-- <x-textarea class="block mt-1 w-full" id="figcaption_{{$index+1}}" name="figcaption_{{$image->id}}" label="" :value="old('figcaption_{{$image->id}}')" autofocus /> --}}
                                            <textarea class="block mt-1 w-full" id="figcaption_{{$image->id}}" name="figcaption_{{$image->id}}" label="" value="'figcaption_{{$image->id}}" autofocus>{{ $image->figcaption }}</textarea>
                                            <x-input-error :messages="$errors->get('figcaption_{{$image->id}}')" class="mt-2" />
                                        </div>      
                                
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>

                        @if ($errors->has('path'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">{{ __('Error!') }}</strong>
                                <span class="block sm:inline">{{ $errors->first('path') }}</span>
                            </div>
                        @endif

                        
                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ml-4">
                                {{ __('Edit') }}
                            </x-primary-button>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


