<x-app-layout>

    {{-- Head meta content --}}
    @include('posts.recipes.partials._meta-tags')

    <x-slot name="header">
        <b><h1 class="font-semibold text-xl text-gray-800 leading-tight text-center uppercase">
            {{ $post->title }}
        </b></h1>
        <div class="flex justify-center">
            <a href="#recipe-card">{{ __('Go to recipe') }}</a>
            {{ '-|-' }}
            <a href="#recipe-comments">{{ __('Comments') }}</a>
        </div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            <em>{{ __('A Mediterranean Twist on Classic Focaccia') }}</em>
        </h2>
    </x-slot>
    

    <div class="">{{-- removed padding --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col bg-white overflow-hidden shadow-sm py-6">
                {{-- <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                        {{ __('A Mediterranean Twist on Classic Focaccia') }}
                    </h2>
                </div> --}}
            
            {{-- @include('partials._success-banner') --}}
            

                
                    
                @if ($post)
                
                <div class="py-2">
                    
                    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 lg:max-w-5xl">
                        <div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="lg:w-8/12">
                                <div class="p-4 pt-0 text-gray-900">
                                        
                                    @forelse ($post->postImages as $image)
                                    
                                        @if ($image->position === 'intro')
                                            <img class="" 
                                                src="{{ asset($image->path) }}" 
                                                alt="{{ $image->alt }}"
                                            />
                                        @endif
                
                                    @empty
                                        {{ __("Post hasn't main image yet") }}
                                    @endforelse
    
                                </div>
                            
                                <div class="p-4 text-gray-900">
                                    <h3 class="uppercase"><b>{{ __('Overview') }}</b></h3>
                                    {{-- <p>{{ $post->intro }}</p> --}}

                                    @forelse ($post->getIntroParagraphs() as $paragraph)
                                        <p class="mt-4">{{ $paragraph }}</p>
                                    @empty
                                        <p class="mt-4">{{ __("Post hasn't main image yet") }}</p>
                                    @endforelse
                                </div>
                            </div>

                            <aside class="w-4/12 hidden lg:block">
                                <div class="p-1 text-gray-900">
                                    <h3 class="uppercase"><b>{{ __('Hi there, I\'m Roberto') }}</b></h3>
                                        
                                    <div class="">
                                        <img class="w-20 h-20 rounded-full mr-8 float-right" 
                                            src="{{ asset($image->path) }}" 
                                            alt="{{ $image->alt }}"
                                        />
                                    
                                        <p class="">
                                            {{ 
                                                mb_strimwidth(
                                                __("an Italian food enthusiast hailing from the vibrant city of Naples. 
                                                Growing up, I was immersed in a world of culinary delights as my mum prepared delicious meals every day. 
                                                The enticing aromas, the rhythmic sounds of sizzling pans, and the vibrant colors of fresh ingredients sparked my love for cooking. 
                                                Every moment spent in the kitchen felt like a special connection with my mum and our shared passion for food. 
                                                Through my food blog, I invite you to join me on this flavorful journey, as I share cherished recipes and stories that celebrate the rich culinary heritage of Naples and beyond. 
                                                Together, let's create unforgettable dining experiences that bring joy, warmth, and a taste of Italy to your kitchen.")
                                                , 0, 250, '...') 
                                            }}
                                        </p>
                                        {{-- <b><a href="">{{ __("Continue here") }}</a></b> --}}
                                        <x-a-link 
                                            :href="route('posts.recipes.index', auth()->user())" 
                                            :active="request()->routeIs('posts.recipes.index')" 
                                            :text=" __('Continue here')">
                                        </x-a-link>
                                    </div>


                                </div>
                            </aside>
                
                        </div>

                            

                        
                        <br>
                            
                        <div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="lg:w-8/12">
                                <div class="p-4 pt-0 text-gray-900">
                                        
                                    @forelse ($post->postImages as $image)
                                    
                                        @if ($image->position === 'intro')
                                            <img class="" 
                                                src="{{ asset($image->path) }}" 
                                                alt="{{ $image->alt }}"
                                            />
                                        @endif
                
                                    @empty
                                        {{ __("Post hasn't main image yet") }}
                                    @endforelse
    
                                </div>
                            
                                <div class="p-4 text-gray-900">
                                    <h3 class="uppercase"><b>{{ $post->title . ' - ' . __('Ingredients') }}</b></h3>
                                    {{-- <p>{!! nl2br(e($post->intro)) !!}</p> --}}

                                    <ul>
                                    @forelse ($ingredients as $ingredient)
                                        <li class="mt-4"><strong class="capitalize">{{ $ingredient->name . ': '}}</strong>{{ $ingredient->description }}</li>
                                    @empty
                                        <li class="mt-4"><strong class="capitalize">{{ __('Recipe doesn\'t have ingredients yet') }}</strong></li>
                                    @endforelse
                                    </ul>
                                </div>
                            </div>

                
                        </div>

                        <div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="lg:w-8/12">
                                <div class="p-4 pt-0 text-gray-900">
                                        
                                    @forelse ($post->postImages as $image)
                                    
                                        @if ($image->position === 'intro')
                                            <img class="" 
                                                src="{{ asset($image->path) }}" 
                                                alt="{{ $image->alt }}"
                                            />
                                        @endif
                
                                    @empty
                                        {{ __("Post hasn't main image yet") }}
                                    @endforelse
    
                                </div>
                            
                                <div class="p-4 text-gray-900">
                                    <h3 class="uppercase"><strong>{{ $post->title . ' - ' . __('Method') }}</strong></h3>              

                                    <ol>
                                    @forelse ($postMethodsGroups as $postMethodsGroup)
                                        <h4 class="mt-4"><strong class="capitalize">{{ $postMethodsGroup->title . ': '}}</strong></h4>
                                       
                                        @forelse ($post->getMethodParagraphs() as $index => $paragraph)
                                            @if (trim($paragraph) !== ''){{-- trim here otherwise you get an extra dot after each paragraph --}}
                                                <li class="mt-4" id="instruction-step-{{ floor($index / 2) + 1 }}">
                                                    <strong>{{ Str::before($paragraph, '.') . '.' }}</strong>
                                                    {{ Str::after($paragraph, '.') }}
                                                </li>
                                            @endif   
                                        @empty
                                            <li class="mt-4">
                                                {{ __("Post hasn't methods image yet") }}
                                            </li>
                                        @endforelse
                                    @empty
                                        <li class="mt-4">
                                            {{ __("Post hasn't title methods yet") }}
                                        </li>
                                    @endforelse
                                    </ol>
                                </div>
                            </div>

                
                        </div>








                        <div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="lg:w-8/12">
                                <div class="p-4 pt-0 text-gray-900">
                                        
                                    @forelse ($post->postImages as $image)
                                    
                                        @if ($image->position === 'intro')
                                            <img class="" 
                                                src="{{ asset($image->path) }}" 
                                                alt="{{ $image->alt }}"
                                            />
                                        @endif
                
                                    @empty
                                        {{ __("Post hasn't main image yet") }}
                                    @endforelse
    
                                </div>
                            
                                <div class="p-4 text-gray-900">
                                    <h3 class="uppercase"><strong>{{ $post->title . ' - ' . __('Notes') }}</strong></h3>              
    
                                        @forelse ($post->getNoteParagraphs() as $note)
                                            <p class="mt-4">{{ $note }}</p>
                                        @empty
                                            <p class="mt-4">{{ __("Post hasn't main image yet") }}</p>
                                        @endforelse
                                    
                                </div>
                            </div>

                
                        </div>






                      
                    </div>
                </div>
                @else
                    
                @endif
            </div>
        </div>
    </div>

</x-app-layout>


