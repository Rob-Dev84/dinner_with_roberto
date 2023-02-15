<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 
            {{ __('Add or Group methods for: ') }}
            {{ $post->title }}
            
        </h2>
    </x-slot>

    <div class="flex justify-between">
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="pb-6 flex flex-col">
                            <h3>{{ __('Total methods inserted:') }}</h3>

                            <ul>
                                @forelse ($methodsInserted as $method)
                                    <li class="flex justify-between odd:bg-gray-200">
                                        <div class="flex justify-center items-center">
                                            {{ $method->method }}
                                        </div>

                                        <div class="flex justify-center items-center">
                                                                    {{-- posts.methods.edit --}}
                                            <x-nav-link :href="route('posts.methods.edit', [$method, auth()->user(), $post->slug])" :active="request()->routeIs('posts.ingredients.edit')">
                                                {{ __('Mod') }}
                                            </x-nav-link>
                                                                                {{-- posts.methods.delete --}}
                                            <form method="POST" action="{{ route('posts.methods.delete', [$method, auth()->user(), $post]) }}">
                                                @csrf
                                                @method('DELETE')
                        
                                                
                        
                                                {{-- <div class="flex items-center justify-end mt-4"> --}}
                                                    <x-danger-button class="ml-4">
                                                        {{ __('Del') }}
                                                    </x-danger-button>
                                                {{-- </div> --}}
                                            </form>
                                        </div>   
                                    </li>
                                @empty
                                    <p>{{ __('This recipe doesn\'t have methods yet') }}</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="pb-6 flex flex-col">
                            <h3>{{ __('Methods not grouped:') }}</h3>

                            <ul>

                                @forelse ($methodsInserted as $method)
                                    @if (is_null($method->post_method_group_id))
                                        <li class="flex justify-between odd:bg-gray-200">
                                            <div>
                                                {{ $method->method }}
                                            </div>
                                        </li>

                                       
                                    @endif
                                    
                                    
                                @empty
                                    <p>{{ __('This recipe doesn\'t have methods yet') }}</p>
                                @endforelse

                                {{-- //TODO improve if statement --}}
                                @if ($methodsInserted->where('post_method_group_id', NULL)->count() > 0)
                                    <x-nav-link :href="route('posts.methods.groups', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.methods.groups')">
                                        {{ __('Group methods') }}
                                    </x-nav-link>
                                @else
                                    <span class="opacity-20" title="You need at least two methods to group them">{{ __('Group methods') }}</span>
                                    
                                @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
    

                        {{-- Check if methods are grouped, you show title and related methods --}}

                        <div class="pb-6 flex flex-col">
                            <h3>{{ __('methods grouped:') }}</h3>
                        
                                @forelse ($methodsGrouped as $methodGrouped)

                                    <div class="flex justify-between items-center border-t-2 border-black mt-1">
                                        <h3><b>{{ $methodGrouped->title }}</b></h3>

                                        <div class="flex justify-center items-center">

                                            <x-nav-link :href="route('posts.methods.groups.edit', [$methodGrouped, auth()->user(), $post->slug])" :active="request()->routeIs('posts.methods.groups.editTitle')">
                                                {{ __('mod') }}
                                            </x-nav-link>


                                            <form method="POST" action="{{ route('post.methods.groups.destroy', [$methodGrouped, auth()->user(), $post]) }}">
                                                @csrf
                                                @method('DELETE')
                                                    <x-danger-button class="ml-4">
                                                        {{ __('Del') }}
                                                    </x-danger-button>
                                            </form>
                                        </div>
                                    </div>

                                    <ul>

                                    @foreach ($methodsInserted as $method)
                                        @if ($method->post_method_group_id === $methodGrouped->id)
                                        <li class="flex justify-between odd:bg-gray-200">
                                            <div>
                                                {{ $method->method }}
                                            </div>

                                            <div class="ml-4">
                                                <form method="POST" action="{{ route('posts.methods.ungroup', [$ingredient, auth()->user(), $post]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="flex items-center justify-end mt-4">
                                                        <x-primary-button class="ml-4">
                                                            {{ __('Ungroup') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
                                                
                                                 {{-- //TODO Ungroup ingredient --}}
                                                 {{-- {{ __('Ungroup') }} --}}
                                            </div>   
                                        </li>
                                        @endif
                                    @endforeach
                                @empty
                                    <p>{{ __('This recipe doesn\'t contain grouped methods') }}</p>
                                @endforelse
                                
                            </ul>
                        </div>

                        
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>{{ __('Add method: if you need to separate paragraphs (breaking the line), use enter and leave a white space') }}</h3>
                    <form method="POST" action="{{ route('posts.methods.store', [auth()->user(), $post]) }}">
                        @csrf
                        {{-- @method('PUT') --}}

                        
                        <div class="mt-4">
                            <x-input-label for="method" :value="__('Method')" />
                            {{-- <x-textarea id="summary" class="block mt-1 w-full" name="intro" type="text">{{ $post->summary }}</x-textarea> --}}
                            <textarea id="method" class="block mt-1 w-full" name="method" type="text" :value="old('method')" autofocus /></textarea>
                            <x-input-error :messages="$errors->get('method')" class="mt-2" />
                        </div>
                        
            
                        


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Add') }}
                            </x-primary-button>
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>


