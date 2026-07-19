@props(['active' => false])
<a {{ $attributes }}
class="{{ $active ? 'bg-gray-900 px-3 py-2 text-sm font-medium text-white' : 
'rounded-md px-3 py-2 text-sm font-medium text-black hover:bg-white/5 hover:text-gray-400' }}" 
aria-current="{{ $active ? 'page' : false }}" {{ $attributes }}>{{ $slot }}</a>