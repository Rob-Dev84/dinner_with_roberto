<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modify subcategory to the post: ') }}
            <u>{{ $post->title }}</u> 
        </h2>
    </x-slot>
    

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                    <div class="p-6 text-gray-900">  
                        <h3>{{ __('Modify Category') }}</h3>
                        <form method="POST" action="{{ route('posts.subcategories.update', [auth()->user(), $post]) }}">
                            @csrf
                            @method('PUT')

                            {{-- <div class="relative"> --}}
                              <select name="subcategory" class="block appearance-none w-full bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                @forelse($subcategories as $subcategory)
                                  <option value="{{ $subcategory->id }}" {{ $subcategory->id === $post->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                @empty
                                  <option value="">{{ __('This blog doesn\'t have any subcategory yet') }}</option>
                                @endforelse
                              </select>
                              <x-input-error :messages="$errors->get('subcategory')" class="mt-2" />
                            {{-- </div> --}}
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Modify') }}
                                </x-primary-button>  
                            </div>
                        </form>   
                    </div>




            </div>
        </div>
    </div>

</x-app-layout>


