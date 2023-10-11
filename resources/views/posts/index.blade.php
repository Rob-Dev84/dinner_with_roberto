<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>
    
    @include('partials._success-banner')
    @include('partials._error-banner')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                <x-a-link-call-to-action 
                    :href="route('posts.create', auth()->user())" 
                    :active="request()->routeIs('posts.create')" 
                    :text="__('+ Create a new post')"
                    :title="__('Create a new post')"
                >
                </x-a-link-call-to-action>
                <x-a-link-call-to-action 
                    :href="route('posts.create', auth()->user())" 
                    :active="request()->routeIs('posts.create')" 
                    :text="__('+ Add blog category')"
                    :title="__('Add blog category')"
                >
                </x-a-link-call-to-action>

                <x-a-link-call-to-action 
                    :href="route('posts.create', auth()->user())" 
                    :active="request()->routeIs('posts.create')" 
                    :text="__('+ Add blog subcategory')"
                    :title="__('Add blog subcategory')"
                >
                </x-a-link-call-to-action>

                <x-a-link-call-to-action 
                    :href="route('posts.create', auth()->user())" 
                    :active="request()->routeIs('posts.create')" 
                    :text="__('+ Add blog tag')"
                    :title="__('Add blog tag')"
                >
                </x-a-link-call-to-action>

                <x-a-link-call-to-action class="bg-red-500"
                    :href="route('posts.create', auth()->user())" 
                    :active="request()->routeIs('posts.create')" 
                    :text="__('Trashed posts')"
                    :title="__('Trashed posts')"
                >
                </x-a-link-call-to-action>
            {{-- </div> --}}
        </div>
    </div>

    @if ($posts)
        @foreach ($posts as $post)
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border">
                    <div class="p-6 text-gray-900">
                        
                        @forelse ($post->postImages as $image)
                        
                            @if ($image->position === 'intro')
                                <img class="w-40" 
                                    src="{{ asset($image->path) }}" 
                                    alt="{{ $image->alt }}"
                                />
                            @endif
                                {{-- {{ __("Post hasn't main image yet") }}
                            @endif --}}
                                
                        @empty
                            {{ __("Post hasn't main image yet") }}
                        @endforelse

                        <br>

                        <div class="flex">
                            <div class="flex">
                                @if ($post->postImages->count() >= 0 || $post->postImages->count() >= 5)
                                <x-a-link-call-to-action
                                    :href="route('posts.images.create', [auth()->user(), $post->slug])"
                                    :active="request()->routeIs('posts.images.create')" 
                                    :text="__('')"
                                    :title="__('Add images')"
                                    :use="asset('icons/add/add-image.svg').'#add-image'"
                                >
                                </x-a-link-call-to-action>
                                @else
                                <x-a-link-call-to-action
                                    :href="''"
                                    :active="''" 
                                    :text="__('')"
                                    :title="__('Add images')"
                                    :use="asset('icons/add/add-image.svg').'#add-image'"
                                >
                                </x-a-link-call-to-action>
                                @endif
                                <sup 
                                    class="w-6 h-6 p-2 ml-[-15px] bg-primary-500 text-white flex justify-center items-center rounded-full"
                                    title="{{ Str::plural('Image', $post->postImages->count() === 1) }}{{ __(' added') }}"  
                                      
                                >
                                    <b>{{ $post->postImages->count() }}&#47;{{ '5' }}</b>
                                </sup>
    
                            </div>
                            
                            @if ($post->postImages->count())

                                <x-a-link-call-to-action
                                    :href="route('posts.images.deletions', [auth()->user(), $post->slug])"
                                    :active="request()->routeIs('posts.images.deletions')"
                                    :title="__('Delete images')"
                                    :text="__('')"
                                    :use="asset('icons/delete/del-image.svg').'#del-image'"
                                >
                                </x-a-link-call-to-action>
                            @endif
                            {{-- {{ dd($post->postImagesTrashed->count()) }} --}}
                            @if ($post->postImagesTrashed->count())
                                <x-a-link-call-to-action
                                    :href="route('posts.images.trash', [auth()->user(), $post->slug])"
                                    :active="request()->routeIs('posts.images.trash')" 
                                    :text="__('')"
                                    :title="__('Trashed images')"
                                    :use="asset('icons/trashed-list.svg').'#trashed-list'"
                                >
                                </x-a-link-call-to-action>         
                            @else
                                <x-a-link-call-to-action
                                    :href="''"
                                    :active="''" 
                                    :text="__('')"
                                    :title="__('Trash empty')"
                                    :use="asset('icons/trashed-list.svg').'#trashed-list'"
                                >
                                </x-a-link-call-to-action>
                            @endif
                                <sup 
                                    class="
                                        {{ ($post->postImagesTrashed->count() === 0) ? 'opacity-30' : '' }}
                                        w-6 h-6 p-2 ml-[-22px] bg-primary-500 text-white flex justify-center items-center rounded-full"
                                    title="{{ Str::plural('Image', $post->postImagesTrashed->count() === 1) }}{{ __(' deleted') }}"          
                                >
                                    <b>{{ $post->postImagesTrashed->count() }}</b>
                                </sup>  
                        </div>

                        

                        
                    </div>

                </div>
                <div class="w-full">
                    <div class="p-6 text-gray-900">
                        <h3 class="uppercase"><b>{{ $post->title}}</b></h3>
                        {{-- <p><pre>{{ $post->intro }}</pre></p> --}}
                        <p>{!! nl2br(e($post->intro)) !!}</p>
                    </div>
                </div>
                <div class="border">
                    {{-- <x-nav-link :href="route('posts.edit', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.edit')">
                        {{ __('Edit title/notes') }}
                    </x-nav-link> --}}
                    <x-a-link-call-to-action 
                        :href="route('posts.edit', [auth()->user(), $post->slug])" 
                        :active="request()->routeIs('posts.edit')" 
                        :text="__('Edit title/notes')"
                        :title="__('Edit title/notes')"
                    >
                    </x-a-link-call-to-action>
                    {{-- <x-nav-link :href="route('posts.ingredients', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.ingredients')">
                        {{ __('Edit ingredients') }}
                    </x-nav-link> --}}
                    <x-a-link-call-to-action 
                        :href="route('posts.ingredients', [auth()->user(), $post->slug])" 
                        :active="request()->routeIs('posts.ingredients')" 
                        :text="__('Edit ingredients')"
                        :title="__('Edit ingredients')"
                    >
                    </x-a-link-call-to-action>
                    {{-- <x-nav-link :href="route('posts.methods', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.methods')">
                        {{ __('Edit methos') }}
                    </x-nav-link> --}}
                    <x-a-link-call-to-action 
                        :href="route('posts.methods', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.methods')" 
                        :text="__('Edit methos')"
                        :title="__('Edit methos')"
                    >
                    >
                    </x-a-link-call-to-action>
                    {{-- <x-nav-link :href="route('posts.images.edit', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.images.edit')">
                        {{ __('Edit Photos') }}
                    </x-nav-link> --}}
                    <x-a-link-call-to-action 
                        :href="route('posts.images.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.images.edit')" 
                        :text="__('Edit Photos')"
                        :title="__('Edit Photos')"
                        
                    >
                    </x-a-link-call-to-action>

                    @if (is_null($post->recipe_seo_metadata_id))
                    <x-a-link-call-to-action 
                        :href="route('posts.recipes.metadatas.create', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.recipes.metadatas.create')" 
                        :text="__('Add SEO metadata')"
                        :title="__('Add SEO metadata')"    
                    >
                    </x-a-link-call-to-action>
                    @else
                    <x-a-link-call-to-action 
                        :href="route('posts.recipes.metadatas.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.recipes.metadatas.edit')" 
                        :text="__('Edit SEO metadata')"
                        :title="__('Edit SEO metadata')"    
                    >
                    </x-a-link-call-to-action>
                    @endif

                    @if (is_null($post->category_id))
                    <x-a-link-call-to-action 
                        :href="route('posts.categories', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.categories')" 
                        :text="__('Add Category')"
                        :title="__('Add Category')"
                    >
                    </x-a-link-call-to-action>
                    @else
                    <x-a-link-call-to-action 
                        :href="route('posts.categories.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.categories.edit')" 
                        :text="__('Edit Category')"
                        :title="__('Edit Category')"
                    >
                    </x-a-link-call-to-action>
                    @endif
                    
                    @if (is_null($post->subcategory_id))
                    <x-a-link-call-to-action 
                        :href="route('posts.subcategories', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.subcategories')" 
                        :text="__('Add Subcategory')"
                        :title="__('Add Subcategory')"
                    >
                    </x-a-link-call-to-action>
                    @else
                    <x-a-link-call-to-action 
                        :href="route('posts.subcategories.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.subcategories.edit')" 
                        :text="__('Edit Subcategory')"
                        :title="__('Edit Subcategory')"
                    >
                    </x-a-link-call-to-action>
                    @endif
                    
                    {{-- @if ($post->postTags()->count() == 0) --}}
                    <x-a-link-call-to-action 
                        :href="route('posts.tags.index', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.images.edit')" 
                        :text="__('Manage tags')"
                        :title="__('Manage tags')"
                    >
                    </x-a-link-call-to-action>
                    {{-- @else
                    <x-a-link 
                        :href="route('posts.images.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.images.edit')" 
                        :text="__('Edit tags')">
                    </x-a-link>
                    @endif --}}

                </div>

                <form class="p-4" method="POST" action="{{ route('posts.softDelete', [auth()->user(), $post]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <x-green-button 
                            class=""
                            :use="asset('icons/add/publish.svg').'#publish'"
                            fill="#fff"
                            stroke="#fff"
                            title="Publish Article"
                        >
                            {{-- {{ __('Public') }} --}}
                        </x-green-button>
                    </div>
                </form>
                
                <form class="p-4" method="POST" action="{{ route('posts.softDelete', [auth()->user(), $post]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <x-danger-button 
                            class="" 
                            :use="asset('icons/delete/trash.svg').'#trash'"
                            fill="#dc2626"
                            stroke="#fff"
                            title="Delete Article"
                        >
                        {{-- {{ __('Delete') }} --}}
                        </x-danger-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @endforeach
                        
    @else
    {{ __("There aren't recipes yet") }}
    @endif
    

</x-app-layout>


