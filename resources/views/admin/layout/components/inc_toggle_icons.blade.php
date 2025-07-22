@php
    $icon = $icon ?? '';
@endphp

@if ($icon === 'chevron-left')
    {{-- Arrow Left --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="menu-toggle-icon" width="24" height="24"
         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
         stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M11 7l-5 5l5 5" />
        <path d="M17 7l-5 5l5 5" />
    </svg>
@elseif ($icon === 'chevron-right')
    {{-- Arrow Right --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="menu-toggle-icon" width="24" height="24"
         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
         stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M7 7l5 5l-5 5" />
        <path d="M13 7l5 5l-5 5" />
    </svg>
@elseif ($icon === 'x')
    {{-- X Icon --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="menu-toggle-icon" width="24" height="24"
         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
         stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M18 6l-12 12" />
        <path d="M6 6l12 12" />
    </svg>
@endif