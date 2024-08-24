@extends('admin.layouts.master')

@section('title')
    Create Sale Return | Admin
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
        <x-slot:title>New Sale Return</x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" position="first"> Dashboard </x-breadcrumb.item>
        <x-breadcrumb.item route="" position="middle"> Sale Return List </x-breadcrumb.item>
        <x-breadcrumb.item position="last" type="active">Create Sale Return</x-breadcrumb.item>
    </x-breadcrumb.items>
@endsection

@section('content')
    <div class="main-body">
        <div class="card">
            <div class="card-header rounded-t-md">
                <div class="flex justify-between items-center gap-x-4">
                    <h6 class="text-lg card-title">
                        Create New Sale Return
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sale.return.store' ) }}" method="POST">
                    @csrf
                    <input type="hidden" name="sale_id" value="{{ $sale->sale_id }}">
                    <input type="hidden" name="product_id" value="{{ $sale->product_id }}">
                    <div class="grid xl:grid-cols-3 gap-x-4 my-2">
                        <!-- Date -->
                        <div>
                            <label for="return_date" class="form-input-label text-base font-medium required">Date</label>
                            <input type="text" id="basicDataPicker" name="return_date" class="form-input form-date-picker"
                                   data-flatpickr
                                   value="{{ old('return_date') }}" required >
                        </div>
                        <!-- Date -->

                        <!-- Product -->
                        <div>
                            <label for="product_id" class="form-input-label text-base font-medium required">Product</label>
                            <input type="text" id="product_id" class="form-input "
                                   value="{{ $sale->product->product_name }} (Tk-{{ $sale->product->product_price }}) CS:{{ $sale->product->quantity }}" readonly >
                        </div>
                        <!-- Product -->

                        <!-- Return Quantity -->
                        <div>
                            <label for="return_quantity" class="form-input-label text-base font-medium required">Return Quantity</label>
                            <input type="number" name="return_quantity" id="return_quantity" class="form-input" min="1" value="{{ $sale->sale_quantity }}" required readonly>
                        </div>
                    </div>
                    <div class="grid xl:grid-cols-3 gap-x-4 my-2">
                        <!-- Return Amount -->
                        <div>
                            <label for="return_amount" class="form-input-label text-base font-medium">Return Amount</label>
                            <input type="text" name="return_amount" id="return_amount" class="form-input" value="{{ $sale->sale_total }}" required readonly>
                        </div>

                        <!-- Payment Status -->
                        <div>
                            <label for="payment_type" class="form-input-label text-base font-medium required">Payment Type</label>
                            <select name="payment_type" class="form-input form-select" id="payment_type" required>
                                <option selected disabled>--select payment status--</option>
                                @foreach(\App\Enums\SalesReturnEnum::PAYMENT_TYPE_LABELS as $label => $value)
                                    <option value="{{ $value }}" {{ old('payment_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Payment Status -->
                        <div>
                            <label for="payment_status" class="form-input-label text-base font-medium required">Payment Status</label>
                            <select name="payment_status" class="form-input form-select" id="payment_status" required>
                                <option selected disabled>--select payment status--</option>
                                @foreach(\App\Enums\SalesReturnEnum::PAYMENT_STATUS_LABELS as $label => $value)
                                    <option value="{{ $value }}" {{ old('payment_status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid xl:grid-cols-1 gap-x-4 my-2">
                        <div>
                            <label for="return_reason" class="form-input-label  text-base font-medium">Return Reason</label>
                            <textarea name="return_reason" id="return_reason" class="form-input" rows="4"
                                      placeholder="Write a return reason">{!!  old('return_reason') !!}</textarea>
                        </div>
                    </div>

                    <div class="w-full">
                        <button type="submit" class="btn bg-primary-500 text-white">Create Sale Return</button>
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
        document.getElementById('sale_id').addEventListener('change', function () {
            let price = parseFloat(this.options[this.selectedIndex].getAttribute('data-price'));
            let saleQuantity = parseInt(this.options[this.selectedIndex].getAttribute('data-quantity'));
            let returnQuantity = document.getElementById('return_quantity').value;

            if(returnQuantity) {
                let returnAmount = (returnQuantity / saleQuantity) * price * saleQuantity;
                document.getElementById('return_amount').value = returnAmount.toFixed(2);
            }
        });

        document.getElementById('return_quantity').addEventListener('input', function () {
            let price = parseFloat(document.getElementById('sale_id').options[document.getElementById('sale_id').selectedIndex].getAttribute('data-price'));
            let saleQuantity = parseInt(document.getElementById('sale_id').options[document.getElementById('sale_id').selectedIndex].getAttribute('data-quantity'));
            let returnAmount = (this.value / saleQuantity) * price * saleQuantity;
            document.getElementById('return_amount').value = returnAmount.toFixed(2);
        });
    </script>
@endpush
