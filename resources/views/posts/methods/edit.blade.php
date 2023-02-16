<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 
            {{ __('Modify method for: ') }}
            {{ $post->title }}
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                                            
                    <form method="POST" action="{{ route('posts.methods.update', [$method, auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')

                        {{-- Method --}}
                        <div class="mt-4">
                            <x-input-label for="method" :value="__('Method')" />
                            {{-- <x-textarea id="summary" class="block mt-1 w-full" name="intro" type="text">{{ $post->summary }}</x-textarea> --}}
                            <textarea rows="10" id="method" class="block mt-1 w-full" name="method" type="text" autofocus />{{ $method->method }}</textarea>
                            <x-input-error :messages="$errors->get('method')" class="mt-2" />
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


