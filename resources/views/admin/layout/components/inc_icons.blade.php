@php
    $icon = $icon ?? '';
@endphp

@if ($icon === 'job')
    {{-- Job --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase menu-icon">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
        <path d="M12 12l0 .01" />
        <path d="M3 13a20 20 0 0 0 18 0" />
    </svg>
@elseif ($icon === 'lab')
    {{-- Lab Availability --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-flask menu-icon">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M9 3l6 0" />
        <path d="M10 9l4 0" />
        <path d="M10 3v6l-4 11a.7 .7 0 0 0 .5 1h11a.7 .7 0 0 0 .5 -1l-4 -11v-6" />
    </svg>
@elseif ($icon === 'iso')
    {{-- ISO Documents --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-file-certificate menu-icon">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
        <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5" />
        <path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
        <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5" />
    </svg>
@elseif ($icon === 'backup')
    {{-- Backup file --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-database menu-icon">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 6m-8 0a8 3 0 1 0 16 0a8 3 0 1 0 -16 0" />
        <path d="M4 6v6a8 3 0 0 0 16 0v-6" />
        <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
    </svg>
@elseif ($icon === 'report')
    {{-- Project Status Report --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-report menu-icon">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
        <path d="M18 14v4h4" />
        <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
        <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
        <path d="M8 11h4" />
        <path d="M8 15h3" />
    </svg>
@elseif ($icon === 'visualization')
    {{-- Project Visualization --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-topology-star-3 menu-icon">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M10 19a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" />
        <path d="M18 5a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" />
        <path d="M10 5a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" />
        <path d="M6 12a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" />
        <path d="M18 19a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" />
        <path d="M14 12a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" />
        <path d="M22 12a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z" />
        <path d="M6 12h4" />
        <path d="M14 12h4" />
        <path d="M15 7l-2 3" />
        <path d="M9 7l2 3" />
        <path d="M11 14l-2 3" />
        <path d="M13 14l2 3" />
    </svg>
@elseif ($icon === 'test')
    {{-- Test Equipment --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-tools menu-icon">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M3 21h4l13 -13a1.5 1.5 0 0 0 -4 -4l-13 13v4" />
        <path d="M14.5 5.5l4 4" />
        <path d="M12 8l-5 -5l-4 4l5 5" />
        <path d="M7 8l-1.5 1.5" />
        <path d="M16 12l5 5l-4 4l-5 -5" />
        <path d="M16 17l-1.5 1.5" />
    </svg>
@endif