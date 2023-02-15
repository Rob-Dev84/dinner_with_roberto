<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 
            {{ __('Group ingredients for: ') }}
            {{ $post->title }}
            
        </h2>
    </x-slot>

<div class="flex justify-around">

    {{-- Create new Group --}}
    <div class="py-2 flex-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    

                    {{-- If there insn't any ingredient available, don't show the form --}}

                    @if (count($ingredients->where("post_ingredient_group_id", null)))
                        
                    <h3>{{ __('Create new Ingredients Group') }}</h3>

                    <form method="POST" action="{{ route('posts.ingredients.groups.store', [auth()->user(), $post]) }}">
                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="flex justify-between">
                           
                            {{-- name --}}
                            <div class="mt-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                       
                        <h3>{{ __('ingredients available:') }}</h3>
                        <div class="pb-6">
                            
                            <ul class="">
                                @foreach ($ingredients as $ingredient)
                                    {{-- we want to show only ingrediens not grouped yet --}}
                                    @if (is_null($ingredient->post_ingredient_group_id))
                                        <li class="flex justify-between items-center odd:bg-gray-200">
                                            <div class="ml-2">
                                                {{ $ingredient->quantity }}
                                                {{ $ingredient->unit }}
                                                {{ $ingredient->name }}
                                            </div>
                                            
                                            <div class="mr-6">
                                                {{-- <x-input-label for="ingredient" :value="__('Title')" /> --}}
                                                <x-text-input id="" class="" type="checkbox" name="ingredient[]" :value="$ingredient->id" />
                                                    {{-- <input type="checkbox" name="ingredient[]" :value="$ingredient->ingredient_groups_id"> --}}
                                                <x-input-error :messages="$errors->get('ingredient')" class="mt-2" />
                                            </div>   
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Add New Group') }}
                            </x-primary-button>
                        </div>
                    </form>

                    @else
                        {{ __('You don\'t have ingredients to group') }}
                    @endif
                
                </div>
            </div>
        </div>
    </div>

    {{-- Add Ingredients to existing Group --}}
    <div class="py-2 flex-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    

                    {{-- If there insn't any ingredient available, don't show the form --}}

                    @if (count($ingredients->where("post_ingredient_group_id", null)))
                        
                    <h3>{{ __('Add Ingredients to existing Group') }}</h3>
                    
                    <form method="POST" action="{{ route('posts.ingredients.groups.update', [auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex justify-between">
                           
                           

                            <div class="mt-4">
                                <x-input-label for="group_title" :value="__('Select group')" />
                                <select name="group_title" id="group_title">
                                    <option value="">{{ __('Select group') }}</option>

                                    @foreach ($ingredientsGroups as $group)
                                    {{-- //TODO make selected working) --}}
                                        <option :value="{{ $group->id }}" @selected(old('group_title', $group->title))">{{ $group->title }}</option>
                                    @endforeach
                                    
                                </select>
                                <x-input-error :messages="$errors->get('group_title')" class="mt-2" />
                            </div>
                        </div>

                       
                        <h3>{{ __('ingredients not grouped yet:') }}</h3>
                        <div class="pb-6">
                            
                            <ul class="">
                                @foreach ($ingredients as $ingredient)
                                    {{-- we want to show only ingrediens not grouped yet --}}
                                    @if (is_null($ingredient->post_ingredient_group_id))
                                        <li class="flex justify-between items-center odd:bg-gray-200">
                                            <div class="ml-2">
                                                {{ $ingredient->quantity }}
                                                {{ $ingredient->unit }}
                                                {{ $ingredient->name }}
                                            </div>
                
                                            <div class="mr-6">
                                                {{-- <x-input-label for="ingredient" :value="__('Title')" /> --}}
                                                <x-text-input id="" class="" type="checkbox" name="group_ingredient[]" :value="$ingredient->id" />
                                                <x-input-error :messages="$errors->get('group_ingredient')" class="mt-2" />
                                            </div>   
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Add Existing Group') }}
                            </x-primary-button>

                            {{-- <form method="POST" action="{{ route('post.ingredients.groups.destroy', [$ingredientGrouped, auth()->user(), $post]) }}">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ml-4">
                                        {{ __('Add Existing Group') }}
                                    </x-primary-button>
                                </div>
                            </form> --}}
                        </div>
                    </form>

                    @else
                        <p>{{ __('You don\'t have ingredients to group') }}</p>
                    @endif
                
                </div>
            </div>
        </div>
    </div>
</div>



</x-app-layout>


