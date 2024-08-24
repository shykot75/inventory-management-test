@extends('admin.layouts.master')

@section('title')
    Create New Purchase | Admin
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
        <x-slot:title>New Purchase</x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" position="first"> Dashboard </x-breadcrumb.item>
        <x-breadcrumb.item route="{{ route('admin.purchase.index') }}" position="middle"> Purchase List </x-breadcrumb.item>
        <x-breadcrumb.item position="last" type="active">Create New Purchase</x-breadcrumb.item>
    </x-breadcrumb.items>
@endsection

@section('content')
    <div class="main-body">
        <div class="card">
            <div class="card-header rounded-t-md">
                <div class="flex justify-between items-center gap-x-4">
                    <h6 class="text-lg card-title">
                        Create New Purchase
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.purchase.store') }}" method="POST">
                    @csrf
                    <div class="grid xl:grid-cols-3 gap-x-4 my-2">
                        <!-- Date -->
                        <div>
                            <label for="purchase_date" class="form-input-label text-base font-medium required">Date</label>
                            <input type="text" id="basicDataPicker" name="purchase_date" class="form-input form-date-picker"
                                   data-flatpickr
                                   value="{{ old('purchase_date') }}" required >
                        </div>
                        <!-- Date -->

                        <!-- Supplier -->
                        <div>
                            <label for="supplier_id" class="form-input-label text-base font-medium required">Supplier</label>
                            <select name="supplier_id" class="form-input form-select" id="supplier_id" required>
                                <option selected disabled>--select supplier--</option>
                                @if(!empty($suppliers))
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_id }}" {{ old('supplier_id') == $supplier->supplier_id ? 'selected' : '' }}>{{ $supplier->supplier_name }}</option>
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
                            <label for="purchase_quantity" class="form-input-label text-base font-medium required">Quantity</label>
                            <input type="number" name="purchase_quantity" id="purchase_quantity" class="form-input" placeholder="Enter Quantity" min="1" value="{{ old('purchase_quantity') }}" required>
                        </div>

                        <!-- Total Price -->
                        <div>
                            <label for="purchase_total" class="form-input-label text-base font-medium">Total Purchase Price</label>
                            <input type="text" name="purchase_total" id="purchase_total" class="form-input" placeholder="Total Price" readonly>
                        </div>

                        <!-- Payment  Type -->
                        <div>
                            <label for="payment_type" class="form-input-label text-base font-medium required">Payment Status</label>
                            <select name="payment_type" class="form-input form-select" id="payment_type" required>
                                <option selected disabled>--select payment type--</option>
                                @foreach(\App\Enums\PurchaseEnum::PAYMENT_TYPE_LABELS as $label => $value)
                                    <option value="{{ $value }}" {{ old('payment_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Payment Status -->
                        <div>
                            <label for="payment_status" class="form-input-label text-base font-medium required">Payment Status</label>
                            <select name="payment_status" class="form-input form-select" id="payment_status" required>
                                <option selected disabled>--select payment status--</option>
                                @foreach(\App\Enums\PurchaseEnum::PAYMENT_STATUS_LABELS as $label => $value)
                                    <option value="{{ $value }}" {{ old('payment_status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="w-full">
                        <button type="submit" class="btn bg-primary-500 text-white">Create Purchase</button>
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
            let quantity = document.getElementById('purchase_quantity').value;
            document.getElementById('purchase_total').value = price * quantity;
        });

        document.getElementById('purchase_quantity').addEventListener('input', function () {
            let price = document.getElementById('product_id').options[document.getElementById('product_id').selectedIndex].getAttribute('data-price');
            document.getElementById('purchase_total').value = price * this.value;
        });
    </script>
@endpush
