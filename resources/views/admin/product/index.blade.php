@extends('admin.layouts.master')

@section('title')
     Product Lists | Admin
@endsection

@section('breadcrumbs')
    <x-breadcrumb.items>
        <x-slot:title>Product Lists</x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" postion="first"> Dashboard </x-breadcrumb.item>
        <x-breadcrumb.item route="{{ route('admin.product.create') }}" position="middle">Add New Product</x-breadcrumb.item>
        <x-breadcrumb.item position="last" type="active">Product Lists</x-breadcrumb.item>
    </x-breadcrumb.items>
@endsection

@section('content')
    <div class="main-body">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15">Product Filter</h6>
                <form action="{{ route('admin.product.index') }}" method="GET">
                    <div class="grid xl:grid-cols-3 gap-x-4 my-2">
                        <div>
                            <label for="category_id" class="form-input-label  text-base font-medium">Category</label>
                            <select name="category_id" class="form-input form-select" id="category_id">
                                <option selected disabled>--select category--</option>
                                @if(!empty($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                            {{ !empty($_GET['category_id']) && $_GET['category_id'] == $category->category_id ? 'selected' : '' }}
                                        >{{ $category->category_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- Price Filter -->
                        <div>
                            <label for="product_price" class="form-input-label text-base font-medium">Sort by Price</label>
                            <select name="product_price" class="form-input form-select" id="product_price">
                                <option selected disabled>--sort by price--</option>
                                <option value="ASC" {{ request('product_price') == 'ASC' ? 'selected' : '' }}>Low to High</option>
                                <option value="DESC" {{ request('product_price') == 'DESC' ? 'selected' : '' }}>High to Low</option>
                            </select>
                        </div>

                        <!-- Quantity Filter -->
                        <div>
                            <label for="quantity_order" class="form-input-label text-base font-medium">Sort by Quantity</label>
                            <select name="quantity_order" class="form-input form-select" id="quantity_order">
                                <option selected disabled>--sort by quantity--</option>
                                <option value="ASC" {{ request('quantity_order') == 'ASC' ? 'selected' : '' }}>Low to High</option>
                                <option value="DESC" {{ request('quantity_order') == 'DESC' ? 'selected' : '' }}>High to Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                    <div class="flex w-full mt-5 justify-start">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.product.index') }}" class="btn text-white bg-red-500 border-red-600 hover:text-white hover:bg-red-800 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                <i class="fa-solid fa-refresh mr-1"></i>
                                    Reset
                            </a>
                            <button type="submit" class="btn text-white cursor-pointer bg-primary-500 border-primary-600 hover:text-white hover:bg-primary-800 hover:border-primary-600 focus:text-white focus:bg-primary-600 focus:border-primary-600 focus:ring focus:ring-primary-100 active:text-white active:bg-primary-600 active:border-primary-600 active:ring active:ring-primary-100 dark:ring-primary-400/20">
                                <i class="fa-solid fa-magnifying-glass mr-1"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="card-body">
                <h6 class="mb-4 text-15">Product Lists</h6>
                <table id="borderedTable" class="bordered group" style="width:100%">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $item)
                        <tr class="text-sm text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->product_image) }}" alt="product-image" class="w-12 h-12 items-center">
                            </td>
                            <td>{{ $item->category->category_name ?? '--' }}</td>
                            <td>{{ $item->product_name ?? '--' }}</td>
                            <td class="gap-2">
                                {{ $item->product_price ?? '--' }} Tk
                            </td>

                            <td>
                                {{ $item->quantity ?? '--' }}
                            </td>
                            <td>
                                <div class="{{ $item->status == \App\Enums\ProductEnum::STATUS_ACTIVE ?'badge-active': 'badge-inactive' }}  px-2.5 py-0.5 inline-block">
                                    {{ $item->status == \App\Enums\ProductEnum::STATUS_ACTIVE ? 'Active' : 'Inactive'}}
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    <div>
                                        <div class="dropdown relative">
                                            <button type="button"
                                                    class="text-white dropdown-toggle btn bg-primary-500 border-primary-500 hover:text-white hover:bg-primary-600 hover:border-primary-600 focus:text-white focus:bg-primary-600 focus:border-primary-600 focus:ring focus:ring-primary-100 active:text-white active:bg-primary-600 active:border-primary-600 active:ring active:ring-primary-100 dark:ring-primary-400/20"
                                                    id="dropdownMenuheading">
                                                <i class="fas fa-ellipsis-v"></i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round" data-lucide="chevron-down"
                                                     class="inline-block size-4 ltr:ml-1 rlt:mr-1">
                                                    <path d="m6 9 6 6 6-6"></path>
                                                </svg>
                                            </button>
                                            <ul class="absolute z-50 py-2 mt-1 list-none bg-white rounded-md shadow-md ltr:text-left rtl:text-right dropdown-toggle-menu min-w-max dark:bg-zinc-600"
                                                data-show="false" aria-labelledby="dropdownMenuheading">

                                                <li>
                                                    <a class="block px-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"
                                                       href="{{ route('admin.product.edit', $item->product_id) }}">
                                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit</a>

                                                    <a
                                                        href="#"
                                                        class="delete_item block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-slate-600 w-full"
                                                        type="button"
                                                        id="delete"
                                                        onclick="confirmDelete({{ $item->product_id }});"
                                                    >
                                                        <i class="fa-solid fa-trash-can mr-1"></i> Delete
                                                    </a>

                                                    <form id="delete-form-{{ $item->product_id }}" action="{{ route('admin.product.delete', $item->product_id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@push('after-scripts')
    <!--dataTables-->
    <script type="module" src="{{ asset('assets/libs/datatables/jquery-3.7.0.js') }}"></script>
    <script type="module" src="{{ asset('assets/libs/datatables/data-tables.min.js') }}"></script>
    <script type="module" src="{{ asset('assets/libs/datatables/data-tables.tailwindcss.min.js') }}"></script>

    <script type="module" src="{{ asset('assets/js/datatable-util.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/datatables.js') }}"></script>
    <script>
        function confirmDelete(productId) {
            if (confirm("Are you sure you want to delete this item?")) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }
    </script>
@endpush
