<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    
                {{ __('Add or Group methods for: ') }}
                {{ $post->title }}
                
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

    <div class="flex justify-between">
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="pb-6 flex flex-col">
                            <h3>{{ __('Total methods inserted:') }}</h3>

                            <ul>
                                @forelse ($methodsInserted as $method)
                                    <li class="flex justify-between items-center odd:bg-gray-200">
                                        <div class="mr-5" title="{{ $method->method }}">
                                            {{ mb_strimwidth($method->method, 0, 25, '...') }}
                                        </div>

                                        <div class="mr-5 p-2 bg-gray-500" title="{{ $method->method_recipe_card }}">
                                            {{ mb_strimwidth($method->method_recipe_card, 0, 25, '...') }}
                                        </div>

                                        <div class="flex justify-center items-center">
                                                                   
                                            <x-a-link-call-to-action 
                                                :href="route('posts.methods.edit', [$method, auth()->user(), $post->slug])" 
                                                :active="request()->routeIs('posts.methods.edit')" 
                                                :text=" __('Mod')"
                                                :title=" __('Mod')"
                                            >
                                            </x-a-link-call-to-action>

                                
                                            @include('posts.methods.modals.delete-method-form')
                                            
                                            
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
                                        <li class="flex justify-between items-center odd:bg-gray-200">
                                            
                                            <div class="mr-5" title="{{ $method->method }}">
                                                {{ mb_strimwidth($method->method, 0, 25, '...') }}
                                            </div>

                                            <div class="mr-5 p-2 bg-gray-500" title="{{ $method->method_recipe_card }}">
                                                {{ mb_strimwidth($method->method_recipe_card, 0, 25, '...') }}
                                            </div>
                                        </li>

                                       
                                    @endif
                                    
                                    
                                @empty
                                    <p>{{ __('This recipe doesn\'t have methods yet') }}</p>
                                @endforelse

                                {{-- TODO: improve if statement --}}
                                {{-- {{ dd($methodsInserted) }} --}}
                                @if ($methodsInserted->where('post_method_group_id', NULL)->count() > 0)
                                    {{-- <x-nav-link :href="route('posts.methods.groups', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.methods.groups')">
                                        {{ __('Group methods') }}
                                    </x-nav-link> --}}

                                    <x-a-link-call-to-action 
                                        :href="route('posts.methods.groups', [auth()->user(), $post->slug])" 
                                        :active="request()->routeIs('posts.methods.groups')" 
                                        :text=" __('Group methods')"
                                        :title=" __('Mod')"
                                        >
                                    </x-a-link-call-to-action>
                                @else
                                    <span class="opacity-20" title="You need at least two methods to group them">{{ __('Group methods') }}</span>
                                    
                                @endif

                                {{-- @forelse ($collection as $item)
                                    
                                @empty
                                    
                                @endforelse --}}

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

                                            {{-- <x-nav-link :href="route('posts.methods.groups.edit', [$methodGrouped, auth()->user(), $post->slug])" :active="request()->routeIs('posts.methods.groups.editTitle')">
                                                {{ __('mod') }}
                                            </x-nav-link> --}}

                                            <x-a-link-call-to-action 
                                                :href="route('posts.methods.groups.edit', [$methodGrouped, auth()->user(), $post->slug])" 
                                                :active="request()->routeIs('posts.methods.groups.edit')" 
                                                :text=" __('Mod')"
                                                :title=" __('Mod')"
                                            >
                                            </x-a-link-call-to-action>

                                            @include('posts.methods.modals.delete-grouped-method-form')


                                            {{-- <form method="POST" action="{{ route('post.methods.groups.destroy', [$methodGrouped, auth()->user(), $post]) }}">
                                                @csrf
                                                @method('DELETE')
                                                    <x-danger-button class="ml-4">
                                                        {{ __('Del') }}
                                                    </x-danger-button>
                                            </form> --}}
                                        </div>
                                    </div>

                                    <ul>

                                    @foreach ($methodsInserted as $method)
                                        @if ($method->post_method_group_id === $methodGrouped->id)
                                        <li class="flex justify-between items-center odd:bg-gray-200">
                                            <div class="mr-5" title="{{ $method->method }}">
                                                {{ mb_strimwidth($method->method, 0, 25, '...') }}
                                            </div>

                                            <div class="mr-5 p-2 bg-gray-500" title="{{ $method->method_recipe_card }}">
                                                {{ mb_strimwidth($method->method_recipe_card, 0, 25, '...') }}
                                            </div>

                                            <div class="ml-4">
                                                <form method="POST" action="{{ route('posts.methods.ungroup', [$method, auth()->user(), $post]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="">
                                                        <x-primary-button class="ml-4">
                                                            {{ __('Ungroup') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
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
                    
                    <form method="POST" action="{{ route('posts.methods.store', [auth()->user(), $post]) }}">
                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="flex justify-between items-center">
                            <div class="mr-2 flex-1">
                                <h3>{{ __('Add method: if you need to separate paragraphs (breaking line), use enter and leave a white space') }}</h3>
                                <x-input-label for="method" :value="__('Method')" />
                                {{-- <x-textarea id="summary" class="block mt-1 w-full" name="intro" type="text">{{ $post->summary }}</x-textarea> --}}
                                <textarea rows="10" id="method" class="block mt-1 w-full" name="method" type="text" :value="old('method')" autofocus /></textarea>
                                <x-input-error :messages="$errors->get('method')" class="mt-2" />
                            </div>

                            
                            <div class="ml-2 flex-1">
                                <h3>{{ __('Similar to the method, however do not copy the exact text used above. This one goes to the recipe card. It\' crucial for SEO aspect') }}</h3>
                                <x-input-label for="method_recipe_card" :value="__('Method Recipe Card')" />
                                {{-- <x-textarea id="summary" class="block mt-1 w-full" name="intro" type="text">{{ $post->summary }}</x-textarea> --}}
                                <textarea rows="10" id="method_recipe_card" class="block mt-1 w-full" name="method_recipe_card" type="text" :value="old('method_recipe_card')" /></textarea>
                                <x-input-error :messages="$errors->get('method_recipe_card')" class="mt-2" />
                            </div>
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


