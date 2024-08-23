@extends('admin.layouts.master')

@section('title')
    {{ !empty($product) ? 'Edit' : 'Add New' }} Product | Admin
@endsection

@push('after-styles')
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
        <x-slot:title> {{ !empty($product) ? 'Edit' : 'Add New' }} Product</x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" postion="first"> Dashboard </x-breadcrumb.item>
        <x-breadcrumb.item route="{{ route('admin.product.index') }}" position="middle">Product List</x-breadcrumb.item>
        <x-breadcrumb.item position="last" type="active">{{ !empty($product) ? 'Edit' : 'Add New' }} Product</x-breadcrumb.item>
    </x-breadcrumb.items>
@endsection


@section('content')
    <div class="main-body">
        <div class="card">
            <div class="card-header rounded-t-md">
                <div class="flex justify-between items-center gap-x-4">
                    <h6 class="text-lg card-title">
                        {{ !empty($product) ? 'Edit' : 'Add New' }} Product
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ !empty($product)? route('admin.product.update', $product->product_id ): route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($product)) @method('PUT') @endif
                    <div class="grid xl:grid-cols-3 gap-x-4 my-2">
                        <div>
                            <label for="product_name" class="form-input-label  text-base font-medium required">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-input" placeholder="Enter Product Name"
                                   value="{{ !empty($product) ? $product->product_name : old('product_name') }}" >
                        </div>
                        <div>
                            <label for="sku" class="form-input-label  text-base font-medium required">SKU</label>
                            <input type="text" name="sku" id="sku" class="form-input" placeholder="#0001"
                                   value="{{ !empty($product) ? $product->sku : old('sku') }}" >
                        </div>
                        <div>
                            <label for="category_id" class="form-input-label  text-base font-medium required">Category</label>
                            <select name="category_id" class="form-input form-select" id="category_id">
                                <option selected disabled>--select category--</option>
                                @if(!empty($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                            {{ !empty($product) && $product->category_id == $category->category_id ? 'selected' : '' }}
                                            {{old('category_id') == $category->category_id ? 'selected' : '' }}
                                        >{{ $category->category_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="grid xl:grid-cols-3 gap-x-4 my-2">
                        <div>
                            <label for="product_price" class="form-input-label text-base font-medium required">Price</label>
                            <input type="number" name="product_price" id="product_price" class="form-input" placeholder="Enter Price"
                                   min="1" oninput="validity.valid||(value='');" onwheel="this.blur()"
                                   value="{{ !empty($product) ? $product->product_price : old('product_price') }}">
                        </div>
                        <div>
                            <label for="quantity" class="form-input-label text-base font-medium required">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-input" placeholder="Enter Quantity"
                                   min="1" oninput="validity.valid||(value='');" onwheel="this.blur()"
                                   value="{{ !empty($product) ? $product->quantity : old('quantity') }}">
                        </div>
                        <div>
                            <label class="form-input-label text-base font-medium required">Status</label>
                            <div class="flex gap-x-2 mt-1">
                                <div class="flex items-center py-1 gap-x-4 mr-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" class="border rounded-full appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zinc-600 dark:border-zinc-500 checked:bg-primary-500 checked:border-primary-500 dark:checked:bg-primary-500 dark:checked:border-primary-500 checked:disabled:bg-primary-400 checked:disabled:border-primary-400"
                                               value="{{\App\Enums\ProductEnum::STATUS_ACTIVE }}" {{ !empty($product) && $product->status == \App\Enums\ProductEnum::STATUS_ACTIVE ? 'checked' : '' }}>
                                        <span class="ml-2 text-base">Active</span>
                                    </label>
                                </div>
                                <div class="flex items-center py-1 gap-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" class="border rounded-full appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zinc-600 dark:border-zinc-500 checked:bg-primary-500 checked:border-primary-500 dark:checked:bg-primary-500 dark:checked:border-primary-500 checked:disabled:bg-primary-400 checked:disabled:border-primary-400"
                                               value="{{\App\Enums\ProductEnum::STATUS_INACTIVE }}" {{ empty($product) || $product->status == \App\Enums\ProductEnum::STATUS_INACTIVE ? 'checked' : '' }}>
                                        <span class="ml-2 text-base">Inactive</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="grid xl:grid-cols-2 gap-x-4 my-2">
                        <div>
                            <label for="product_image" class="form-input-label  text-base font-medium">Product Image</label>
                            <div class="w-full">
                                <div class="file-input-container relative flex gap-2 items-center justify-between border border-slate-300 dark:border-slate-600 rounded-lg shadow-md p-4">
                                    <div class="flex flex-col">
                                        <label for="fileInput1" class="file-label relative z-10 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-500 border border-transparent rounded-md cursor-pointer hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 shadow-sm shadow-primary-200 drop-shadow-md hover:shadow-md dark:shadow-zinc-700">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm8-3v7c0 1.105-.895 2-2 2H4c-1.105 0-2-.895-2-2V9h2v7h12V9h2zm-2-3H4V4c0-1.105.895-2 2-2h4v3h4V2h2c1.105 0 2 .895 2 2v2z"/></svg>
                                            <span>Choose File</span>
                                        </label>
                                        <span class="ml-4 mt-1 text-gray-500 file-name text-wrap dark:text-dark">No file chosen</span>
                                    </div>
                                    <div class="image-preview w-20 min-h-20 border border-dashed">
                                        <img src="{{ !empty($product) ? asset('storage/' . $product->product_image) : '' }}" alt="Image Preview" class="rounded-md shadow-md">
                                    </div>
                                    <input type="file" name="product_image" id="fileInput1" class="hidden form-file-input" accept="image/*"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="product_name" class="form-input-label  text-base font-medium required">Product Description</label>
                            <textarea name="product_description" id="product_description" class="form-input" rows="4"
                                      placeholder="Write Product Description">{!! !empty($product) ? $product->product_description : old('product_description') !!}</textarea>
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="flex w-full mt-5 justify-end">
                            <div class="flex gap-3">
                                    <button class="btn text-white bg-red-500 border-red-600 hover:text-white hover:bg-red-800 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                        <i class="fa-solid fa-xmark mr-1"></i>
                                        <a href="{{ route('admin.product.index') }}" class="">
                                            Cancel
                                        </a>
                                    </button>
                                <button type="submit" class="btn text-white bg-primary-500 border-primary-600 hover:text-white hover:bg-primary-800 hover:border-primary-600 focus:text-white focus:bg-primary-600 focus:border-primary-600 focus:ring focus:ring-primary-100 active:text-white active:bg-primary-600 active:border-primary-600 active:ring active:ring-primary-100 dark:ring-primary-400/20">
                                    <i class="fa-regular fa-square-check mr-1"></i>
                                    {{ empty($product)? 'Save': 'Update' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
