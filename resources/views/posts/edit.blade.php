<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modify title recipe') }}
            
            {{ __('Add-Mod ingredients') }}
            {{ __('Add-Mod methods') }}
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                                                 {{-- posts.store --}}  
                    <form method="POST" action="{{ route('posts.edit', [auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')
                        <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$post->title" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            {{ $post->meta_description }}
                            <x-input-label for="meta title" :value="__('Meta Title')" />
                            {{-- <x-textarea id="meta_title" class="block mt-1 w-full" name="meta_title" type="text">{{ old('meta_title' ?? $post->meta_title) }}</x-textarea> --}}
                            <textarea id="meta_title" class="block mt-1 w-full" name="meta_title" type="text">{{ $post->meta_title }}</textarea>
                            <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="meta_description title" :value="__('Meta Description')" />
                            {{-- <x-textarea id="meta_description" class="block mt-1 w-full" name="meta_description">{{ old('meta_description' ?? $post->meta_title) }}</x-textarea> --}}
                            <textarea id="meta_title" class="block mt-1 w-full" name="meta_description" type="text">{{ $post->meta_description }}</textarea>
                            <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                        </div>

                        <!-- Img -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="$post->image" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="intro" :value="__('Intro')" />
                            {{-- <x-textarea id="summary" class="block mt-1 w-full" name="intro" type="text">{{ $post->summary }}</x-textarea> --}}
                            <textarea id="intro" class="block mt-1 w-full" name="intro" type="text">{{ $post->intro }}</textarea>
                            <x-input-error :messages="$errors->get('intro')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="note" :value="__('Note')" />
                            {{-- <x-textarea id="summary" class="block mt-1 w-full" name="intro" type="text">{{ $post->summary }}</x-textarea> --}}
                            <textarea id="note" class="block mt-1 w-full" name="note" type="text">{{ $post->note }}</textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
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


