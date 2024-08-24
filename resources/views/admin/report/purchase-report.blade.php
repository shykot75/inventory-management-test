@extends('admin.layouts.master')

@section('title')
     Purchase Lists | Admin
@endsection

@section('breadcrumbs')
    <x-breadcrumb.items>
        <x-slot:title>Purchase Lists</x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" postion="first"> Dashboard </x-breadcrumb.item>
        <x-breadcrumb.item route="{{ route('admin.purchase.create') }}" position="middle">Add New Purchase</x-breadcrumb.item>
        <x-breadcrumb.item position="last" type="active">Purchase Lists</x-breadcrumb.item>
    </x-breadcrumb.items>
@endsection

@section('content')
    <div class="main-body">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15">Purchase Lists</h6>
                <table id="withExportBtnDatatable" class="bordered group" style="width:100%">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Supplier</th>
                        <th>Purchase Qty.</th>
                        <th>Grand Total</th>
                        <th>Payment Status</th>
                        <th>Is Returned?</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchases as $item)
                        <tr class="text-sm text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->purchase_date ?? '--' }}</td>
                            <td>
                                {{ $item->product->product_name ?? '--' }} <br>
                                <small>Price: {{ $item->product->product_price ?? '--' }} Tk</small>
                                <small>CS: {{ $item->product->quantity ?? '--' }}</small>
                            </td>
                            <td>{{ $item->supplier->supplier_name ?? '--' }} </td>
                            <td>{{ $item->purchase_quantity ?? '--' }} </td>
                            <td>{{ $item->purchase_total ?? '--' }} Tk</td>
                            <td>
                                <div class="{{ $item->payment_status == \App\Enums\PurchaseEnum::PAYMENT_STATUS_PAID ?'badge-active': 'badge-inactive' }}  px-2.5 py-0.5 inline-block">
                                    {{ $item->payment_status == \App\Enums\PurchaseEnum::PAYMENT_STATUS_PAID ? 'Paid' : 'Not Paid'}}
                                </div>
                            </td>
                            <td>
                                <div class="{{ $item->is_returned == 1 ?'badge-block': 'badge-pending' }}  px-2.5 py-0.5 inline-block">
                                    {{ $item->is_returned == 1 ? 'YES' : 'NO'}}
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
                                            <ul class="absolute z-50 py-2 mt-1 list-none bg-white rounded-md shadow-md ltr:text-left rtl:text-right dropdown-toggle-menu min-w-max dark:bg-zinc-600 mr-4"
                                                data-show="false" aria-labelledby="dropdownMenuheading">
                                                <li>
                                                    <a class="block px-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zinc-100 dark:hover:bg-zinc-500 dark:hover:text-zinc-200 dark:focus:bg-zinc-500 dark:focus:text-zinc-200"
                                                       href="{{ route('admin.report.purchase.pdf', $item->purchase_id) }}">
                                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Save PDF</a>

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
    <script src="{{ asset('assets/libs/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <!--buttons dataTables-->
    <script src="{{ asset('assets/libs/datatables/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.print.min.js') }}"></script>

{{--    <script src="{{ asset('assets/js/datatable-util.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/datatables.js') }}"></script>--}}

    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#withExportBtnDatatable')) {
                $('#withExportBtnDatatable').DataTable({
                    dom: "<'grid grid-cols-12 lg:grid-cols-12 gap-3'" +
                        "<'self-center col-span-12'B>" +
                        "<'self-center col-span-12 lg:col-span-6'l>" +
                        "<'self-center col-span-12 lg:col-span-6 lg:place-self-end'f>" +
                        "<'my-2 col-span-12 lg:col-span-12'tr>" +
                        "<'self-center col-span-12 lg:col-span-6'i>" +
                        "<'self-center col-span-12 lg:place-self-end lg:col-span-6'p>" +
                        ">",
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            className: 'bg-primary-500 text-white hover:bg-primary-600 border-primary-500',
                            text: 'Excel'
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'bg-primary-500 text-white hover:bg-primary-600 border-primary-500',
                            text: 'PDF',
                            customize: function (doc) {
                                // Do not set any custom font, rely on default
                                doc.defaultStyle = {
                                    fontSize: 12 // Optional: set a default font size
                                };
                            }
                        }
                    ],
                    drawCallback: function(settings) {
                        if (typeof window.setupActionMenu === 'function') {
                            window.setupActionMenu();
                        } else {
                            console.error('setupActionMenu is not defined');
                        }
                    }
                });
            }
        });
    </script>



@endpush
