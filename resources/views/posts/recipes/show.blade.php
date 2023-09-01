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
            <em>{{ $post->subtitle }}</em>
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
                                    
                                    {{-- IMG --}}
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


                        <div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="lg:w-8/12">
                                <div class="p-4 pt-0 text-gray-900">
                                        
                                   
                                {{-- Add this ONLY if we have at least one tag in common with this recipe --}}
                                {{-- TODO: Here we list max 5 recipes based on recipe tags  --}}

                                {{-- Recipe card --}}
                                {{-- TODO: Here we list max 5 recipes based on recipe tags  --}}
    
                                </div>

                            </div>       
                        </div>


                        {{-- Recipe card --}}
                        <div id="recipe-card" class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="lg:w-8/12">
                                <div class="p-4 pt-0 text-gray-900">
                                    
                                    
                                    <div class="border-double border-4 flex flex-col justify-between">{{-- Container --}}

                                        <div class="flex p-6">{{-- Head recipe card --}}

                                            <div class="">
                                                <h3 class="uppercase"><strong>{{ $post->title }}</strong></h3>
                                                
                                                <ul class="flex flex-wrap">
                                                    <li class="flex items-center flex-grow">
                                                        <span>{{ __('Author:') }}</span>
                                                        <span>{{ __('Roberto') }}</span>
                                                    </li>
                                                    <li class="flex items-center flex-grow">
                                                        <img class="" src="{{ asset('icons/clock.svg') }}" alt="Clock Icon" />
                                                        <span>{{ __('Prep time:') }}</span>
                                                        <span><b>{{ __('5 min') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img src="{{ asset('icons/clock.svg') }}" alt="Clock Icon" />
                                                        <span>{{ __('Cooking time:') }}</span>
                                                        <span><b>{{ __('25 min') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img src="{{ asset('icons/clock.svg') }}" alt="Clock Icon" />
                                                        <span>{{ __('Total time:') }}</span>
                                                        <span><b>{{ __('30 min') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img src="{{ asset('icons/catlery.svg') }}" alt="Catlery Icon" />
                                                        <span>{{ __('Number serving:') }}</span>
                                                        <span><b>{{ __('4') }}</b></span>
                                                    </li>
                                                    
                                                    
                                                </ul>

                                                <div class="flex">
                                                    {{-- <form method="POST" action="{{ route() }}">
                                                        @csrf
                                                        @method('PUT') --}}
                                                        <div class="flex items-center justify-end mt-4 ml-[-1rem]">
                                                            <x-primary-button class="ml-3">
                                                                {{ __('Print recipe') }}
                                                            </x-primary-button>
                                                        </div>
                                                    {{-- </form> --}}

                                                    {{-- <form method="POST" action="{{ route() }}">
                                                        @csrf
                                                        @method('PUT') --}}
                                                        <div class="flex items-center justify-end mt-4">
                                                            <x-primary-button class="ml-3">
                                                                {{ __('Save recipe') }}
                                                            </x-primary-button>
                                                        </div>
                                                    {{-- </form> --}}
                                                </div>

                                            </div>

                                            <div>                     

                                                @forelse ($post->postImages as $image)
                                            
                                                @if ($image->position === 'intro')
                                                    <img class="w-40" 
                                                        src="{{ asset($image->path) }}" 
                                                        alt="{{ $image->alt }}"
                                                    />
                                                @endif
                        
                                                @empty
                                                    {{ __("Post hasn't main image yet") }}
                                                @endforelse

                                            </div>

                                        </div>

                                        <div class="border-double border-t-4 p-6">
                                            <h3 class="uppercase"><strong>{{ __('description') }}</strong></h3>
                                            <p class="">{{ __('Add description here....') }}</p>
                                        </div>

                                        <div class="border-double border-t-4 p-6">
                                            <h3 class="uppercase"><strong>{{ __('ingredients') }}</strong></h3>
                                            <ul>
                                                {{-- @forelse ($ingredients as $ingredient)
                                                    <li class="mt-4"><strong class="capitalize">{{ $ingredient->name . ': '}}</strong>{{ $ingredient->description }}</li>
                                                @empty
                                                    <li class="mt-4"><strong class="capitalize">{{ __('Recipe doesn\'t have ingredients yet') }}</strong></li>
                                                @endforelse --}}

                                                {{-- {{ dd($post->postIngredientsGroups) }} --}}

                                                @forelse ($post->postIngredientsGroups as $postIngredientsGroup)
                                                    <h4 class="mt-4"><strong class="capitalize">{{ $postIngredientsGroup->title . ': '}}</strong></h4>
                                       
                                                    @forelse ($ingredients as $ingredient)
                                                        {{-- TODO: loop ingrediens here --}}

                                                        @if ($postIngredientsGroup->id === $ingredient->post_ingredient_group_id)
                                                            <li class="mt-4" id="">
                                                                {{ $ingredient->quantity }}
                                                                {{ $ingredient->unit }}
                                                                {{ $ingredient->name }}
                                                            </li>
                                                        @endif
                                                            
                                                     
                                                    @empty
                                                        <li class="mt-4">
                                                            {{ __("Post hasn't ingredients yet") }}
                                                        </li>
                                                    @endforelse

                                                @empty
                                                    
                                                    {{-- if doesn't have group list all ingrediens --}}
                                                    @forelse ($ingredients as $ingredient)
                                                        <li class="mt-4" id="">
                                                            {{ $ingredient->quantity }}
                                                            {{ $ingredient->unit }}
                                                            {{ $ingredient->name }}
                                                        </li>                   
                                                    @empty
                                                        <li class="mt-4">
                                                            {{ __("Post hasn't ingredients yet") }}
                                                        </li>
                                                    @endforelse






                                                @endforelse
                                            </ul>
                                        </div>

                                        <div class="border-double border-t-4 p-6">

                                            <h3 class="uppercase"><strong>{{ __('method') }}</strong></h3>
                                            <ul>
                                       
                                                @forelse ($postMethodsGroups as $postMethodsGroup){{-- check for grouped methods --}}
                                               
                                                    @foreach ($postMethods as $postMethod){{-- check for methods --}}
                                                      
                                                        {{-- check if there are groups created but ungroped && the group id matches the method --}}
                                                        @if (!is_null($postMethod->post_method_group_id) && $postMethod->post_method_group_id === $postMethodsGroup->id)
                                                            <h4 class="mt-4"><strong class="capitalize">{{ $postMethodsGroup->title . ': '}}</strong></h4>
                                                
                                                            
                                                                @foreach ($post->getGroupedMethodRecipeCardParagraphs() as $index => $paragraphs)

                                                                    @foreach ($paragraphs as $paragraph)
                                                                        @if (trim($paragraph) !== '' && $index === $postMethodsGroup->id){{-- trim here otherwise you get an extra dot after each paragraph --}}
                                                                            <li class="mt-4" id="instruction-step-{{ floor($index / 2) + 1 }}">
                                                                                <strong>{{ Str::before($paragraph, '.') . '.' }}</strong>
                                                                                {{ Str::after($paragraph, '.') }}
                                                                            </li>
                                                                        @endif
                                                                    @endforeach

                                                                @endforeach
                                                        
                                                        @endif
                                                    @endforeach

                                                @empty
                                                    @forelse ($post->getMethodRecipeCardParagraphs() as $index => $paragraph)
                                                        @if (trim($paragraph) !== ''){{-- trim here otherwise you get an extra dot after each paragraph --}}
                                                            <li class="mt-4" id="instruction-step-{{ floor($index / 2) + 1 }}">
                                                                <strong>{{ Str::before($paragraph, '.') . '.' }}</strong>
                                                                {{ Str::after($paragraph, '.') }}
                                                            </li>
                                                        @endif   
                                                    @empty
                                                        <li class="mt-4">
                                                            {{ __("Post hasn't methods yet") }}
                                                        </li>
                                                    @endforelse
                                                @endforelse
                                                
                                                {{-- If we have not grouped methods, weìll get a message --}}
                                                @if ($post->hasNonGroupedMethods())
                                                    <li class="mt-4 text-red-500">
                                                        {{ __("Some methods are hidden because not grouped") }}
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>

                                        <div class="border-double border-t-4 p-6">
                                            <h3 class="uppercase"><strong>{{ __('notes') }}</strong></h3>
                                            <p class="">{{ __('Add description here....') }}</p>
                                        </div>
                                                       

                                    </div>
                     
    
                                </div>

                            </div>       
                        </div>
                        






                      
                    </div>
                </div>
                @else
                    {{ __('Recipe is empty') }}
                @endif
            </div>
        </div>
    </div>

</x-app-layout>


