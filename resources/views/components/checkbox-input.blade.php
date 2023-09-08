<div>
    <input 
        type="checkbox" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        id="{{ $name }}" 
            {{ $attributes->merge([
                'class' => 'cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) 
            }}
    >
    
    <label for="{{ $name }}">
        {{ $slot }}
    </label>
</div>
