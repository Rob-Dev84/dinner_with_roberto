<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Restore Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("You can only restore the image if the recipe doesn't already have an image in related section") }}
        </p>
    </header>

    <x-primary-button
        x-data="{  }"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-image-restore-{{$image->id}}')"
    >{{ __('Restore Image') }}</x-primary-button>

    <x-modal name="confirm-image-restore-{{ $image->id }}" :show="$errors->userDeletion->isNotEmpty()">
        <form method="post" action="{{ route('posts.images.deletions.restore', [$image->id, auth()->user(), $post->slug]) }}" class="p-6">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to restore this image?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('The restored image will be ') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('Restore Image') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
    
</section>
