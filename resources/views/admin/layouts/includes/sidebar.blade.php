<aside id="sidebar" class="sidebar border-r dark:border-gray-800 dark:shadow-lg bg-light text-light dark:bg-dark dark:text-dark">
    <!-- Component Start -->
    <div class="app-menu flex flex-col w-full h-full">
        <ul class="space-y-2 w-full px-2 mt-2">
            <li class="relative menu-item">
                <a href="index.html" class="parent-item active flex items-center w-full px-3 py-3">
                    <i class="fa-solid fa-house text-sm "></i>
                    <span class="menu-title ml-4 text-sm font-medium">Dashboard</span>
                </a>
            </li>
           {{-- <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fab fa-elementor text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">Elements</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="./elements/generic.html" class="flex items-center flex-row w-full px-3 py-2.5">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Generic</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./elements/alerts.html" class="flex items-center flex-row w-full px-3 py-2.5">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Alert</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./elements/timeline.html" class="flex items-center flex-row w-full px-3 py-2.5">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Timeline</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./elements/modal.html" class="flex items-center flex-row w-full px-3 py-2.5">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Modal</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fab fa-elementor text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">Navigation</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="./navigation/tabs.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Tabs</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fa-solid fa-file-lines text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">Forms</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="./forms/basic.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Basic</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./forms/input-mask.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Input Mask</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./forms/select.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Select</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./forms/date-time-picker.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Date & Time Picker</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./forms/file-uploader.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">File Uploader</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fas fa-table text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">Tables</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="./tables/basic-tables.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Basic Table</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./tables/data-tables.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Datatable</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="./tables/gridjs-tables.html" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">GridJs Table</span>
                        </a>
                    </li>
                </ul>
            </li>--}}
            <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fas fa-user-shield text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">User Management</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">User List</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{ route('admin.users.create') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Add User</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</aside>
