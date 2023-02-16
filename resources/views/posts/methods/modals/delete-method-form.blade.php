<section class="space-y-6">
    {{-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Method') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your method is deleted, it will be permanently deleted.') }}
        </p>
    </header> --}}

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-method-deletion')"
    >{{ __('Del') }}</x-danger-button>

    <x-modal name="confirm-method-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('posts.methods.delete', [$method, auth()->user(), $post]) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your Method?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('If you proceed your method will be') }} 
                <b>{{  __(' permanently deleted') }}</b> 
                {{  __('.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Method') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
