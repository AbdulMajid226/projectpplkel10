<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>@yield('title')</x-slot:title>
</x-header>

<body class="bg-gray-100">
    <!--Navbar  -->
    <x-nav-bar>
        <x-slot:name>{{ Auth::user()->name }}</x-slot:name>
        <x-slot:email>{{ Auth::user()->email }}</x-slot:email>
        <x-slot:role>@yield('role')</x-slot:role>
    </x-nav-bar>

    <!--SideBar  -->
    <x-side-bar>
        <x-slot:items>
            @yield('sidebar')
        </x-slot:items>
    </x-side-bar>

    <!-- Main Content -->
    <main class="flex-1 p-8 mt-10 space-y-6 sm:ml-2 md:ml-60 lg:ml-60">
        @yield('content')
    </main>
</body>

</html>
