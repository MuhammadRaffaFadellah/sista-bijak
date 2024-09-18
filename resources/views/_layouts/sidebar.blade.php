<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-cyan-800 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <!-- <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z" fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z" fill="white"/>
            </svg> -->
            <img class="w-22 h-28" src="{{ asset('img/Logo Si-PBJ.png') }}"/>
            <!-- <span class="mx-2 text-2xl font-semibold text-white">Dashboard</span> -->
        </div>
    </div>

    <nav class="mt-5">
        <!-- <a class="{{ request()->is('word') ? 'bg-gray-700 bg-opacity-25' : '' }} flex items-center px-6 py-2 mt-4 text-gray-100  hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('index') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>

            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>

            <span class="mx-3">Formulir</span>
        </a> -->

        <!-- <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/ui-elements">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>

            <span class="mx-3">UI Elements</span>
        </a> -->

        <button @click="dropdownOpen = !dropdownOpen;" 
                    id="formulir-menu-button" 
                    type="button" 
                    class="flex items-center w-full px-6 py-2 mt-4 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
                    aria-controls="dropdown-formulir" 
                    data-collapse-toggle="dropdown-formulir">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="flex-1 mx-3 text-left whitespace-nowrap">Formulir</span>
                
                <div class="arrow-icon"></div>
                
            </button>
            <ul id="dropdown-formulir" class="pl-4 py-2 space-y-2" style="display: none;">
                <li>
                    <a href="{{ route('form1') }}" class="{{ request()->is('form1') ? 'bg-gray-700 bg-opacity-25' : '' }} flex items-center w-full px-6 py-2 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 pl-11">
                    <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" width="15" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 464c-8.8 0-16-7.2-16-16L48 64c0-8.8 7.2-16 16-16l160 0 0 80c0 17.7 14.3 32 32 32l80 0 0 288c0 8.8-7.2 16-16 16L64 464zM64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-293.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0L64 0zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0z"/></svg>
                    &nbsp; Formulir 1
                    </a>
                </li>
                <!-- Other dropdown items -->
            </ul>
            

        <a class="{{ request()->is('files') || request()->is('/') ? 'bg-gray-700 bg-opacity-25' : '' }} flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('files.index') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>

            <span class="mx-3 ">Daftar Surat</span>
        </a>
        @if(auth()->check() && Auth::user()->role_id === 1)
        <a class="{{ request()->is('users') ? 'bg-gray-700 bg-opacity-25' : '' }} flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('users.index') }}">
            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" width="17.5" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/></svg>
            <span class="ml-5 ">Manajemen User</span>
        </a>
        <a class="{{ request()->is('kode') ? 'bg-gray-700 bg-opacity-25' : '' }} flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('programs.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg"  height="20" width="17.5" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM153 289l-31 31 31 31c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L71 337c-9.4-9.4-9.4-24.6 0-33.9l48-48c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9zM265 255l48 48c9.4 9.4 9.4 24.6 0 33.9l-48 48c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l31-31-31-31c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0z"/></svg>
            <span class="ml-5 ">Manajemen Kode</span>
        </a>
        @endif
    </nav>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const dropdownButton = document.querySelector("#formulir-menu-button");
    const dropdownMenu = document.getElementById("dropdown-formulir");
    const arrowIconDiv = dropdownButton.querySelector(".arrow-icon");

    // SVG icons for arrow up and down
    const arrowDownSVG = `
        <svg class="fill-white arrow-down-icon" xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>`;
    const arrowUpSVG = `
        <svg class="fill-white arrow-up-icon" xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/></svg>`;

    // Load the state from local storage
    const isDropdownOpen = localStorage.getItem("dropdown-formulir-open") === "true";

    // Use a timeout to avoid glitching
    setTimeout(() => {
        if (isDropdownOpen) {
            dropdownMenu.style.display = 'block';
            arrowIconDiv.innerHTML = arrowUpSVG;
        } else {
            dropdownMenu.style.display = 'none';
            arrowIconDiv.innerHTML = arrowDownSVG;
        }
    }, 200); // Timeout to ensure the style changes happen after the page is rendered

    dropdownButton.addEventListener("click", function() {
        // Toggle the dropdown visibility and icons
        if (dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
            arrowIconDiv.innerHTML = arrowDownSVG;
            localStorage.setItem("dropdown-formulir-open", "false");
        } else {
            dropdownMenu.style.display = 'block';
            arrowIconDiv.innerHTML = arrowUpSVG;
            localStorage.setItem("dropdown-formulir-open", "true");
        }
    });
});


</script>

</div>