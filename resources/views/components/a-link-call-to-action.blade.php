@props(['href', 'title', 'active', 'text', 'use'])

<a 
    @if(isset($href) && $href !== '')
        href="{{ $href }}"
        class="inline-block
                px-4 py-2
                text-white
                bg-primary-500
                rounded
                hover:bg-primary-600
                transition
                duration-200
                ease-in-out
                {{ $active ? 'active' : '' }}
                {{ isset($use) ? 'bg-transparent hover:bg-transparent px-2 py-2' : '' }}"
    @else
        class="inline-block
                px-4 py-2
                text-white
                bg-primary-500
                rounded
                ccursor-default	
                {{ isset($use) ? 'bg-transparent hover:bg-transparent px-2 py-2 opacity-20' : '' }}"
    @endif
    title="{{ $title }}" 
        >
    {{ $text }}
    @if (isset($use))
        <svg class="w-8 h-8 mr-2 animate-icon">
            <use xlink:href="{{ $use }}"></use>
        </svg>
    @endif
</a>
