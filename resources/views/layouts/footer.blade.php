<footer class="bg-gray-800 text-gray-200 p-4">
    <div class="container mx-auto">
        <div class="flex justify-evenly flex-col md:flex-row mt-5">
            <div class="flex">
                {{-- <a class="flex items-center" href="#" back-to-top>
                    <svg class="w-4 h-4" style="fill:#fff">
                        <use xlink:href="{{ asset('icons/arrow-up.svg') }}#arrow-up"></use>
                    </svg>
                    &nbsp;
                    {{ __('Back to top') }}
                </a> --}}
                <x-secondary-button
                    class="h-6 bg-gray-800 m-0 mr-2 py-4 border-none text-gray-200 hover:bg-gray-800 focus:ring-none focus:ring-offset-0 focus:border-none"
                    back-to-top
                >
                    <svg class="w-4 h-4" style="fill:#fff">
                        <use xlink:href="{{ asset('icons/arrow-up.svg') }}#arrow-up"></use>
                    </svg>
                    &nbsp;
                    {{ __('Back to top') }}
                </x-secondary-button>
                <nav>
                    <ul class="flex">
                        <li>
                            <x-footer-nav-link :href="route('about')" :active="request()->routeIs('about')">
                                {{ __('Home') }}
                            </x-footer-nav-link>
                        </li>
                            <x-footer-nav-link :href="route('about')" :active="request()->routeIs('about')">
                                {{ __('About') }}
                            </x-footer-nav-link>
                        <li>
                            <x-footer-nav-link :href="route('posts.recipes.index')" :active="request()->routeIs('posts.recipes.index')">
                                {{ __('Recipes') }}
                            </x-footer-nav-link>
                        </li>
                    </ul>
                </nav>     
            </div>
            <div class="flex items-center">
                <p class="mr-2">{{ __('Follow Dinner with Roberto on') }}</p>
                <ul class="flex">
                    <li class="flex items-center">
                        <a class="ml-3" href="https://www.instagram.com/dinner_with_roberto" target="_blank" rel="noreferrer noopener">
                            <svg class="w-8 h-8" style="fill:#fff">
                                <use xlink:href="{{ asset('icons/social/instagram.svg') }}#instagram"></use>
                            </svg>
                        </a>                    
                    </li>
                    <li class="flex items-center">
                        <a class="ml-3" href="https://www.tiktok.com/@dinnerwithroberto" target="_blank" rel="noreferrer noopener">
                            <svg class="w-8 h-8" style="fill:#fff">
                                <use xlink:href="{{ asset('icons/social/tiktok.svg') }}#tiktok"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="ml-3" href="https://www.facebook.com/profile.php?id=100090001125773" target="_blank" rel="noreferrer noopener">
                            <svg class="w-8 h-8" style="fill:#fff">
                                <use xlink:href="{{ asset('icons/social/facebook.svg') }}#facebook"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="ml-3" href="https://www.youtube.com/@dinnerwithroberto/" target="_blank" rel="noreferrer noopener">
                            <svg class="w-8 h-8" style="fill:#fff">
                                <use xlink:href="{{ asset('icons/social/youtube.svg') }}#youtube"></use>
                            </svg>
                        </a>
                    </li>
                    {{-- <li class="flex items-center">
                        <a class="ml-3" href="" target="_blank" rel="noreferrer noopener">
                            <svg class="w-8 h-8" style="fill:#fff">
                                <use xlink:href="{{ asset('icons/social/printerest.svg') }}#printerest"></use>
                            </svg>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
        
        
        <div class="flex flex-col items-center mt-12">
            <div>
                &copy;&nbsp;{{ __('Copiright') }}&nbsp;{{ date('Y') }}&nbsp;&hyphen;&nbsp;{{ __('Dinner with Roberto') }}
            </div>
            <div>
                {{ __('Powered by') }}&nbsp;{{ __('Roberto Manna') }}&nbsp;&hyphen;&nbsp;{{ __('Privacy Policy') }}&nbsp;&hyphen;&nbsp;{{ __('Cookie Policy') }}
            </div>
        </div>
        
    </div>
</footer>