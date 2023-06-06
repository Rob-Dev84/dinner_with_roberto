<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>
    
    @include('partials._success-banner')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                <x-a-link 
                    :href="route('posts.create', auth()->user())" 
                    :active="request()->routeIs('posts.create')" 
                    :text=" __('+ Create a new post')">
                </x-a-link>
                <x-a-link 
                    :href="route('posts.create', auth()->user())" 
                    :active="request()->routeIs('posts.create')" 
                    :text=" __('+ Add blog category')">
                </x-a-link>
                <x-a-link class="bg-red-500"
                    :href="route('posts.create', auth()->user())" 
                    :active="request()->routeIs('posts.create')" 
                    :text=" __('Trashed posts')">
                </x-a-link>
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
                        
                        @if ($post->postImages->count() < 5)
                            {{-- <x-a-link href="{{ route('posts.images.create', [auth()->user(), $post->slug]) }}" text="{{ __('Add image') }}" /> --}}

                            <x-a-link
                                :href="route('posts.images.create', [auth()->user(), $post->slug])"
                                :active="request()->routeIs('posts.images.create')" 
                                :text=" __('Add image')">
                            </x-a-link>
                        @endif
                        <small>{{ $post->postImages->count() }}{{ '/5' }}</small>
                        <br>

                        @if ($post->postImages->count())
                            <x-a-link
                                :href="route('posts.images.deletions', [auth()->user(), $post->slug])"
                                :active="request()->routeIs('posts.images.deletions')" 
                                :text=" __('Del image')">
                            </x-a-link>
                        @endif

                        @if ($trasedImages)
                            <x-a-link
                                :href="route('posts.images.trash', [auth()->user(), $post->slug])"
                                :active="request()->routeIs('posts.images.trash')" 
                                :text=" __('Trashed images')">
                            </x-a-link>
                        @endif
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
                    <x-a-link 
                        :href="route('posts.edit', [auth()->user(), $post->slug])" 
                        :active="request()->routeIs('posts.edit')" 
                        :text=" __('Edit title/notes')">
                    </x-a-link>
                    {{-- <x-nav-link :href="route('posts.ingredients', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.ingredients')">
                        {{ __('Edit ingredients') }}
                    </x-nav-link> --}}
                    <x-a-link 
                        :href="route('posts.ingredients', [auth()->user(), $post->slug])" 
                        :active="request()->routeIs('posts.ingredients')" 
                        :text=" __('Edit ingredients')">
                    </x-a-link>
                    {{-- <x-nav-link :href="route('posts.methods', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.methods')">
                        {{ __('Edit methos') }}
                    </x-nav-link> --}}
                    <x-a-link 
                        :href="route('posts.methods', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.methods')" 
                        :text=" __('Edit methos')">
                    </x-a-link>
                    {{-- <x-nav-link :href="route('posts.images.edit', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.images.edit')">
                        {{ __('Edit Photos') }}
                    </x-nav-link> --}}
                    <x-a-link 
                        :href="route('posts.images.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.images.edit')" 
                        :text=" __('Edit Photos')">
                    </x-a-link>

                    @if (is_null($post->category_id))
                    <x-a-link 
                        :href="route('posts.categories', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.categories')" 
                        :text=" __('Add Category')">
                    </x-a-link>
                    @else
                    <x-a-link 
                        :href="route('posts.categories.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.categories.edit')" 
                        :text=" __('Edit Category')">
                    </x-a-link>
                    @endif

                    

                    <x-a-link 
                        :href="route('posts.images.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.images.edit')" 
                        :text=" __('Edit Subcategory')">
                    </x-a-link>

                    <x-a-link 
                        :href="route('posts.images.edit', [auth()->user(), $post->slug])"
                        :active="request()->routeIs('posts.images.edit')" 
                        :text=" __('Edit tags')">
                    </x-a-link>

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

    @endforeach
                        
    @else
    {{ __("There aren't recipes yet") }}
    @endif
    

</x-app-layout>


