<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("If you delete this image, it'll be permanently deleted and you won't be able to restore it") }}
        </p>
    </header>

    <x-danger-button
        x-data="{  }"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-image-deletion-{{$image->id}}')"
    >{{ __('Delete Image') }}</x-danger-button>

    <x-modal name="confirm-image-deletion-{{ $image->id }}" :show="$errors->userDeletion->isNotEmpty()">
        <form method="post" action="{{ route('posts.images.destroy', [$image->id, auth()->user(), $post->slug]) }}" class="p-6">
            @csrf
            @method('DELETE')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this image?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('The deleted image will be permanently delated') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Image') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    
</section>
