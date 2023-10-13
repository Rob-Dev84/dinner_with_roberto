<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Modify Recipe SEO metadata to the post: ') }}
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
    {{-- {{ dd($postRecipeSeoMetadata) }} --}}

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="border"> --}}
            
                    <div class="p-6 text-gray-900 flex flex-col items-center w-full">  
        
                        <form class="" method="POST" action="{{ route('posts.recipes.metadatas.update', [auth()->user(), $post, $postRecipeSeoMetadata]) }}">
                            @csrf
                            @method('PUT')
                            <x-input-label for="cooking_method" :value="__('Cooking Method')" />
                            <select id="cooking_method" name="cooking_method" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                @forelse ($recipeCookingMethods as $cookingMethod)
                                    <option value="{{ $cookingMethod->id }}" {{ $cookingMethod->id ===  $postRecipeSeoMetadata->post_recipe_cooking_method_id ? 'selected': ''}}>{{ $cookingMethod->name}}</option>
                                @empty
                                    <option value="">{{ __('This blog doesn\'t have any cooking method yet') }}</option>
                                @endforelse
                 
                            </select>
                            <x-input-error :messages="$errors->get('cooking_method')" class="mt-2" />

                        
                            <div class="flex justify-between mt-4">
                                <div class="">
                                    <x-input-label for="prep_time_hours" :value="__('Prep. time Hours')" />
                                        <select id="prep_time_hours" name="prep_time_hours" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            {{-- <option value="0">{{ __('0 hours ') }}</option> --}}
                                            @for ($i = 0; $i < 50; $i++)
                                                <option value="{{ $i }}" {{ $i == $formattedPrepTime['hours'] ? 'selected' : '' }}>{{ $i }}{{ __(' hours') }}</option>
                                            @endfor
                                        </select>
                                    <x-input-error :messages="$errors->get('prep_time_hours')" class="mt-2" />
                                </div>

                                <div class="">
                                    <x-input-label for="prep_time_minutes" :value="__('Prep. time Minutes')" />
                                        <select id="prep_time_minutes" name="prep_time_minutes" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            {{-- <option value="0">{{ __('0 minutes ') }}</option> --}}
                                            @for ($i = 0; $i < 60; $i++)
                                                <option value="{{ $i }}" {{ $i == $formattedPrepTime['minutes'] ? 'selected' : '' }}>{{ $i }}{{ __(' minutes') }}</option>
                                            @endfor
                                        </select>
                                    <x-input-error :messages="$errors->get('prep_time_minutes')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex justify-between mt-4">
                                <div class="">
                                    <x-input-label for="cooking_time_hours" :value="__('Cook. time Hours')" />
                                        <select id="cooking_time_hours" name="cooking_time_hours" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            {{-- <option value="0">{{ __('0 hours ') }}</option> --}}
                                            @for ($i = 0; $i < 50; $i++)
                                                <option value="{{ $i }}" {{ $i == $formattedCookTime['hours'] ? 'selected' : '' }}>{{ $i }}{{ __(' hours') }}</option>
                                            @endfor
                                        </select>
                                    <x-input-error :messages="$errors->get('cooking_time_hours')" class="mt-2" />
                                </div>

                                <div class="">
                                    <x-input-label for="cooking_time_minutes" :value="__('Cook. time Minutes')" />
                                    <select id="cooking_time_minutes" name="cooking_time_minutes" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        {{-- <option value="0">{{ __('0 minutes ') }}</option> --}}
                                        @for ($i = 0; $i < 60; $i++)
                                        <option value="{{ $i }}" {{ $i == $formattedCookTime['minutes'] ? 'selected' : '' }}>{{ $i }}{{ __(' minutes') }}</option>
                                    @endfor
                                    </select>
                                    <x-input-error :messages="$errors->get('cooking_time_minutes')" class="mt-2" />
                                </div>
                            </div>
                            
                            <div class="flex justify-between mt-4">
                                <div class="">
                                    <x-input-label for="total_time_hours" :value="__('Tot. time Hours')" />
                                    <select id="total_time_hours" name="total_time_hours" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        {{-- <option value="0">{{ __('0 hours ') }}</option> --}}
                                        @for ($i = 0; $i < 50; $i++)
                                            <option value="{{ $i }}" {{ $i == $formattedTotTime['hours'] ? 'selected' : '' }}>{{ $i }}{{ __(' hours') }}</option>
                                        @endfor
                                    </select>
                                    <x-input-error :messages="$errors->get('total_time_hours')" class="mt-2" />
                                </div>

                                <div class="">
                                    <x-input-label for="total_time_minutes" :value="__('Tot. time Minutes')" />
                                    <select id="total_time_minutes" name="total_time_minutes" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        {{-- <option value="0">{{ __('0 minutes ') }}</option> --}}
                                        @for ($i = 0; $i < 60; $i++)
                                            <option value="{{ $i }}" {{ $i == $formattedTotTime['minutes'] ? 'selected' : '' }}>{{ $i }}{{ __(' minutes') }}</option>
                                        @endfor
                                    </select>
                                    <x-input-error :messages="$errors->get('prep_time_minutes')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="yield" :value="__('Yield')" />
                                <x-text-input id="yield" class="block mt-1 w-full" type="number" name="yield" min="1" max="50" :value="$postRecipeSeoMetadata->yield" />
                                <x-input-error :messages="$errors->get('yield')" class="mt-2" />
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Modify') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                {{-- </div> --}}

            </div>
        </div>
    </div>

</x-app-layout>



