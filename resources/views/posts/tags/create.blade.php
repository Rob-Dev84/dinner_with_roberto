<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modify categories to the post: ') }}
            <u>{{ $post->title }}</u> 
        </h2>
    </x-slot>
    

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border">
            
                    <div class="p-6 text-gray-900">  
                        <h3>{{ __('Add Blog Category') }}</h3>
                        <form method="POST" action="{{ route('posts.softDelete', [auth()->user(), $post]) }}">
                            @csrf
                            @method('POST')

                            {{-- Add Blog Post --}}
                            <div class="mt-4">
                                <x-input-label for="category" :value="__('Category')" />
                                <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category')" />
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>
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
    </div>

</x-app-layout>
