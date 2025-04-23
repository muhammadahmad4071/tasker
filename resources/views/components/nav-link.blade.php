@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full text-blue-700 p-2 gap-3 inline-flex items-center text-sm font-medium leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out rounded-lg bg-gray-100'
            : 'cursor-pointer w-full gap-3 inline-flex items-center text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 p-2 rounded-lg focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
