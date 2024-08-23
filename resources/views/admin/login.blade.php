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
    <div class="min-w-[calc(100vw - 4rem)] md:w-[30rem] lg:w-[35rem] bg-white card mx-auto drop-shadow-lg">
        <div class="flex flex-col justify-start items-center gap-4 py-12 px-6 relative lg:w-[25rem] mx-auto">
            <div class="h-16 flex justify-center items-center sm:grow md:grow-0">
                <p class="text-2xl flex items-center w-full px-3 text-primary">Inventory Management System</p>
            </div>
            @include('components.login-alert-message')
            <form action="{{ route('admin.login') }}" method="POST" class="w-full">
                @csrf
                <div class="flex flex-col justify-start items-center space-y-2 w-full">
                    <div class="w-full">
                        <label for="username" class="form-input-label text-base">Email</label>
                        <div class="relative">
                            <i class="fas fa-user-shield absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500 dark:text-zinc-200"></i>
                            <input type="email" name="email" id="username" class="ltr:pl-10 rtl:pr-10 form-input " placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="password" class="form-input-label text-base">Password</label>
                        <div class="relative">
                            <i class="fas fa-user-lock absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500 dark:text-zinc-200"></i>
                            <input type="password" name="password" id="password" class="ltr:pl-10 rtl:pr-10 form-input " placeholder="Enter your email">
                            <i class="fas fa-eye absolute size-4 ltr:right-3 rtl:left-3  top-3 text-slate-500 dark:text-zinc-200"></i>
                            <i class="fas fa-eye-slash hidden absolute size-4 ltr:right-3 rtl:left-3  top-3 text-slate-500 dark:text-zinc-200"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="flex items-center justify-start text-left gap-2">
                            <input id="emailCheckRememberMe" name="remember_me" class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zinc-600 dark:border-zinc-500 checked:bg-primary-500 checked:border-primary-500 dark:checked:bg-primary-500 dark:checked:border-primary-500 checked:disabled:bg-primary-400 checked:disabled:border-primary-400" type="checkbox" value="1">
                            <label for="emailCheckRememberMe" class="inline-block text-base font-medium align-middle cursor-pointer">Remember me</label>
                        </div>
                        <div id="remember-error" class="hidden mt-1 text-sm text-red-500">Please check the "Remember me" before submitting the form.</div>
                    </div>
                    <div class="w-full">
                        <button type="submit" class="btn w-full mt-6 bg-primary text-white font-medium text-lg">Log In</button>
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
