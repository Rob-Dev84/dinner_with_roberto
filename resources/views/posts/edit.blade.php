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
                                                  
                    <form method="POST" action="{{ route('posts.edit', [auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')
                        <!-- Title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$post->title" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Subitle -->
                        <div class="mt-4">
                            <x-input-label for="subtitle" :value="__('Subtitle')" />
                            <x-text-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" :value="$post->subtitle" required autofocus />
                            <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            {{-- {{ $post->meta_description }} --}}
                            <x-input-label for="meta title" :value="__('Meta Title')" />
                            <x-textarea-input id="meta_title" name="meta_title" :value="$post->meta_title" />
                            <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="meta_description title" :value="__('Meta Description')" />
                            <x-textarea-input id="intro" name="intro" :value="$post->meta_description" />
                            <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="intro" :value="__('Intro')" />
                            <x-textarea-input id="intro" name="intro" :value="$post->intro" rows="8" cols="45" />
                            <x-input-error :messages="$errors->get('intro')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea-input id="description" name="description" :value="$post->description" rows="8" cols="45" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Visible Only for Admin -->
                        <div class="mt-4">
                            <x-input-label for="note" :value="__('Note')" />
                            <x-textarea-input id="note" name="note" :value="$post->note" rows="8" cols="45" />
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>

                        {{-- TODO: Add schema fields --}}


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


