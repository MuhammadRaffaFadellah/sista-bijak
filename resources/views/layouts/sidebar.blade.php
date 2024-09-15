<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img src="{{ asset('img/.png') }}" alt="sista-bijak" class="img img-fluid">
            <span class="mx-2 text-21 font-semibold text-white">SISTA BIJAK</span>
        </div>
    </div>
    <nav class="mt-10 pt-5" id="sidebar">
        <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25" href="/dashboard">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>
            <span class="mx-3">Dashboard</span>
        </a>
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="/resident-table">
            <svg class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"
                xmlns:xlink="http://www.w3.org/1999/xlink" >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m.213,9.145c-.341-.435-.264-1.063.171-1.404L8.919,1.062c1.814-1.419,4.348-1.42,6.162,0l8.535,6.679c.435.34.512.969.171,1.404-.197.252-.491.384-.788.384-.215,0-.433-.069-.615-.212L13.849,2.638c-1.088-.852-2.609-.852-3.697,0L1.616,9.316c-.436.34-1.063.262-1.403-.171Zm3.524,8.89c-2.166.591-3.737,2.679-3.737,4.965,0,.553.447,1,1,1s1-.447,1-1c0-1.379.973-2.684,2.263-3.035.533-.146.848-.695.702-1.228-.146-.534-.699-.847-1.228-.702Zm16.525,0c-.526-.146-1.082.168-1.228.702-.146.532.169,1.082.702,1.228,1.29.352,2.263,1.656,2.263,3.035,0,.553.447,1,1,1s1-.447,1-1c0-2.286-1.571-4.374-3.737-4.965Zm-15.763-7.035c-1.381,0-2.5,1.119-2.5,2.5s1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5-1.119-2.5-2.5-2.5Zm17.5,2.5c0-1.381-1.119-2.5-2.5-2.5s-2.5,1.119-2.5,2.5,1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5Zm-10-5.5c-1.381,0-2.5,1.119-2.5,2.5s1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5-1.119-2.5-2.5-2.5Zm0,7c-2.757,0-5,2.243-5,5v3c0,.553.447,1,1,1s1-.447,1-1v-3c0-1.654,1.346-3,3-3s3,1.346,3,3v3c0,.553.447,1,1,1s1-.447,1-1v-3c0-2.757-2.243-5-5-5Z"/>
            </svg>
            <span class="mx-3">Data Penduduk</span>
        </a>
        <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
        <a href="javascript::void(0)"
            class="flex items-center text-decoration-none style-none px-6 py-2 mt-4 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 w-full transition duration-75 group"
            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
            <svg class="w-6 h-6 flex-shrink-0  text-gray-500 transition duration-100 group-hover:text-gray-100 dark:text-gray-400 dark:group-hover:text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Tabel</span>
            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
        <ul id="dropdown-example" class="hidden space-y-2">
            <li>
                <a href="/resident-born"
                    class="flex items-center w-full py-2 text-base font-normal text-gray-700 transition duration-75 group hover:text-gray-100 hover:bg-gray-700 bg-opacity-25 pl-11">Penduduk Lahir</a>
            </li>
            <li>
                <a href="/resident-died"
                    class="flex items-center w-full py-2 text-base font-normal text-gray-700 transition duration-75 group hover:text-gray-100 hover:bg-gray-700 bg-opacity-25 pl-11">Penduduk Meninggal</a>
            </li>
        </ul>
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="/resident-table">
            <svg class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"
                xmlns:xlink="http://www.w3.org/1999/xlink" >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m.213,9.145c-.341-.435-.264-1.063.171-1.404L8.919,1.062c1.814-1.419,4.348-1.42,6.162,0l8.535,6.679c.435.34.512.969.171,1.404-.197.252-.491.384-.788.384-.215,0-.433-.069-.615-.212L13.849,2.638c-1.088-.852-2.609-.852-3.697,0L1.616,9.316c-.436.34-1.063.262-1.403-.171Zm3.524,8.89c-2.166.591-3.737,2.679-3.737,4.965,0,.553.447,1,1,1s1-.447,1-1c0-1.379.973-2.684,2.263-3.035.533-.146.848-.695.702-1.228-.146-.534-.699-.847-1.228-.702Zm16.525,0c-.526-.146-1.082.168-1.228.702-.146.532.169,1.082.702,1.228,1.29.352,2.263,1.656,2.263,3.035,0,.553.447,1,1,1s1-.447,1-1c0-2.286-1.571-4.374-3.737-4.965Zm-15.763-7.035c-1.381,0-2.5,1.119-2.5,2.5s1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5-1.119-2.5-2.5-2.5Zm17.5,2.5c0-1.381-1.119-2.5-2.5-2.5s-2.5,1.119-2.5,2.5,1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5Zm-10-5.5c-1.381,0-2.5,1.119-2.5,2.5s1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5-1.119-2.5-2.5-2.5Zm0,7c-2.757,0-5,2.243-5,5v3c0,.553.447,1,1,1s1-.447,1-1v-3c0-1.654,1.346-3,3-3s3,1.346,3,3v3c0,.553.447,1,1,1s1-.447,1-1v-3c0-2.757-2.243-5-5-5Z"/>
            </svg>
            <span class="mx-3">Migrasi</span>
        </a>
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="/forms">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <span class="mx-3">Data UMKM</span>
        </a>

        @if (auth()->check() && Auth::user()->role_id === 1)
            <a class="{{ request()->is('users') ? 'bg-gray-700 bg-opacity-25' : '' }} mt-4 flex items-center px-6 py-2 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                href="/user-management">
                <svg class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" height="20" width="17.5"
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                </svg>
                <span class="ml-5 ">Manajemen User</span>
            </a>
        @endif
    </nav>
</div>
