@props(['active' => false])


<li>
    <a {{ $attributes }}
        class="{{ $active ?  'flex items-center p-2 text-gray-100  rounded-lg bg-teal-700 group' : 'flex items-center p-2 text-gray-100  rounded-lg hover:bg-teal-500 group' }}"
        aria-current="{{ $active ? 'page' : false }}">{{ $slot }}
    </a>
</li>