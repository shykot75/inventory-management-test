@if(session()->has('warning'))
    <div class="relative p-3 pr-12 text-sm bg-yellow-500 border border-transparent rounded-md text-yellow-50">
        <button class="absolute top-0 bottom-0 right-0 p-3 text-yellow-200 transition hover:text-yellow-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" data-lucide="x"
                 class="h-5">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </button>
        <span class="font-bold">Warning </span>{!! session()->get('warning') !!}
    </div>
@endif
