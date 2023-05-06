<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add images to your post: ') }} <u>{{ $post->title }}</u> 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('posts.images.store', [auth()->user(), $post->slug]) }}">
                        @csrf

                        <div class="flex flex-wrap -mx-4">
                        
                            @foreach($positions as $index => $position)
                          
                                <div class="w-full lg:w-1/2 px-4">
                                    <div class="border border-gray-300 rounded-lg p-6">

                                        {{-- TODO: change this input text with textarea --}}

                                        @if (!in_array($position, $usedPositions))

                                        {{-- active inputs --}}

                                            {{-- Image --}}    
                                            <div class="mt-4">
                                                <x-input-label for="path" :value="__('Select Image: ').ucfirst($position)" />
                                                <x-text-input id="path_{{$index+1}}" class="block mt-1 w-full" type="file" name="path_{{$index+1}}" :value="old('path_{{$index+1}}')" />
                                                <x-input-error :messages="$errors->get('path_{{$index+1}}')" class="mt-2" />
                                            </div>

                                            {{-- Title --}}                            
                                            <div class="mt-4">
                                                <x-input-label for="title{{$index+1}}" :value="__('Title')" />
                                                <x-text-input id="title_{{$index+1}}" class="block mt-1 w-full" type="text" name="title_{{$index+1}}" :value="old('title_{{$index+1}}')" autofocus />
                                                {{-- <x-textarea class="block mt-1 w-full" id="title_{{$index+1}}" name="title_{{$index+1}}" label="" value="'title_{{$index+1}}" autofocus /> --}}
                                                <x-input-error :messages="$errors->get('title_{{$index+1}}')" class="mt-2" />
                                            </div>

                                            {{-- Alt --}}
                                            <div class="mt-4">
                                                <x-input-label for="alt{{$index+1}}" :value="__('Alt')" />
                                                <x-text-input id="alt_{{$index+1}}" class="block mt-1 w-full" type="text" name="alt_{{$index+1}}" :value="old('alt_{{$index+1}}')" autofocus />
                                                {{-- <x-textarea class="block mt-1 w-full" id="alt_{{$index+1}}" name="alt_{{$index+1}}" label="" :value="old('alt_{{$index+1}}')" autofocus /> --}}
                                                <x-input-error :messages="$errors->get('alt_{{$index+1}}')" class="mt-2" />
                                            </div>

                                            {{-- Figcaption --}}
                                            <div class="mt-4">
                                                <x-input-label for="figcaption{{$index+1}}" :value="__('Figcaption')" />
                                                <x-text-input id="figcaption_{{$index+1}}" class="block mt-1 w-full" type="text" name="figcaption_{{$index+1}}" :value="old('figcaption_{{$index+1}}')" autofocus />
                                                {{-- <x-textarea class="block mt-1 w-full" id="figcaption_{{$index+1}}" name="figcaption_{{$index+1}}" label="" :value="old('figcaption_{{$index+1}}')" autofocus /> --}}
                                                <x-input-error :messages="$errors->get('figcaption_{{$index+1}}')" class="mt-2" />
                                            </div>  
                                            
                                        @else
                                        
                                            {{-- Image --}}  
                                            <div class="mt-4">
                                                <x-input-label for="path" :value="__('Image inserted: '). $position" />
                                                <x-text-input id="path_{{$index+1}}" class="block mt-1 w-full" type="file" name="path_{{$index+1}}" disabled />
                                                <x-input-error :messages="$errors->get('path_{{$index+1}}')" class="mt-2" />
                                            </div>
                                            {{-- Title --}}  
                                            <div class="mt-4">
                                                <x-input-label for="title{{$index+1}}" :value="__('Title: add or edit in edit section')" />
                                                <x-text-input id="title_{{$index+1}}" class="block mt-1 w-full" type="text" name="title_{{$index+1}}" disabled />
                                                {{-- <x-textarea class="block mt-1 w-full" id="title_{{$index+1}}" name="title_{{$index+1}}" label="" disabled --}}
                                                <x-input-error :messages="$errors->get('title_{{$index+1}}')" class="mt-2" />
                                            </div>
                                            {{-- Alt --}}  
                                            <div class="mt-4">
                                                <x-input-label for="alt{{$index+1}}" :value="__('Alt: add or edit in edit section')" />
                                                <x-text-input id="alt_{{$index+1}}" class="block mt-1 w-full" type="text" name="alt_{{$index+1}}" disabled />
                                                {{-- <x-textarea class="block mt-1 w-full" id="alt_{{$index+1}}" name="alt_{{$index+1}}" label="" disabled /> --}}
                                                <x-input-error :messages="$errors->get('alt_{{$index+1}}')" class="mt-2" />
                                            </div>
                                            {{-- Figcaption --}}
                                            <div class="mt-4">
                                                <x-input-label for="figcaption{{$index+1}}" :value="__('Figcaption: add or edit in edit section')" />
                                                <x-text-input id="figcaption_{{$index+1}}" class="block mt-1 w-full" type="text" name="figcaption_{{$index+1}}" disabled />
                                                {{-- <x-textarea class="block mt-1 w-full" id="figcaption_{{$index+1}}" name="figcaption_{{$index+1}}" label="" disabled /> --}}
                                                <x-input-error :messages="$errors->get('figcaption_{{$index+1}}')" class="mt-2" />
                                            </div>   
                                            
                                        @endif  
                                    
                                        {{-- TODO: in the future you can use this code, but you need to add createOrUpdate() in store method --}}
                                        {{-- @if ($image = $images->where('position', $position)->first())
                                        
                                            @if (is_null($image->title))
                                                                         
                                                <div class="mt-4">
                                                    <x-input-label for="title{{$index+1}}" :value="__('Title')" />
                                                    <x-text-input id="title_{{$index+1}}" class="block mt-1 w-full" type="text" name="title_{{$index+1}}" :value="old('title_{{$index+1}}')" autofocus />
                                                    
                                                    <x-input-error :messages="$errors->get('title_{{$index+1}}')" class="mt-2" />
                                                </div>
                                            @else
                                                                          
                                                <div class="mt-4">
                                                    <x-input-label for="title{{$index+1}}" :value="__('Title inserted')" />
                                                    <x-text-input id="title_{{$index+1}}" class="block mt-1 w-full" type="text" name="title_{{$index+1}}" disabled />
                                                   
                                                    <x-input-error :messages="$errors->get('title_{{$index+1}}')" class="mt-2" />
                                                </div>
                                            @endif 

                                            @if (is_null($image->alt) && is_null($image->figcaption))
                                               
                                                <div class="mt-4">
                                                    <x-input-label for="alt{{$index+1}}" :value="__('Alt')" />
                                                    <x-text-input id="alt_{{$index+1}}" class="block mt-1 w-full" type="text" name="alt_{{$index+1}}" :value="old('alt_{{$index+1}}')" autofocus />
                                                    
                                                    <x-input-error :messages="$errors->get('alt_{{$index+1}}')" class="mt-2" />
                                                </div>
                                            @else
                                           
                                                <div class="mt-4">
                                                    <x-input-label for="alt{{$index+1}}" :value="__('Alt inserted')" />
                                                    <x-text-input id="alt_{{$index+1}}" class="block mt-1 w-full" type="text" name="alt_{{$index+1}}" disabled />
                                                    
                                                    <x-input-error :messages="$errors->get('alt_{{$index+1}}')" class="mt-2" />
                                                </div>
                                            @endif 

                                            @if (is_null($image->figcaption))
                                              
                                                <div class="mt-4">
                                                    <x-input-label for="figcaption{{$index+1}}" :value="__('Figcaption')" />
                                                    <x-text-input id="figcaption_{{$index+1}}" class="block mt-1 w-full" type="text" name="figcaption_{{$index+1}}" :value="old('figcaption_{{$index+1}}')" autofocus />
                                                    
                                                    <x-input-error :messages="$errors->get('figcaption_{{$index+1}}')" class="mt-2" />
                                                </div>  
                                            @else
                                           
                                                <div class="mt-4">
                                                    <x-input-label for="figcaption{{$index+1}}" :value="__('Figcaption inserted')" />
                                                    <x-text-input id="figcaption_{{$index+1}}" class="block mt-1 w-full" type="text" name="figcaption_{{$index+1}}" disabled />
                                                    
                                                    <x-input-error :messages="$errors->get('figcaption_{{$index+1}}')" class="mt-2" />
                                                </div>                      
                                            @endif
                                        @endif --}}
                      
                                    
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
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


