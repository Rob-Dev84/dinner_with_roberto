<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 
            {{ __('Modify ingredient for: ') }}
            {{ $post->title }}
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                                                        {{-- posts.ingredients.update --}}
                    <form method="POST" action="{{ route('posts.ingredients.update', [$ingredient, auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex justify-between">
                            {{-- Quantity --}}
                            <div class="mt-4">
                                <x-input-label for="quantity" :value="__('Quantity')" />
                                <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="$ingredient->quantity" autofocus />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>

                            <div class="mt-4">{{-- //TODO select unit from database --}}
                                <x-input-label for="unit" :value="__('Unit')" />
                                <select name="unit" id="unit">
                                    {{-- <option value="">{{ __('Select Unit') }}</option> --}}
                                
                                    <option :value="{{ 'g'}}" {{ $ingredient->unit === 'g' ? 'selected' : '' }}>{{ __('g') }}</option>
                                    <option :value="{{ 'ml'}}" {{ $ingredient->unit === 'ml' ? 'selected' : '' }}>{{ __('ml') }}</option>
                                    <option :value="{{ 'l'}}" {{ $ingredient->unit === 'l' ? 'selected' : '' }}>{{ __('l') }}</option>
                                    <option :value="{{ 'kg'}}" {{ $ingredient->unit === 'kg' ? 'selected' : '' }}>{{ __('kg') }}</option>
                                    
                                </select>
                                <x-input-error :messages="$errors->get('unit')" class="mt-2" />

                            </div>

                                {{-- Ingredient name --}}
                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$ingredient->name" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


