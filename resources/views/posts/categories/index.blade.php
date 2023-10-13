<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Choose category to the post: ') }}
                <u>{{ $post->title }}</u> 
            </h2>    
            <x-a-link-call-to-action 
                :href="route('posts')"
                :active="request()->routeIs('posts')" 
                :text=" __('Back')"
                :title=" __('Back')"
            >
            </x-a-link-call-to-action>
        </div>
    </x-slot>
    

    <div class="py-2">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- @include('partials._success-banner') --}}
            
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">  
                        <h3>{{ __('Choose Category') }}</h3>
                        <form method="POST" action="{{ route('posts.categories.store', [auth()->user(), $post]) }}">
                            @csrf
                            @method('PUT')

                            {{-- <div class="relative"> --}}
                              <select name="category" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">{{ '---' }}{{ __(' Select ') }}{{ '---' }}</option>
                                @forelse($categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                  <option value="">{{ __('This blog doesn\'t have any category yet') }}</option>
                                @endforelse
                              </select>
                            {{-- </div> --}}
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Add') }}
                                </x-primary-button>  
                            </div>
                        </form>   
                    </div>




            </div>
        </div>
    </div>

</x-app-layout>


