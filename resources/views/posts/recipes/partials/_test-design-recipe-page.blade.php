<div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg md:flex-row flex-col">
    <div class="order-2 md:w-6/12 md:order-1 lg:w-7/12 lg:order-1">
        <div class="p-1 text-gray-900 border">
                
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
    </div>

    <div class="order-1 md:w-6/12 lg:w-7/12 order-2">
        <div class="p-1 text-gray-900">
            <h3 class="uppercase"><b>{{ __('Overview') }}</b></h3>
            <p>{!! nl2br(e($post->intro)) !!}</p>
        </div>
    </div>

    <div class="lg:w-5/12 hidden lg:block lg:order-3">
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
    </div>

</div>