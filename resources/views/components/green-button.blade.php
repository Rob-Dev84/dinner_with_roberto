<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-2 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
    @if (isset($use))
        <svg class="w-8 h-8 animate-icon">
            <use xlink:href="{{ $use }}" 
                {{ $attributes->merge(['fill' => '', 'stroke' => ''])}}
            >
            </use>
        </svg>
    @endif
</button>