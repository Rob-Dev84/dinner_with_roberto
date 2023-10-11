<a 
    href="{{ $href }}" 
    class="
        uppercase 
        {{-- underline  --}}
        transition 
        duration-500 
        {{-- hover:bg-primary-300  --}}
        {{-- decoration-primary-300 --}}
        {{-- shadow --}}
        {{-- hover:shadow-lg --}}
        border-b
        {{-- bg-primary-500 --}}
        shadow-[inset_0_-4px_0_0_rgba(143,169,217,0.8)]
        hover:shadow-[inset_0_-24px_60px_0_rgba(143,169,217,0.8)]


        {{-- box-shadow: inset 0 -24px 0 #d3e2d1 --}}
        {{ $active ? 'active' : '' }}">
    {{ $text }}
</a>
