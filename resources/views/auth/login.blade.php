<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div> 
            <x-input-error :messages="$errors->get('email')" class="mt-2 mb-2 text-center" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="Email@gmail.com" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-12" placeholder="Kata Sandi"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

                <!-- Icon Mata -->
                <button type="button" onclick="togglePassword()" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path id="eye-open" d="M10 4.5c-5 0-9 4.5-9 5.5s4 5.5 9 5.5 9-4.5 9-5.5-4-5.5-9-5.5zm0 9c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-1.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/>
                        <path id="eye-closed" d="M3.9 3.9L3.2 3.2a.7.7 0 00-1 1l14 14a.7.7 0 001-1l-2-2A9.6 9.6 0 0019 10c0-1-4-5.5-9-5.5-1.7 0-3.3.5-4.7 1.4L3.9 3.9zm1.7 1.7a7.6 7.6 0 018.2 8.2l-2.5-2.5c.4-.7.7-1.4.7-2.3a4 4 0 00-4-4c-.9 0-1.6.3-2.3.7L5.6 5.6zM6.8 8c-.5.5-.8 1.1-.8 2 0 2.2 1.8 4 4 4 .9 0 1.5-.3 2-1l-1.2-1.2c-.2.1-.5.2-.8.2-1.1 0-2-.9-2-2 0-.3.1-.6.2-.8L6.8 8z" style="display:none"/>
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpenIcon = document.getElementById('eye-open');
            const eyeClosedIcon = document.getElementById('eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpenIcon.style.display = 'none';
                eyeClosedIcon.style.display = 'inline';
            } else {
                passwordInput.type = 'password';
                eyeOpenIcon.style.display = 'inline';
                eyeClosedIcon.style.display = 'none';
            }
        }
    </script>

    <style>
        /* CSS untuk menambahkan efek coret pada ikon mata */
        #eye-closed {
            display: none; /* Sembunyikan ikon mata tertutup secara default */
        }
        .eye-icon {
            position: absolute;
            right: 10px; /* Atur posisi ikon mata */
            top: 50%;
            transform: translateY(-50%);
        }
        /* Efek coret */
        .eye-icon-crossover {
            stroke: red; /* Warna coretan */
            stroke-width: 2; /* Ketebalan coretan */
            stroke-linecap: round; /* Ujung coretan bulat */
            display: none; /* Sembunyikan coretan secara default */
        }
    </style>
</x-guest-layout>