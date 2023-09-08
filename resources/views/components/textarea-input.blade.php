{{-- <textarea {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) }}></textarea> --}}

{{-- <textarea {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm', 'value' => $value]) }}></textarea> --}}


@props(['disabled' => false, 
        'name', 
        'value' => ''
        // 'rows' => 8, 'cols' => 45, 'maxlength' => 65525
        ])

<textarea
    {{ $attributes->merge([
        'class' => 'w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
        'id' => $name,
        'name' => $name,
        // 'rows' => $rows,
        // 'cols' => $cols,
        // 'maxlength' => $maxlength,
        'disabled' => $disabled ? 'disabled' : null,
    ]) }}
>{{ $value }}</textarea>