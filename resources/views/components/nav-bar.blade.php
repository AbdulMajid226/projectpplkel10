<!-- Sidebar -->
<aside class="flex flex-col w-64 text-white bg-teal-800">
    <div class="flex items-center p-4 space-x-2">
        <img src="{{ asset('images/logo_simak_only.png') }}" alt="SIMAK Logo" class="w-10 h-10">
        <span class="text-xl font-semibold">SIMAK Undip</span>
    </div>
    <nav class="flex-1 px-4">
        {{ $items }}
    </nav>
    <div class="flex items-center p-4 space-x-2 border-t border-teal-700">
        <img src="{{ asset('images/Profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full">
        <div>
            <span>{{ $name }} </span>
            <br>
            <span class="text-sm">{{ $role }}</span>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="block w-full py-2.5 px-4 text-left rounded hover:bg-teal-700 text-white">
            Logout
        </button>
    </form>
</aside>