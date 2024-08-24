<!DOCTYPE html>
<html lang="en" dir="ltr" data-mode="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Responsive Sidebar Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    {{--    @vite('resources/css/app.css')--}}


</head>
<body class="w-full h-screen bg-light text-light dark:bg-dark dark:text-dark">
<!-- Main Content Start -->
<main class="pt-6 px-4 pb-6 text-light bg-primary-100 dark:bg-black dark:text-dark h-full overflow-y-auto">
    <div class="mt-4 min-w-[calc(100vw - 4rem)] md:w-[30rem] lg:w-[35rem] bg-white card mx-auto drop-shadow-lg">
        <div class="flex flex-col justify-start items-center gap-4 py-12 px-6 relative lg:w-[25rem] mx-auto">
            <div class="h-16 flex justify-center items-center sm:grow md:grow-0">
                <p class="text-2xl flex items-center w-full px-3 text-primary">Inventory Management System</p>
            </div>
            <div class="w-full">
                <div class="flex w-full mt-5 justify-center">
                    <div class="flex gap-3">
                        <button class="btn text-white bg-green-500 border-green-600 hover:text-white hover:bg-green-800 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20">
                            <i class="fa-solid fa-xmark mr-1"></i>
                            <a href="{{ route('admin.loginPage') }}" class="">
                                Login
                            </a>
                        </button>
                        <button type="submit" class="btn text-white bg-blue-500 border-blue-600 hover:text-white hover:bg-blue-800 hover:border-blue-600 focus:text-white focus:bg-blue-600 focus:border-blue-600 focus:ring focus:ring-blue-100 active:text-white active:bg-blue-600 active:border-blue-600 active:ring active:ring-blue-100 dark:ring-blue-400/20">
                            <a href="{{ route('user.registrationForm') }}" class="">
                                Register
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<!-- Main Content End -->
<script type="module" src="{{ asset('assets/js/bcs-util.js') }}"></script>
<script type="module" src="{{ asset('assets/js/main.js') }}"></script>
@vite(['resources/js/backend.js'])
</body>
</html>
