<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 
            {{ __('Group methods for: ') }}
            {{ $post->title }}
            
        </h2>
    </x-slot>

<div class="flex justify-around">

    {{-- Create new Group --}}
    <div class="py-2 flex-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    

                    {{-- If there insn't any method available, don't show the form --}}

                    @if (count($methods->where("post_method_group_id", null)))
                        
                    <h3>{{ __('Create new methods Group') }}</h3>

                    <form method="POST" action="{{ route('posts.methods.groups.store', [auth()->user(), $post]) }}">
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

                       
                        <h3>{{ __('methods available:') }}</h3>
                        <div class="pb-6">
                            
                            <ul class="">
                                @foreach ($methods as $method)
                                    {{-- we want to show only methods not grouped yet --}}
                                    @if (is_null($method->post_method_group_id))
                                        <li class="flex justify-between items-center odd:bg-gray-200">
                                            <div class="ml-2">
                                                {{ $method->method }}
                                            </div>
                                            
                                            <div class="mr-6">
                                                {{-- <x-input-label for="method" :value="__('Title')" /> --}}
                                                <x-text-input id="" class="" type="checkbox" name="method[]" :value="$method->id" />
                                                    {{-- <input type="checkbox" name="method[]" :value="$method->method_groups_id"> --}}
                                                <x-input-error :messages="$errors->get('method')" class="mt-2" />
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
                        {{ __('You don\'t have methods to group') }}
                    @endif
                
                </div>
            </div>
        </div>
    </div>

    {{-- Add methods to existing Group --}}
    <div class="py-2 flex-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    

                    {{-- If there insn't any method available, don't show the form --}}

                    @if (count($methods->where("post_method_group_id", null)))
                        
                    <h3>{{ __('Add methods to existing Group') }}</h3>
                    
                    <form method="POST" action="{{ route('posts.methods.groups.update', [auth()->user(), $post]) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex justify-between">
                           
                           

                            <div class="mt-4">
                                <x-input-label for="group_title" :value="__('Select group')" />
                               
                                <select name="group_title" id="group_title">
                                    <option value="">{{ __('Select group') }}</option>

                                    @foreach ($methodsGroups as $group)
                                    {{-- //TODO make selected working) --}}
                                        <option :value="{{ $group->id }}" @selected(old('group_title', $group->title))">{{ $group->title }}</option>
                                    @endforeach
                                    
                                </select>
                                <x-input-error :messages="$errors->get('group_title')" class="mt-2" />
                            </div>
                        </div>

                       
                        <h3>{{ __('methods not grouped yet:') }}</h3>
                        <div class="pb-6">
                            
                            <ul class="">
                                @foreach ($methods as $method)
                                    {{-- we want to show only methods not grouped yet --}}
                                    @if (is_null($method->post_method_group_id))
                                        <li class="flex justify-between items-center odd:bg-gray-200">
                                            <div class="ml-2">
                                                {{ $method->method }}
                                            </div>
                
                                            <div class="mr-6">
                                                {{-- <x-input-label for="method" :value="__('Title')" /> --}}
                                                <x-text-input id="" class="" type="checkbox" name="group_method[]" :value="$method->id" />
                                                <x-input-error :messages="$errors->get('group_method')" class="mt-2" />
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

                            {{-- <form method="POST" action="{{ route('post.methods.groups.destroy', [$methodGrouped, auth()->user(), $post]) }}">
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
                        <p>{{ __('You don\'t have methods to group') }}</p>
                    @endif
                
                </div>
            </div>
        </div>
    </div>
</div>



</x-app-layout>


