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

            @can('isAdmin')
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

            <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fa-solid fa-cart-shopping text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">Product</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="{{ route('admin.product.index') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Product List</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{ route('admin.product.create') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Add Product</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fa-solid fa-cart-shopping text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">Purchase</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="{{ route('admin.purchase.index') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Purchase List</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{ route('admin.purchase.create') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Create Purchase</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="relative menu-item">
                <a href="{{route('admin.purchase.return.list')}}" class="parent-item flex items-center w-full px-3 py-3">
                    <i class="fa-solid fa-cart-shopping text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium">Purchase Return</span>
                </a>
            </li>

            <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fa-solid fa-cart-shopping text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">Sale</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="{{ route('admin.sale.index') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Sale List</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{ route('admin.sale.create') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Create Sale</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="relative menu-item">
                <a href="{{route('admin.sale.return.list')}}" class="parent-item flex items-center w-full px-3 py-3">
                    <i class="fa-solid fa-cart-shopping text-sm"></i>
                    <span class="menu-title ml-4 text-sm font-medium">Sales Return</span>
                </a>
            </li>
            @endcan

            <li class="relative menu-item">
                <div class="parent-item flex items-center flex-row w-full px-3 py-3 cursor-pointer">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="menu-title ml-4 text-sm font-medium grow">Reports</span>
                    <i class="fa-solid fa-angle-down arrow-icon"></i>
                </div>
                <ul class="dropdown-menu bg-white text-light dark:bg-dark dark:text-dark ml-2">
                    <li class="dropdown-item">
                        <a href="{{ route('admin.report.purchase') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Purchase</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{route('admin.report.purchase.return')}}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Purchase Return</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{ route('admin.report.sale') }}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Sales</span>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="{{route('admin.report.sale.return')}}" class="flex items-center flex-row w-full px-3 py-2.5 ">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span class="ml-4 text-sm font-medium">Sales Return</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</aside>
