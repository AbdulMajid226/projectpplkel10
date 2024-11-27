<nav class="fixed top-0 z-50 w-full bg-gradient-to-t from-teal-800 to-teal-600 border-b border-gray-100">
    <div class="px-1 py-1 lg:px-3 lg:pl-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 text-gray-200 " aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="" class="flex ms-2 md:me-24">
                    <!-- Logo Undip -->
                    <img src="{{ asset('images/logo_simak_only.png') }}" alt="SIMAK Logo" class="w-10 h-10">
                    <span class="self-center text-xl font-semibold sm:text-2xl text-gray-100 pl-2 "> SIMAK
                        Undip</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3 ">
                    <!-- NAMA dan Role -->
                    <div class="px-5 ">
                        <span class="text-gray-100">{{ $name }}</span>
                        <br>
                        <span class="text-gray-200 text-sm flex justify-end">{{ $role }}</span>
                    </div>

                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 "
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <!-- Foto -->
                            <img class="w-8 h-8 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                    </div>

                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow "
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                {{$email}}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 py-2 text-sm rounded hover:bg-gray-100 text-gray-700">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>