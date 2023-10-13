<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Choose Tag for the post: ') }}
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

            @include('partials._success-banner')
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex justify-center flex-auto"> 
                        <div class="flex-1">
                            
                            <h3><b>{{ __('Tag selected:') }}</b></h3>
                            <ul>
                                @forelse($postTags as $postTag)
                                <li class="flex justify-between items-center">
                                    <span class="">
                                        {{ $postTag->tags->first()->name }}
                                    </span> 
                                    @include('posts.tags.modals.delete-tag-form')   
                                </li>
                                @empty
                                <li>{{ __('No tags selected yet') }}
                                @endforelse
                            </ul>
                        </div>
                        <div class="flex-1"> 
                            <h3>{{ __('Choose Tag') }}</h3>
                            <form method="POST" action="{{ route('posts.tags.store', [auth()->user(), $post]) }}">
                                @csrf
                                @method('POST')

                                {{-- <div class="relative"> --}}
                                <select name="tag" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="">{{ '---' }}{{ __(' Select ') }}{{ '---' }}</option>
                                    {{-- //TODO: don't display only tags are already selected for the post --}}
                                    @forelse($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @empty
                                    <option value="">{{ __('This blog doesn\'t have any tag yet') }}</option>
                                    @endforelse
                                </select>

                                @if ($tags->count() === 0)
                                    {{ __('Add link here to go to add blog tag section') }}
                                @else
                                    <x-input-error :messages="$errors->get('tag')" class="mt-2" />
                                        {{-- </div> --}}
                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="ml-3">
                                            {{ __('Add') }}
                                        </x-primary-button>  
                                    </div>
                                @endif
                                
                            </form> 
                        </div>  
                    </div>

            </div>
        </div>
    </div>

</x-app-layout>


