@props(['active' => false])

<a {{ $attributes }}
class="{{ $active ?  'block py-2.5 px-4 rounded bg-teal-700 text-white' : 'block py-2.5 px-4 rounded  hover:bg-teal-700 text-white' }}"
aria-current="{{ $active ? 'page' : false }}">{{ $slot }}
</a>
