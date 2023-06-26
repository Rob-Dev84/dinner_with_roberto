<x-app-layout>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    
                {{ __('Modify method for: ') }}
                {{ $post->title }}
                
            </h2>
            <x-a-link 
                :href="route('posts.methods', [auth()->user(), $post->slug])"
                :active="request()->routeIs('posts.methods')" 
                :text=" __('Back')">
            </x-a-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                                            
                    <form method="POST" action="{{ route('posts.methods.update', [$method, auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex justify-between items-center">

                            {{-- Method --}}
                            <div class="mr-2 flex-1">
                                <x-input-label for="method" :value="__('Method')" />
                                {{-- <x-textarea id="summary" class="block mt-1 w-full" name="intro" type="text">{{ $post->summary }}</x-textarea> --}}
                                <textarea rows="10" id="method" class="block mt-1 w-full" name="method" type="text" autofocus />{{ $method->method }}</textarea>
                                <x-input-error :messages="$errors->get('method')" class="mt-2" />
                            </div>

                            {{-- Method Recipe card --}}
                            <div class="ml-2 flex-1">
                                <x-input-label for="method_recipe_card" :value="__('Method Recipe Card')" />
                                {{-- <x-textarea id="summary" class="block mt-1 w-full" name="intro" type="text">{{ $post->summary }}</x-textarea> --}}
                                <textarea rows="10" id="method_recipe_card" class="block mt-1 w-full" name="method_recipe_card" type="text" autofocus />{{ $method->method_recipe_card }}</textarea>
                                <x-input-error :messages="$errors->get('method_recipe_card')" class="mt-2" />
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


