@if(session()->has('success'))
    <div class="relative p-3 pr-12 text-sm bg-green-500 border border-transparent rounded-md text-green-50">
        <button class="absolute top-0 bottom-0 right-0 p-3 text-green-200 transition hover:text-green-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" data-lucide="x"
                 class="h-5">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </button>
        <span class="font-bold">Success</span> {!! session()->get('success') !!}
    </div>
@endif
