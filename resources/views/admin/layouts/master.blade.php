<!DOCTYPE html>
<html lang="en" dir="ltr" data-mode="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

</head>
<body class="w-full bg-body-light text-light dark:bg-dark dark:text-dark">
<!-- Navbar Start -->
@include('admin.layouts.includes.navbar')
<!-- Navbar End -->
<div class="flex">
    <!-- Sidebar Start -->
    @include('admin.layouts.includes.sidebar')
    <!-- Sidebar End -->
    <!-- Main Content Start -->
    <main class="w-full min-h-full pt-4 px-4 pb-12 text-light dark:bg-black dark:text-dark">
        @yield('breadcrumbs')
        <x-message.alert></x-message.alert>
        @yield('content')
    </main>
    <!-- Main Content End -->
</div>

<!-- Notification Drawer -->
<div id="notification-drawer"
     class="drawer fixed inset-y-0 right-0 w-64 bg-light text-light dark:bg-dark dark:text-dark shadow-slate-200 dark:shadow-slate-900 ease-in-out  transition-all duration-500  transform -translate-x-full hidden">
    <div class="drawer-header shadow-md">
        <h2 class="text-lg font-semibold border-b p-4">Notifications</h2>
    </div>
    <div class="px-4 pt-4 pb-6 drawer-body">
        <ul class="space-y-2">
            <li class="bg-gray-700 p-2 rounded">Notification 1</li>
            <li class="bg-gray-700 p-2 rounded">Notification 2</li>
            <li class="bg-gray-700 p-2 rounded">Notification 3</li>
        </ul>

    </div>
</div>
<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden ease-in-out transition-all duration-500"></div>
<script type="module" src="{{ asset('assets/js/bcs-util.js') }}"></script>
<script type="module" src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
