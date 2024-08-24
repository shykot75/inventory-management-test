@extends('admin.layouts.master')

@section('title')
    Create New Sale | Admin
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }

    </style>
@endpush

@section('breadcrumbs')
    <x-breadcrumb.items>
        <x-slot:title>New Sale</x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" position="first"> Dashboard </x-breadcrumb.item>
        <x-breadcrumb.item route="{{ route('admin.sale.index') }}" position="middle"> Sale List </x-breadcrumb.item>
        <x-breadcrumb.item position="last" type="active">Create New Sale</x-breadcrumb.item>
    </x-breadcrumb.items>
@endsection

@section('content')
    <div class="main-body">
        <div class="card">
            <div class="card-header rounded-t-md">
                <div class="flex justify-between items-center gap-x-4">
                    <h6 class="text-lg card-title">
                        Create New Sale
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sale.store') }}" method="POST">
                    @csrf
                    <div class="grid xl:grid-cols-3 gap-x-4 my-2">
                        <!-- Date -->
                        <div>
                            <label for="sale_date" class="form-input-label text-base font-medium required">Date</label>
                            <input type="text" id="basicDataPicker" name="sale_date" class="form-input form-date-picker"
                                   data-flatpickr
                                   value="{{ old('sale_date') }}" required >
                        </div>
                        <!-- Date -->

                        <!-- Supplier -->
                        <div>
                            <label for="customer_id" class="form-input-label text-base font-medium required">Customer</label>
                            <select name="customer_id" class="form-input form-select" id="customer_id" required>
                                <option selected disabled>--select customer--</option>
                                @if(!empty($customers))
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->customer_id }}" {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }}>{{ $customer->customer_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Product -->
                        <div>
                            <label for="product_id" class="form-input-label text-base font-medium required">Product</label>
                            <select name="product_id" class="form-input form-select" id="product_id" required>
                                <option selected disabled>--select product--</option>
                                @if(!empty($products))
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}" data-price="{{ $product->product_price }}" {{ old('product_id') == $product->product_id ? 'selected' : '' }}>{{ $product->product_name }} (Tk-{{ $product->product_price }}) Q:{{ $product->quantity }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="grid xl:grid-cols-4 gap-x-4 my-2">
                        <!-- Quantity -->
                        <div>
                            <label for="sale_quantity" class="form-input-label text-base font-medium required">Quantity</label>
                            <input type="number" name="sale_quantity" id="sale_quantity" class="form-input" placeholder="Enter Quantity" min="1" value="{{ old('sale_quantity') }}" required>
                        </div>

                        <!-- Total Price -->
                        <div>
                            <label for="sale_total" class="form-input-label text-base font-medium">Total Sale Price</label>
                            <input type="text" name="sale_total" id="sale_total" class="form-input" placeholder="Total Price" readonly>
                        </div>

                        <!-- Payment  Type -->
                        <div>
                            <label for="payment_type" class="form-input-label text-base font-medium required">Payment Status</label>
                            <select name="payment_type" class="form-input form-select" id="payment_type" required>
                                <option selected disabled>--select payment type--</option>
                                @foreach(\App\Enums\SalesEnum::PAYMENT_TYPE_LABELS as $label => $value)
                                    <option value="{{ $value }}" {{ old('payment_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Payment Status -->
                        <div>
                            <label for="payment_status" class="form-input-label text-base font-medium required">Payment Status</label>
                            <select name="payment_status" class="form-input form-select" id="payment_status" required>
                                <option selected disabled>--select payment status--</option>
                                @foreach(\App\Enums\SalesEnum::PAYMENT_STATUS_LABELS as $label => $value)
                                    <option value="{{ $value }}" {{ old('payment_status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="w-full">
                        <button type="submit" class="btn bg-primary-500 text-white">Create Sale</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script type="module" src="{{ asset('assets/libs/flatpickr/flatpickr.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/date-time-picker.js') }}"></script>
    <script>
        document.getElementById('product_id').addEventListener('change', function () {
            let price = this.options[this.selectedIndex].getAttribute('data-price');
            let quantity = document.getElementById('sale_quantity').value;
            document.getElementById('sale_total').value = price * quantity;
        });

        document.getElementById('sale_quantity').addEventListener('input', function () {
            let price = document.getElementById('product_id').options[document.getElementById('product_id').selectedIndex].getAttribute('data-price');
            document.getElementById('sale_total').value = price * this.value;
        });
    </script>
@endpush
