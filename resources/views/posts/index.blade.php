<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-nav-link :href="route('posts.create', auth()->user())" :active="request()->routeIs('posts.create')">
                    {{ __('+ Create a new post') }}
                </x-nav-link>
            </div>
        </div>
    </div>

    @if ($posts)
        @foreach ($posts as $post)
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border">
                    <div class="p-6 text-gray-900">
                        {{ 'img here' }}
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
                    <x-nav-link :href="route('posts.edit', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.edit')">
                        {{ __('Edit title/notes') }}
                    </x-nav-link>
                    <x-nav-link :href="route('posts.ingredients', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.ingredients')">
                        {{ __('Edit ingredients') }}
                    </x-nav-link>
                    <x-nav-link :href="route('posts.methods', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.methods')">
                        {{ __('Edit methos') }}
                    </x-nav-link>

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


