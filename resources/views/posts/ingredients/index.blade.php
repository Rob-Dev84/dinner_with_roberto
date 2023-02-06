<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 
            {{ __('Ingredients for: ') }}
            {{ $post->title }}
            
        </h2>
    </x-slot>

    <div class="flex justify-between">
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="pb-6 flex flex-col">
                            <h3>{{ __('Total ingredients inserted:') }}</h3>

                            <ul>
                                @foreach ($ingredientsInserted as $ingredient)
                                    <li class="flex justify-between odd:bg-gray-200">
                                        <div>
                                            
                                            {{ $ingredient->quantity }}
                                            {{ $ingredient->unit }}
                                            {{ $ingredient->name }}
                                        </div>

                                        <div>
                                            {{ __('Mod') }}
                                            {{ __('Del') }}
                                        </div>   
                                    </li>
                                @endforeach
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
                            <h3>{{ __('Ingredients not grouped:') }}</h3>

                            <ul>
                                @if ($ingredientsNotGruoped->count() > 0)
                                <li class="flex justify-between odd:bg-gray-200">
                                    <div>
                                        
                                        {{ $ingredient->quantity }}
                                        {{ $ingredient->unit }}
                                        {{ $ingredient->name }}
                                    </div>

                                    <div>
                                        {{ __('Mod') }}
                                        {{ __('Del') }}
                                    </div>   
                                </li>
                                @else
                                    <p>{{ __('You don\'heve not grouped ingredients') }}</p>
                                @endif
                            </ul>

                            @if ($ingredientsNotGruoped->count() > 0)
                                <x-nav-link :href="route('posts.ingredients.groups', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.create')">
                                    {{ __('Group ingredients') }}
                                </x-nav-link>
                            @else
                                <span class="opacity-20" title="You need at least two ingredients to group them">{{ __('Group ingredients') }}</span>
                            @endif
                                
                            
                            {{-- @if ($ingredientsGroups->where('post_ingredient_group_id', NULL)->count() > 1)
                                <x-nav-link :href="route('posts.ingredients.groups', [auth()->user(), $post->slug])" :active="request()->routeIs('posts.create')">
                                    {{ __('Group ingredients') }}
                                </x-nav-link>
                            @else
                                <span class="opacity-20" title="You need at least two ingredients to group them">{{ __('Group ingredients') }}</span>
                                
                            @endif --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
    

                        {{-- Check if ingredients are grouped, you show title and related ingredients --}}

                        <div class="pb-6 flex flex-col">
                            <h3>{{ __('Ingredients grouped:') }}</h3>
                            <ul>

                                @forelse ($ingredientsInserted as $index => $ingredient)

                                    @if ($index === 0)
                                        <h3><b>{{ $ingredient->postIngredientsGroups[0]->title }}</b></h3>
                                    @endif
                                
                                    <li class="flex justify-between odd:bg-gray-200">
                                        <div>
                                            
                                            {{ $ingredient->quantity }}
                                            {{ $ingredient->unit }}
                                            {{ $ingredient->name }}
                                        </div>

                                        <div>
                                            {{ __('Mod') }}
                                            {{ __('Del') }}
                                        </div>   
                                    </li>

                                @empty
                                    <p>{{ __('This recipe doesn\'t contain grouped ingredients') }}</p>
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
                    <h3>{{ __('Add ingredient') }}</h3>
                    <form method="POST" action="{{ route('posts.ingredients.store', [auth()->user(), $post]) }}">
                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="flex justify-between">
                            {{-- Quantity --}}
                            <div class="mt-4">
                                <x-input-label for="quantity" :value="__('Quantity')" />
                                <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" autofocus />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>
                            {{-- unit --}}
                            <div class="mt-4">
                                {{-- <x-input-label for="unit" :value="__('Unit')" />
                                <x-text-input id="unit" class="block mt-1 w-full" type="text" name="unit" :value="old('unit')" required autofocus />
                                <x-input-error :messages="$errors->get('unit')" class="mt-2" /> --}}

                                <x-input-label for="unit" :value="__('Unit')" />
                                <select name="unit" id="unit">
                                        <option value="">{{ __('Select Unit') }}</option>

                                    
                                        <option :value="{{ 'g'}}">{{ __('g') }}</option>
                                        <option :value="{{ 'ml'}}">{{ __('ml') }}</option>
                                        <option :value="{{ 'l'}}">{{ __('l') }}</option>
                                        <option :value="{{ 'kg'}}">{{ __('kg') }}</option>
                                    
                                </select>
                                <x-input-error :messages="$errors->get('unit')" class="mt-2" />

                            </div>
                            {{-- name --}}
                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
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


