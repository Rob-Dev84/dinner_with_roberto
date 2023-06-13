<section class="space-y-6">
    {{-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Remove Tag') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("The tag won't associate to the current post.") }}
        </p>
    </header> --}}

    <x-danger-button
        title="{{ __('Delete Tag') }}"
        class="rounded-full"
        x-data="{  }"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-tag-deletion-{{$postTag->tags->first()->id}}')"
    >
    {{-- {{ __('Remove Tag') }} --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
    </x-danger-button>

    <x-modal name="confirm-tag-deletion-{{ $postTag->tags->first()->id }}" :show="$errors->userDeletion->isNotEmpty()">
        <form method="post" action="{{ route('posts.tags.destroy', [auth()->user(), $post, $postTag->tags->first()->id]) }}" class="p-6">
            @csrf
            @method('DELETE')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this tag?') }}
            </h2>

            <span>
                {{ __('Tag: ') }}
                {{ $postTag->tags->first()->name }}
            </span>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('You can assigne this Tag to the post in the future.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Tag') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    
</section>
