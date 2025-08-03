@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-purple-500 text-start text-base font-medium text-purple-800 bg-purple-100 focus:outline-none focus:text-purple-900 focus:bg-purple-200 focus:border-purple-600 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-800 hover:text-gray-900 hover:bg-gray-100 hover:border-purple-300 focus:outline-none focus:text-gray-900 focus:bg-gray-100 focus:border-purple-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
