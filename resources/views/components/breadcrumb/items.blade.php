<!-- Breadcrumb -->
@if(!empty($slot))
    <div class="w-full mb-4 flex justify-between items-center flex-col lg:flex-row rounded-lg px-4 py-2 gap-x-4 bg-light text-light dark:bg-dark dark:text-dark drop-shadow-lg shadow-slate-200 dark:shadow-slate-900">
        <div class="pl-2 pr-4 flex items-center">
            <div class="text-left text-lg text-primary-600 pr-4 font-bold">
                {{ $title }} |
            </div>
            <div class="px-4 py-2 breadcrumb flex flex-row space-x-3">
                {{ $slot }}
            </div>
        </div>
        @if(!empty($actions))
            <div>
                {{ $actions }}
            </div>
        @endif
    </div>
@endif

