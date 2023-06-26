<x-app-layout>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    
                {{ __('Modify title group for: ') }}
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
 
                    <form method="POST" action="{{ route('posts.methods.groups.updateTitle', [$methodGrouped, auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex justify-between">

                                {{-- method group name --}}
                            <div class="mt-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$methodGrouped->title" required />
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


