@extends('admin.layouts.master')

@section('title')
     User Lists | Admin
@endsection

@section('breadcrumbs')
    <x-breadcrumb.items>
        <x-slot:title>User Lists</x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" postion="first"> Dashboard </x-breadcrumb.item>
        <x-breadcrumb.item route="{{ route('admin.users.create') }}" position="middle">Add New User</x-breadcrumb.item>
        <x-breadcrumb.item position="last" type="active">User Lists</x-breadcrumb.item>
    </x-breadcrumb.items>
@endsection

@section('content')
    <div class="main-body">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15">User Lists</h6>
                <table id="borderedTable" class="bordered group" style="width:100%">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $item)
                        <tr class="text-sm text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name ?? '--' }}</td>
                            <td class="gap-2">
                                {{ $item->email ?? '--' }}
                            </td>

                            <td>
                                {{ $item->phone ?? '--' }}
                            </td><td>
                                {{ $item->role ?? '--' }}
                            </td>
                            <td>
                                <div class="{{ $item->status == \App\Enums\UserEnum::STATUS_ACTIVE ?'badge-active': 'badge-inactive' }}  px-2.5 py-0.5 inline-block">
                                    {{ $item->status == \App\Enums\UserEnum::STATUS_ACTIVE ? 'Active' : 'Inactive'}}
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
                                                       href="">Edit</a>

                                                    <button class="block px-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200">
                                                        Delete
                                                    </button>
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


    <!-- Modal -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
         id="deleteModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-3 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                        Delete Item
                    </h5>
                    <button type="button" class="text-red-600 text-2xl btn-close box-content  p-1 border-none rounded-none focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            data-bs-dismiss="modal" aria-label="Close"><i class='bx bxs-x-circle text-red-600'></i></button>
                </div>
                <form id="deleteTemplateForm" action="" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body relative p-4">
                        <div class="bg-yellow-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full" role="alert">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor" d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"></path>
                            </svg>
                            Are you sure want to delete this item?
                        </div>
                    </div>
                    <div
                        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button"
                                class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                                data-bs-dismiss="modal">Close</button>
                        <button type="submit"
                                class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                        >Delete</button>
                    </div>
                </form>
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

@endpush
