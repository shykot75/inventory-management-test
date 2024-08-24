<!DOCTYPE html>
<html lang="en" dir="ltr" data-mode="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
{{--    @vite('resources/css/app.css')--}}
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }

    </style>


</head>
<body class="w-full h-screen bg-light text-light dark:bg-dark dark:text-dark">
<!-- Main Content Start -->
<main class="pt-6 px-4 pb-6 text-light bg-primary-100 dark:bg-black dark:text-dark h-full overflow-y-auto">
    <div class="min-w-[calc(100vw - 4rem)] md:w-[30rem] lg:w-[35rem] bg-white card mx-auto drop-shadow-lg">
        <div class="flex flex-col justify-start items-center gap-4 py-6 px-6 relative lg:w-[25rem] mx-auto">
            <div class="h-16 flex justify-center items-center sm:grow md:grow-0">
                <p class="text-2xl flex items-center w-full px-3 text-primary">Inventory Management System</p>
            </div>
            @include('components.login-alert-message')
            <form action="{{ route('user.registration.store') }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="status" value="1">
                <div class="flex flex-col justify-start items-center w-full">
                    <div class="w-full">
                        <label for="name" class="form-input-label text-base">Name</label>
                        <div class="relative">
                            <input type="text" name="name" id="name" class="ltr:pl-10 rtl:pr-10 form-input " placeholder="Enter your name">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="username" class="form-input-label text-base">Email</label>
                        <div class="relative">
                            <input type="email" name="email" id="username" class="ltr:pl-10 rtl:pr-10 form-input " placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="phone" class="form-input-label text-base">Phone</label>
                        <div class="relative">
                            <input type="number" name="phone" id="phone" class="ltr:pl-10 rtl:pr-10 form-input "
                                   min="0" oninput="validity.valid||(value='');" onwheel="this.blur()" placeholder="Enter your phone">
                        </div>
                    </div>

                    <div class="w-full">
                        <label for="password" class="form-input-label text-base">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" class="ltr:pl-10 rtl:pr-10 form-input " placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="password_confirmation" class="form-input-label text-base">Confirm Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password" class="ltr:pl-10 rtl:pr-10 form-input " placeholder="Re-Enter your password">
                        </div>
                    </div>

                    <div class="w-full">
                        <button type="submit" class="btn w-full mt-6 bg-primary text-white font-medium text-lg">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</main>
<!-- Main Content End -->
<script type="module" src="{{ asset('assets/js/bcs-util.js') }}"></script>
<script type="module" src="{{ asset('assets/js/main.js') }}"></script>
@vite(['resources/js/backend.js'])
</body>
</html>
