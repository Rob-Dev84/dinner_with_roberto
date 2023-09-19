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
                                    
                                    
                                    <div class="border-primary-200 border-4 flex flex-col justify-between">{{-- Container --}}

                                        <div class="flex p-6 bg-primary-100">{{-- Head recipe card --}}

                                            <div class="">
                                                <h3 class="uppercase"><strong>{{ $post->title }}</strong></h3>
                                                
                                                <ul class="flex flex-wrap">
                                                    <li class="flex items-center flex-grow">
                                                        <span>{{ __('Author:') }}</span>
                                                        <span>&nbsp;<a href=""><strong><em><u>{{ __('Roberto Manna') }}</u></em></strong></a></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img class="" src="{{ asset('icons/stove.svg') }}" alt="Clock Icon" />
                                                        <span class="ml-1">{{ __('Cooking method:') }}</span>
                                                        <span class="ml-1"><b>{{ __('Oven') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img class="" src="{{ asset('icons/clock.svg') }}" alt="Clock Icon" />
                                                        <span class="ml-1">{{ __('Prep time:') }}</span>
                                                        <span class="ml-1"><b>{{ __('5 min') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img src="{{ asset('icons/clock.svg') }}" alt="Clock Icon" />
                                                        <span class="ml-1">{{ __('Cooking time:') }}</span>
                                                        <span class="ml-1"><b>{{ __('25 min') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img src="{{ asset('icons/clock.svg') }}" alt="Clock Icon" />
                                                        <span class="ml-1">{{ __('Total time:') }}</span>
                                                        <span class="ml-1"><b>{{ __('30 min') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img src="{{ asset('icons/catlery.svg') }}" alt="Catlery Icon" />
                                                        <span class="ml-1">{{ __('Yield:') }}</span>
                                                        <span class="ml-1"><b>{{ __('4') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img src="{{ asset('icons/category.svg') }}" alt="Category Icon" />
                                                        <span class="ml-1">{{ __('Category:') }}</span>
                                                        <span class="ml-1"><b>{{ __('Bread') }}</b></span>
                                                    </li>

                                                    <li class="flex items-center flex-grow">
                                                        <img src="{{ asset('icons/flag.svg') }}" alt="Cuisine Icon" />
                                                        <span class="ml-1">{{ __('Cuisine:') }}</span>
                                                        <span class="ml-1"><b>{{ __('Italian') }}</b></span>
                                                    </li>
                                                    
                                                    
                                                </ul>

                                                <div class="flex">
                                                    {{-- <form method="POST" action="{{ route() }}">
                                                        @csrf
                                                        @method('PUT') --}}
                                                        <div class="flex items-center justify-end mt-4 ml-[-1rem]">
                                                            <x-primary-button class="ml-3 bg-primary-500 text-primary-900">
                                                                {{ __('Print recipe') }}
                                                            </x-primary-button>
                                                        </div>
                                                    {{-- </form> --}}

                                                    {{-- <form method="POST" action="{{ route() }}">
                                                        @csrf
                                                        @method('PUT') --}}
                                                        <div class="flex items-center justify-end mt-4">
                                                            <x-primary-button class="ml-3 bg-primary-500">
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

                                        <div class="border-primary-200 border-t-4 p-6">
                                            <h3 class="uppercase"><strong>{{ __('description') }}</strong></h3>
                                            <p class="mt-4">{{ $post->description }}</p>
                                        </div>

                                        <div class="border-primary-200 border-t-4 p-6">
                                            <h3 class="uppercase"><strong>{{ __('ingredients') }}</strong></h3>
                                            <ul class="list-disc">
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
                                                            <li class="mt-4 ml-4" id="">
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

                                                    {{-- /TODO: plcace the toggle that prevents screen going dark --}}
                                                    
                                                    
                                                   

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

                                        <div class="border-primary-200 border-t-4 p-6">

                                            <h3 class="uppercase"><strong>{{ __('method') }}</strong></h3>
                                            <ol class="list-decimal">
                                       
                                                @forelse ($postMethodsGroups as $postMethodsGroup){{-- check for grouped methods --}}
                                               
                                                    @foreach ($postMethods as $postMethod){{-- check for methods --}}
                                 
                                                        {{-- check if there are groups created but ungroped && the group id matches the method --}}
                                                        @if (!is_null($postMethod->post_method_group_id) && $postMethod->post_method_group_id === $postMethodsGroup->id)
                                                            <h4 class="mt-4"><strong class="capitalize">{{ $postMethodsGroup->title . ': '}}</strong></h4>
                                                
                                                            
                                                                @foreach ($post->getGroupedMethodRecipeCardParagraphs() as $index => $paragraphs)

                                                                    @foreach ($paragraphs as $paragraph)
                                                                        @if (trim($paragraph) !== '' && $index === $postMethodsGroup->id){{-- trim here otherwise you get an extra dot after each paragraph --}}
                                                                            {{-- <li class="mt-4 relative z-10 before:w-5 before:h-5 before:absolute before:bg-primary-500 before:left-[-22px] before:top-[3px] before:z-[-1] before:rounded-full" id="instruction-step-{{ floor($index / 2) + 1 }}"> --}}
                                                                            <li class="mt-4 ml-4" id="instruction-step-{{ floor($index / 2) + 1 }}">
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
                                                    <strong>
                                                        <p class="mt-4 text-red-500">
                                                            {{ __("Some methods are hidden because not grouped") }}
                                                        </p>
                                                    </strong>
                                                @endif

                                            </ol>
                                        </div>

                                        @if ($post->note)
                                            <div class="border-primary-200 border-t-4 p-6">
                                                <h3 class="uppercase"><strong>{{ __('notes') }}</strong></h3>
                                             
                                                <ul class="list-disc">            
                                                    @foreach ($post->getNoteParagraphs() as $note)
                                                        @if (trim($note) !== ''){{-- trim here otherwise you get an extra dot after each paragraph --}}
                                                            <li class="mt-4">
                                                                <strong>{{ Str::before($note, '.') . '.' }}</strong>
                                                                {{ Str::after($note, '.') }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                  
                                            </div>
                                        @endif

                                        {{-- instagram banner --}}
                                        <div class="bg-primary-500 p-6">
                                            <div class="flex items-center justify-between">
                                            
                                                <img class="w-10 mr-5" src="{{ asset('icons/social/instagram.svg') }}" alt="Instagram Icon" />
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <use xlink:href="{{ asset('icons/social/instagram.svg') }}"></use>
                                                </svg> --}}
                                                <div>
                                                    <h3 class="uppercase text-xl"><strong>{{ __('Let me know if you made this recipe!') }}</strong></h3>
                                                
                                                    <div class="">
                                                        <p class="text-sm">
                                                            {{ __('Tag ') }}<a href="https://www.instagram.com/dinner_with_roberto" target="_blank" rel="noreferrer noopener"><strong>&#64;dinner_with_roberto</strong></a>  
                                                            {{ __('on Instagram and hashtag it ') }}<a href="https://www.instagram.com/explore/tags/dinner_with_roberto" target="_blank" rel="noreferrer noopener"><strong>&#35;dinner_with_roberto</strong></a>
                                                        </p> 
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                    </div>
                                </div>       
                            </div>
                        </div>




                        {{-- Comment Form --}}
                        <div id="" class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="lg:w-8/12">
                                <div class="p-4 pt-0 text-gray-900">          
                                    
                                    {{-- Async request --}}
                                    <div id="main-comment-section" 
                                        {{-- x-data="{ showReplyForm: false, commentId: null }" --}}
                                    >
                                        <div class="p-6 bg-primary-200 border-primary-200 border-4 flex flex-col justify-between">
                                            <form action="{{ route('posts.comments.store', $post) }}" method="POST" 
                                            {{-- x-show="!showReplyForm" --}}
                                                x-data="
                                                    {
                                                        formData: {
                                                            rating: '',
                                                            name: '',
                                                            email: '',
                                                            comment: '',
                                                            link: '',
                                                            cookies_consent: false,
                                                            notify_on_reply: false,
                                                        },
                                                        errors: {},
                                                        successMessage: '',
                                                        submitForm(event) {
                                                            this.successMessage = '';
                                                            this.errors = {};
                                                            
                                                                fetch(`{{ route("posts.comments.store", $post) }}`, {
                                                                    method: 'POST',
                                                                    headers: {
                                                                        'Content-Type': 'application/json',
                                                                        'X-Requested-With': 'XMLHttpRequest',
                                                                        'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content'),
                                                                    },
                                                                    body: JSON.stringify(this.formData)
                                                                })
                                                                .then(response => {
                                                                    if (response.status === 200) {
                                                                        return response.json();
                                                                    }
                                                                    throw response;
                                                                })
                                                                .then(result => {
                                                                    this.formData = {
                                                                        rating: '',
                                                                        name: '',
                                                                        email: '',
                                                                        comment: '',
                                                                        link: '',
                                                                        cookies_consent: false,
                                                                        notify_on_reply: false,
                                                                    };
                                                                    this.successMessage = '{{ __("Thank you for leaving the comment. If the message is approved, I will be shortly displayed!") }}';
                                                                })
                                                                .catch(async (response) => {
                                                                    const res = await response.json();
                                                                    if (response.status === 422) {
                                                                        this.errors = res.errors;
                                                                    }
                                                                    //console.log(res);
                                                                })
                                                                
                                                        }
                                                    }
                                    
                                                "
                                                x-on:submit.prevent="submitForm"
                                                >
                                                
                                                <h3 class="text-xl"><strong>{{ __('Leave a comment & rate this recipe') }}</strong></h3>
                                                <p class="mt-3">{{ __("If you loved this recipe, please consider giving it a star rating when you post a comment. Star ratings help people discover my recipes online. Your support means a great deal to me.") }}</p>
                                                <p class="mt-5"><em>{{ __("Your email address will not be published. Required fields are marked*") }}</em></p>
                                                
                                                <div class="mt-5" x-data="">
                                                    <legend>{{ __("Rate the recipe") }}</legend>

                                                    <div class="w-full flex justify-start">
                                                        
                                                        <div x-data="
                                                            {
                                                                rating: 0,
                                                                hoverRating: 0,
                                                                ratings: [{'amount': 1, 'label':'{{ __("Terrible") }}'}, {'amount': 2, 'label':'{{ __("Bad") }}'}, {'amount': 3, 'label':'{{ __("Okay") }}'}, {'amount': 4, 'label':'{{ __("Good") }}'}, {'amount': 5, 'label':'{{ __("Great") }}'}],
                                                                rate(amount) {
                                                                    if (this.rating == amount) {
                                                                this.rating = 0;
                                                            }
                                                                    else this.rating = amount;
                                                                    this.formData.rating = this.rating;
                                                                },
                                                            currentLabel() {
                                                            let r = this.rating;
                                                            if (this.hoverRating != this.rating) r = this.hoverRating;
                                                            let i = this.ratings.findIndex(e => e.amount == r);
                                                            if (i >=0) {return this.ratings[i].label;} else {return ''};     
                                                            }
                                                            }
                                                            " class="flex flex-col w-full">
                                                            <div class="flex -ml-3">
                                                                
                                                                <template x-for="(star, index) in ratings" :key="index">
                                                                    <button @click.prevent="rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating"
                                                                        aria-hidden="true"
                                                                        :title="star.label"
                                                                        class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline p-1 w-12 m-0 cursor-pointer"
                                                                        :class="{'text-gray-600': hoverRating >= star.amount, 'text-yellow-400': rating >= star.amount && hoverRating >= star.amount}">
                                                                        <svg class="w-15 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                        </svg>
                                                                    </button>  

                                                                </template>
                                                            </div>
                                                            <div class="">
                                                                <template x-if="rating || hoverRating">
                                                                    <p x-text="currentLabel()"></p>
                                                                </template>
                                                                <template x-if="!rating && !hoverRating">
                                                                    <p class="h-6"></p>
                                                                </template>
                                                                <input class="hidden" type="number" name="rating" x-model="rating">

                                                                <div class="mt-4">
                                                                    <div class="flex align-items">
                                                                        <x-input-label for="comment" :value="__('Comment')" />
                                                                        <span class="-mb-1" x-show="rating != 5">&nbsp;*</span>
                                                                    </div>
                                                
                                                                    <x-textarea-input id="comment" name="comment" :value="old('comment')" rows="8" cols="45" maxlength="65525" x-model="formData.comment" ::class="errors.comment ? 'border-red-500 focus:border-red-500' : ''" />
                                                                        <template x-if="errors.comment">
                                                                            <div x-text="errors.comment[0]" class="text-red-500"></div>
                                                                        </template>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="name" :value="__('Name *')" />
                                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" x-model="formData.name" ::class="errors.name ? 'border-red-500' : ''" autocomplete  />
                                                    <template x-if="errors.name">
                                                        <div x-text="errors.name[0]" class="text-red-500"></div>
                                                    </template>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="email" :value="__('Email *')" />
                                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" maxlength="100" :value="old('email')" x-model="formData.email" ::class="errors.email ? 'border-red-500' : ''" autocomplete  />
                                                    <template x-if="errors.email">
                                                        <div x-text="errors.email[0]" class="text-red-500"></div>
                                                    </template>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="link" :value="__('Link')" />
                                                    <x-text-input id="link" class="block mt-1 w-full" type="text" name="link" maxlength="200" :value="old('link')" x-model="formData.link" ::class="errors.link ? 'border-red-500' : ''" />
                                                    <template x-if="errors.link">
                                                        <div x-text="errors.link[0]" class="text-red-500"></div>
                                                    </template>
                                                </div>

                                                
                                                <div class="mt-4">
                                                    <x-checkbox-input name="cookies_consent" :value="old('cookies_consent')" x-model="formData.cookies_consent">
                                                        <span>{{ __("Save my name, email in this browser for the next time I comment.") }}</span>
                                                    </x-checkbox-input>
                                                </div>

                                                <div class="mt-4">
                                                    <x-checkbox-input name="notify_on_reply" :value="old('notify_on_reply')" x-model="formData.notify_on_reply">
                                                        <span>{{ __("Notify me if Roberto replies to my comment.") }}</span>
                                                    </x-checkbox-input>
                                                </div>

                                                <div class="flex items-center justify-end mt-4">
                                                    <x-primary-button class="ml-3 bg-primary-500">
                                                        {{ __('Comment recipe') }}
                                                    </x-primary-button>
                                                </div>

                                                <template x-if="successMessage">
                                                    <div x-text="successMessage" class="py-4 px-6 bg-green-600 text-zinc-100 mb-4">{{ __("Thank you for leaving the comment. If the message is approved, I will be shortly displayed") }}</div>
                                                </template>

                                            </form>
                                        </div>{{-- bg color first form --}}

        
                                        @if ($post->postComments->count() > 0)
                                            <h3 class="my-10"><strong>{{ $post->postComments->count() }}&nbsp;{{ Str::plural('Comment', $post->postComments->count()) }}&nbsp;<q>{{ $post->title }}</q></strong></h3>
                                        @endif
                                        
                                                                      
                                        @forelse ($post->postPrimaryComments as $comment)
                                                                                  
                                            <div class="bg-white">
                                                <ul id="reply-comment-form-{{ $comment->id }}" class="col-span-3 row-span-3 ml-5">
                                                    <li class="border-primary-200 border-2 flex flex-col mb-5">
                                                        @if ($comment->user)
                                                            <div class="py-5 pl-5 pr-3 m-4 {{ $comment->user->role->name === 'Admin' ? 'bg-primary-200' : '' }}">
                                                        @else
                                                            <div class="py-5 pl-5 pr-3 m-4">
                                                        @endif
                                                            <div class="flex items-center justify-between">       
                                                                <div class="flex justify-between w-85">
                                                                    {{-- Check link --}}
                                                                    @if ($comment->link)
                                                                        <a class="uppercase" href="{{ $comment->link }}" target="_blank" rel="noreferrer noopener">
                                                                            <u><strong>
                                                                                {{ $comment->name }}
                                                                            </strong></u>
                                                                        </a>
                                                                        {{-- <a rel="nofollow" class="" @click.prevent="showReplyForm = !showReplyForm" href="#comment-871554" data-commentid="871554" data-postid="46877" data-belowelement="comment-871554" data-respondelement="respond" data-replyto="{{ __('Reply to ') . $comment->name }}" aria-label="Reply to Marcia Sewall">{{ __('Reply') }}</a>     --}}  
                                                                    @else
                                                                        <div>
                                                                            <strong>
                                                                                {{ $comment->name }}
                                                                            </strong>
                                                                        </div>
                                                                    @endif
                            
                                                                    &dash;
                                                                    <time pubdate="" datetime="{{ \Carbon\Carbon::parse($comment->created_at)->format('F j, Y @ g:i A') }}">
                                                                        {{ $comment->created_at->format('F j, Y @ g:i A') }}
                                                                    </time>
                                                                </div>
                                                                            
                                                                <div class="w-15 flex justify-end items-center">

                                                                    <x-secondary-button
                                                                        class="edit h-6 bg-primary-300"
                                                                        data-comment-id="{{$comment->id}}"
                                                                        data-comment-name="{{$comment->name}}"
                                                                        data-toggle-reply-form
                                                                    >
                                                                        {{ __('Reply') }}
                                                                    </x-secondary-button>
                                                                    <input type="hidden" id="comment_id" name="comment_id" value="">
                                                                    <input type="hidden" id="name" name="name" value="">
                                                                    {{-- <button class="edit" data-comment-id="{{$comment->id}}" data-toggle-reply-form>Reply Test</button> --}}
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                            <p class="mt-4">{{ $comment->comment }}</p>     
                                                            <div class="flex mt-4" id="reply-comment-form-{{ $comment->id }}">
                                                                @if (!is_null($comment->recipe_rating) && $comment->recipe_rating > 0)
                                                                    @for ($i = 1; $i <= $comment->recipe_rating; $i++)
                                                                        <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#f2b955">
                                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                        </svg>                                         
                                                                    @endfor
                                                                @endif      
                                                            </div>
                                                        </div>
                                                        <div class="reply-form-container" id="replyFormContainer{{$comment->id}}"></div>
                                                            
                                                        
                                                        @if ($comment->children->count())
                                                          @foreach ($comment->children as $childComment)
                                                              <ul id="reply-child-comment-form-{{ $childComment->id }}" class="col-span-3 row-span-3 ml-4 mb-4">
                                                                <li class="flex flex-col">
                                                                    @if ($childComment->user)
                                                                        <div class="py-5 pl-5 pr-3 mx-4 ml-4 {{ $childComment->user->role->name === 'Admin' ? 'bg-primary-200' : '' }}">
                                                                    @else
                                                                        <div class="py-5 pl-5 pr-3 mx-4 ml-4">
                                                                    @endif
                                                                
                                                                        <div class="flex items-center justify-between">   
                                                                            <div class="flex justify-between w-85">
                                                                                @if ($childComment->link)
                                                                                    <a class="uppercase" href="{{ $childComment->link }}" target="_blank" rel="noreferrer noopener">
                                                                                        <u><strong>
                                                                                            {{ $childComment->name }}
                                                                                        </strong></u>
                                                                                    </a> 
                                                                                @else
                                                                                    <div>
                                                                                        <strong>
                                                                                            {{ $childComment->name }}
                                                                                        </strong>
                                                                                    </div>
                                                                                @endif                     
                                                                                    &dash;
                                                                                    <time pubdate="" datetime="{{ \Carbon\Carbon::parse($childComment->created_at)->format('F j, Y @ g:i A') }}">
                                                                                        {{ $childComment->created_at->format('F j, Y @ g:i A') }}
                                                                                    </time>   
                                                                            </div>
                                                                            
                                                                        
                                                                            <x-secondary-button
                                                                                class="edit h-6 bg-primary-300"
                                                                                data-comment-id="{{$childComment->id}}"
                                                                                data-comment-parent-id="{{$comment->id}}"
                                                                                data-comment-name="{{$childComment->name}}"
                                                                                data-toggle-reply-form
                                                                            >
                                                                                {{ __('Reply') }}
                                                                            </x-secondary-button>
                                                                        </div>
                                                                    
                                                                        <p class="mt-4">{{ $childComment->comment }}</p>
                                                                        
                                                                        <div class="flex mt-4">
                                                                            @if (!is_null($childComment->recipe_rating) && $childComment->recipe_rating > 0)
                                                                                @for ($i = 1; $i <= $childComment->recipe_rating; $i++)
                                                                                    <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#f2b955">
                                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                                    </svg>
                                                                                @endfor
                                                                            @endif  
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <div class="reply-form-container" id="replyFormContainer{{$childComment->id}}"></div> 
                                                              </ul>
                                                          @endforeach  
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                                    <!-- Reply Comment Form -->
                                                        
                                                        {{-- <a rel="nofollow" class="comment-reply-link" href="#comment-802885" data-commentid="802885" data-postid="46877" data-belowelement="comment-802885" data-respondelement="respond" data-replyto="Reply to Deborah Dewar" aria-label="Reply to Deborah Dewar">Reply</a> --}}
                                                       
                                        @empty
                                            {{ __("Post doesn't have comments yet") }}
                                        @endforelse

                                        


                                    </div>{{-- closing async request container --}}
                                </div><!-- Comments area -->
                            </div>       
                        </div>{{-- closing comment section --}}
                  
                          

                        {{-- Footer section here --}}

                        <div id="comments" class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="lg:w-8/12">
                                <div class="p-4 pt-0 text-gray-900">          
                                    <div class="border-primary-200 border-4 flex flex-col justify-between">{{-- Container --}}

                                        {{-- @foreach ($comments as $comment)
                                        <div class="comment">
                                            <!-- Display comment information here -->
                                            {{ $comment->name }}: {{ $comment->comment }}
                                    
                                            <!-- Recursively display child comments -->
                                            @include('comments.comment', ['comments' => $comment->children])
                                            </div>
                                        @endforeach --}}
                                        

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


