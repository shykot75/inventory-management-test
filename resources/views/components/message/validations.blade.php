@if($errors->any())
    <div class="flex gap-3 p-4 text-sm text-orange-500 rounded-md bg-yellow-50 dark:bg-yellow-400/20">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
             stroke-linejoin="round" data-lucide="alert-triangle"
             class="inline-block size-4 mt-0.5 shrink-0">
            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
            <path d="M12 9v4"></path>
            <path d="M12 17h.01"></path>
        </svg>
        <div>
            <h6 class="mb-1">Uh oh, something went wrong!</h6>
            <ul class="ml-2 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
