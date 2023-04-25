<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new recipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                                                 {{-- posts.store --}}  
                    <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store', auth()->user()) }}">
                        @csrf

                        <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="meta title" :value="__('Meta Tile')" />
                            {{-- <x-text-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title" :value="old('meta_title')" /> --}}
                            <textarea id="meta_title" class="block mt-1 w-full" name="meta_title" type="text">{{ old('meta_title') }}</textarea>
                            <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="meta_description title" :value="__('Meta Description')" />
                            <textarea id="meta_description" class="block mt-1 w-full" name="meta_description" type="text"></textarea>
                            <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                        </div>

                        <!-- Img -->
                        <div class="mt-4">
                            <x-input-label for="img_link" :value="__('Image')" />
                            <x-text-input id="img_link" class="block mt-1 w-full" type="file" name="img_link" :value="old('img_link')" />
                            <x-input-error :messages="$errors->get('img_link')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="intro" :value="__('Intro')" />
                            <textarea id="intro" class="block mt-1 w-full" name="intro" type="text">{{ old('intro') }}</textarea>
                            <x-input-error :messages="$errors->get('intro')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="note" :value="__('Notes')" />
                            <textarea id="note" class="block mt-1 w-full" name="note" type="text">{{ old('note') }}</textarea>
                            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


