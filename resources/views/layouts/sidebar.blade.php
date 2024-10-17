<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden sidebar"></div>
<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed sidebar inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center">
        <div class="flex items-center max-w-full mt-7">
            <img src="{{ asset('/img/logo-kel-kesambi.png') }}" alt="sista-bijak" class="w-auto h-28">
            <span class="mr-5 text-50 font-semibold text-white">SISTA BIJAK</span>
        </div>
    </div>
    <style>
        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .active {
            background-color: rgba(55, 65, 81, 0.25);
        }

        .active span {
            color: #fff;
        }

        .active svg {
            color: #fff;
        }
    </style>
    <nav id="sidebar" class="mt-8">
        <div class="nav__link">
            <a class="active flex items-center text-decoration-none style-none px-6 py-2 mt-4 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 w-full transition duration-75 group"
                href="/dashboard">
                <svg class="w-6 h-6 flex-shrink-0 text-gray-600 transition duration-100 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>
        </div>

        <div class="nav__link">
            <a class="flex items-center text-decoration-none style-none px-6 py-2 mt-4 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 w-full transition duration-75 group"
                href="/metadata">
                <svg class="w-6 h-6 flex-shrink-0 text-gray-600 transition duration-100 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M20 2H4C2.895 2 2 2.895 2 4v16c0 1.105.895 2 2 2h16c1.105 0 2-.895 2-2V4c0-1.105-.895-2-2-2zM4 0h16c2.211 0 4 1.789 4 4v16c0 2.211-1.789 4-4 4H4C1.789 24 0 22.211 0 20V4C0 1.789 1.789 0 4 0zM6 6h12v2H6V6zm0 4h12v2H6v-2zm0 4h12v2H6v-2zm0 4h12v2H6v-2z" />
                </svg>
                <span class="mx-3">Metadata</span>
            </a>
        </div>

        <div class="nav__link">
            <a class="flex items-center text-decoration-none style-none px-6 py-2 mt-4 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 w-full transition duration-75 group"
                href="/resident-table">
                <svg class="w-6 h-6 flex-shrink-0 text-gray-600 transition duration-100 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="m.213,9.145c-.341-.435-.264-1.063.171-1.404L8.919,1.062c1.814-1.419,4.348-1.42,6.162,0l8.535,6.679c.435.34.512.969.171,1.404-.197.252-.491.384-.788.384-.215,0-.433-.069-.615-.212L13.849,2.638c-1.088-.852-2.609-.852-3.697,0L1.616,9.316c-.436.34-1.063.262-1.403-.171Zm3.524,8.89c-2.166.591-3.737,2.679-3.737,4.965,0,.553.447,1,1,1s1-.447,1-1c0-1.379.973-2.684,2.263-3.035.533-.146.848-.695.702-1.228-.146-.534-.699-.847-1.228-.702Zm16.525,0c-.526-.146-1.082.168-1.228.702-.146.532.169,1.082.702,1.228,1.29.352,2.263,1.656,2.263,3.035,0,.553.447,1,1,1s1-.447,1-1c0-2.286-1.571-4.374-3.737-4.965Zm-15.763-7.035c-1.381,0-2.5,1.119-2.5,2.5s1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5-1.119-2.5-2.5-2.5Zm17.5,2.5c0-1.381-1.119-2.5-2.5-2.5s-2.5,1.119-2.5,2.5,1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5Zm-10-5.5c-1.381,0-2.5,1.119-2.5,2.5s1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5-1.119-2.5-2.5-2.5Zm0,7c-2.757,0-5,2.243-5,5v3c0,.553.447,1,1,1s1-.447,1-1v-3c0-1.654,1.346-3,3-3s3,1.346,3,3v3c0,.553.447,1,1,1s1-.447,1-1v-3c0-2.757-2.243-5-5-5Z" />
                </svg>
                <span class="mx-3">Tabel Penduduk</span>
            </a>
        </div>

        {{-- Side Migrasi --}}
        <!-- <div class="nav__link">
            <a class="flex items-center text-decoration-none style-none px-6 py-2 mt-4 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 w-full transition duration-75 group"
                href="/resident-migration">
                <svg class="w-6 h-6 flex-shrink-0 text-gray-600 transition duration-100 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12 2C11.4477 2 11 2.44772 11 3V5C11 5.55228 11.4477 6 12 6H15C16.1046 6 17 6.89543 17 8V9.58579L19.2929 7.29289C19.6834 6.90237 20.3166 6.90237 20.7071 7.29289C21.0976 7.68342 21.0976 8.31658 20.7071 8.70711L17 12.4142L13.2929 8.70711C12.9024 8.31658 12.9024 7.68342 13.2929 7.29289C13.6834 6.90237 14.3166 6.90237 14.7071 7.29289L17 9.58579V8C17 7.44772 16.5523 7 16 7H13V3C13 2.44772 12.5523 2 12 2ZM7 7C8.10457 7 9 7.89543 9 9V11H7C5.89543 11 5 11.8954 5 13V16C5 17.1046 5.89543 18 7 18H9V19C9 20.1046 8.10457 21 7 21C5.89543 21 5 20.1046 5 19V17C3.89543 17 3 16.1046 3 15V13C3 11.8954 3.89543 11 5 11V9C5 7.89543 5.89543 7 7 7Z" />
                </svg>
                <span class="mx-3">Migrasi Penduduk</span>
            </a>
        </div> -->

        <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
        <style>
            /* Animasi untuk dropdown */
            .dropdown-enter {
                opacity: 0;
                transform: translateY(-10px);
            }

            .dropdown-enter-active {
                opacity: 1;
                transform: translateY(0);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            .dropdown-exit {
                opacity: 1;
                transform: translateY(0);
            }

            .dropdown-exit-active {
                opacity: 0;
                transform: translateY(-10px);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            /* Ikon bergerak ke atas saat dropdown terbuka */
            .icon-rotate {
                transform: rotate(180deg);
                transition: transform 0.3s ease;
            }
        </style>

        <!-- Dropdown Migrasi -->
        <a href="javascript::void(0)"
            class="flex items-center text-decoration-none style-none px-6 py-2 mt-4 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 w-full transition duration-75 group"
            aria-controls="dropdown-migrasi" id="dropdownToggleMigrasi">
            <i class="fas fa-home pt-0.5 pl-0.5 w-6 h-6"></i>
            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Migrasi Penduduk</span>
            <svg id="iconArrowMigrasi" class="w-6 h-6 transition-transform duration-300" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
        <ul id="dropdown-migrasi" class="hidden space-y-2 transition-all duration-300 pt-2">
            <li>
                <div class="nav__link">
                    <a href="/resident-migration-in"
                        class="flex items-center w-full py-2 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 transition duration-75 group pl-11">
                        <span>Migrasi Masuk</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="nav__link">
                    <a href="/resident-migration-out"
                        class="flex items-center w-full py-2 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 transition duration-75 group pl-11">
                        <span>Migrasi Keluar</span>
                    </a>
                </div>
            </li>
        </ul>

        <!-- Dropdown Tabel -->
        <a href="javascript:void(0)"
            class="flex items-center text-decoration-none style-none px-6 py-2 mt-4 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 w-full transition duration-75 group"
            aria-controls="dropdown-tabel" id="dropdownToggleTabel">
            <svg class="w-6 h-6 flex-shrink-0 text-gray-500 transition duration-100 group-hover:text-gray-100 dark:text-gray-400 dark:group-hover:text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Tabel</span>
            <svg id="iconArrowTabel" class="w-6 h-6 transition-transform duration-300" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
        <ul id="dropdown-tabel" class="hidden space-y-2 transition-all duration-300 pt-2">
            <li>
                <div class="nav__link">
                    <a href="/resident-born"
                        class="flex items-center w-full py-2 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 transition duration-75 group pl-11">
                        <span>Penduduk Lahir</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="nav__link">
                    <a href="/resident-died"
                        class="flex items-center w-full py-2 text-base font-normal hover:bg-gray-700 hover:bg-opacity-25 text-gray-500 hover:text-gray-100 transition duration-75 group pl-11">
                        <span>Penduduk Meninggal</span>
                    </a>
                </div>
            </li>
        </ul>

        {{-- Side UMKM --}}
        <div class="nav__link">
            <a class="flex items-center px-6 py-2 mt-4 {{ request()->is('umkm-table') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }} group"
                href="/umkm-table">
                <i
                    class="fas fa-store fa-lg {{ request()->is('umkm-table') ? 'text-gray-100' : 'text-gray-500 group-hover:text-gray-100' }}"></i>
                <span class="mx-3">Data UMKM</span>
            </a>
        </div>

        @if (auth()->check() && auth()->user()->role_id == 1)
            {{-- <div class="nav__link">
                <a class="{{ request()->is('images-table') ? 'bg-gray-700 bg-opacity-25' : '' }} mt-4 flex items-center px-6 py-2 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/images-table">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24">
                        <path
                            d="M21 8V6c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v2H1v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8h-2zm-2 10H5v-2h14v2zm0-4H5v-2h14v2zm0-4H5V8h14v2z"
                            fill="currentColor" />
                    </svg>
                    <span class="mx-3">Manajemen Gambar</span>
                </a>
            </div> --}}

            <div class="nav__link">
                <a class="{{ request()->is('user-management') ? 'bg-gray-700 bg-opacity-25' : '' }} mt-4 flex items-center px-6 py-2 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/user-management">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" height="20" width="17.5"
                        fill="currentColor" viewBox="0 0 448 512">
                        <path
                            d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                    </svg>
                    <span class="mx-3">Manajemen User</span>
                </a>
            </div>
        @endif
    </nav>

    <script>
        const navLinkEls = document.querySelectorAll('.nav__link a');

        // Fungsi untuk memperbarui kelas aktif
        function updateActiveLink() {
            // Hapus kelas 'active' dari semua link
            navLinkEls.forEach(navLinkEl => {
                navLinkEl.classList.remove('active');
            });

            // Ambil URL saat ini
            const currentPage = window.location.pathname;

            // Temukan tautan yang sesuai dengan URL saat ini
            const activeLink = Array.from(navLinkEls).find(navLinkEl => {
                return navLinkEl.getAttribute('href') === currentPage;
            });

            // Tambahkan kelas 'active' ke tautan yang sesuai
            if (activeLink) {
                activeLink.classList.add('active');
            }

            // Simpan status aktif di localStorage
            localStorage.setItem('activePage', currentPage);
        }

        // Muat status aktif saat halaman dimuat
        window.addEventListener('DOMContentLoaded', () => {
            // Panggil fungsi untuk memperbarui tautan aktif
            updateActiveLink();
        });

        // Hapus status aktif dari localStorage saat logout
        const logoutButton = document.getElementById('logoutButton');
        if (logoutButton) {
            logoutButton.addEventListener('click', () => {
                localStorage.removeItem('activePage');
            });
        }

        // Memperbarui status aktif saat tautan diklik
        navLinkEls.forEach(navLinkEl => {
            navLinkEl.addEventListener('click', (event) => {
                // Pastikan untuk memperbarui tautan aktif sebelum navigasi
                updateActiveLink();
            });
        });

        // Dropdown Tabel
        const dropdownToggleTabel = document.getElementById('dropdownToggleTabel');
        const dropdownMenuTabel = document.getElementById('dropdown-tabel');
        const iconArrowTabel = document.getElementById('iconArrowTabel');
        // Cek status dropdown Tabel dari localStorage
        const isTabelOpen = localStorage.getItem('dropdownTabel') === 'true';
        // Set status dropdown dan ikon berdasarkan localStorage
        if (isTabelOpen) {
            dropdownMenuTabel.classList.remove('hidden');
            iconArrowTabel.classList.add('icon-rotate');
        } else {
            dropdownMenuTabel.classList.add('hidden');
            iconArrowTabel.classList.remove('icon-rotate');
        }

        // Event listener untuk toggle dropdown Tabel
        dropdownToggleTabel.addEventListener('click', () => {
            const isCurrentlyOpen = dropdownMenuTabel.classList.contains('hidden');
            dropdownMenuTabel.classList.toggle('hidden');
            iconArrowTabel.classList.toggle('icon-rotate');
            localStorage.setItem('dropdownTabel', isCurrentlyOpen);
        });

        // Dropdown Migrasi
        const dropdownToggleMigrasi = document.getElementById('dropdownToggleMigrasi');
        const dropdownMenuMigrasi = document.getElementById('dropdown-migrasi');
        const iconArrowMigrasi = document.getElementById('iconArrowMigrasi');

        // Cek status dropdown Migrasi dari localStorage
        const isMigrasiOpen = localStorage.getItem('dropdownMigrasi') === 'true';

        // Set status dropdown dan ikon berdasarkan localStorage
        if (isMigrasiOpen) {
            dropdownMenuMigrasi.classList.remove('hidden');
            iconArrowMigrasi.classList.add('icon-rotate');
        } else {
            dropdownMenuMigrasi.classList.add('hidden');
            iconArrowMigrasi.classList.remove('icon-rotate');
        }

        // Event listener untuk toggle dropdown Migrasi
        dropdownToggleMigrasi.addEventListener('click', () => {
            const isCurrentlyOpen = dropdownMenuMigrasi.classList.contains('hidden');
            dropdownMenuMigrasi.classList.toggle('hidden');
            iconArrowMigrasi.classList.toggle('icon-rotate');
            localStorage.setItem('dropdownMigrasi', isCurrentlyOpen);
        });

        // Set active link di sidebar
        navLinkEls.forEach(navLinkEl => {
            navLinkEl.addEventListener('click', () => {
                document.querySelector('.nav__link a.active')?.classList.remove('active');
                navLinkEl.classList.add('active');
                localStorage.setItem('activePage', navLinkEl.getAttribute('href'));
            });
        });
    </script>
</div>
