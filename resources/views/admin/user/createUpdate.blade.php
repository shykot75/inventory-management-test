@extends('admin.layouts.master')

@section('title')
    {{ !empty($user) ? 'Edit' : 'Add New' }} User | Admin
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
        <x-slot:title> {{ !empty($user) ? 'Edit' : 'Add New' }} User</x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" postion="first"> Dashboard </x-breadcrumb.item>
        <x-breadcrumb.item route="{{ route('admin.users.index') }}" position="middle">User List</x-breadcrumb.item>
        <x-breadcrumb.item position="last" type="active">{{ !empty($user) ? 'Edit' : 'Add New' }} User</x-breadcrumb.item>
    </x-breadcrumb.items>
@endsection


@section('content')
    <div class="main-body">
        <div class="card">
            <div class="card-header rounded-t-md">
                <div class="flex justify-between items-center gap-x-4">
                    <h6 class="text-lg card-title">
                        {{ !empty($user) ? 'Edit' : 'Add New' }} User
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ !empty($user)? route('admin.users.update', $user->id ): route('admin.users.store') }}" method="POST">
                    @csrf
                    @if(!empty($user)) @method('PUT') @endif
                    <div class="grid xl:grid-cols-3 gap-x-4 my-2">
                        <div>
                            <label for="name" class="form-input-label  text-base font-medium required">Name</label>
                            <input type="text" name="name" id="name" class="form-input" placeholder="Enter Name"
                                   value="{{ !empty($user) ? $user->name : old('name') }}" >
                        </div>
                        <div>
                            <label for="email" class="form-input-label  text-base font-medium required">Email</label>
                            <input type="email" name="email" id="email" class="form-input" placeholder="Enter Email"
                                   value="{{ !empty($user) ? $user->email : old('email') }}" >
                        </div>
                        <div>
                            <label for="phone" class="form-input-label  text-base font-medium required">Phone No.</label>
                            <input type="number" name="phone" id="phone" class="form-input" placeholder="Enter Phone"
                                   min="0" oninput="validity.valid||(value='');" onwheel="this.blur()"
                                   value="{{ !empty($user) ? $user->phone : old('phone') }}" >
                        </div>
                    </div>

                    <div class="grid xl:grid-cols-2 gap-x-4 my-2">
                        <div>
                            <label for="password" class="form-input-label  text-base font-medium required">Password</label>
                            <input type="password" name="password" id="password" class="form-input" placeholder="Enter Password">
                        </div>
                        <div>
                            <label for="password_confirmation" class="form-input-label  text-base font-medium required">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Re-Enter Password">
                        </div>

                    </div>

                    <div class="grid xl:grid-cols-1 gap-x-4 my-2">
                        <div class="form-input-label  text-base font-medium required">Status</div>
                        <div class="flex gap-x-6 mt-1">
                            <div class="flex items-center py-1 gap-x-4 mr-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" class="border rounded-full appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zinc-600 dark:border-zinc-500 checked:bg-primary-500 checked:border-primary-500 dark:checked:bg-primary-500 dark:checked:border-primary-500 checked:disabled:bg-primary-400 checked:disabled:border-primary-400"
                                           value="{{\App\Enums\UserEnum::STATUS_ACTIVE }}" {{ !empty($user) && $user->status ==\App\Enums\UserEnum::STATUS_ACTIVE ? 'checked' : '' }}  >
                                    <span class="ml-2 text-base">Active</span>
                                </label>
                            </div>
                            <div class="flex items-center py-1 gap-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" class="border rounded-full appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zinc-600 dark:border-zinc-500 checked:bg-primary-500 checked:border-primary-500 dark:checked:bg-primary-500 dark:checked:border-primary-500 checked:disabled:bg-primary-400 checked:disabled:border-primary-400"
                                           value="{{\App\Enums\UserEnum::STATUS_INACTIVE }}" {{ empty($user) || $user->status ==\App\Enums\UserEnum::STATUS_INACTIVE ? 'checked' : '' }}>
                                    <span class="ml-2 text-base">Inactive</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="w-full">
                        <div class="flex w-full mt-5 justify-end">
                            <div class="flex gap-3">
                                    <button class="btn text-white bg-red-500 border-red-600 hover:text-white hover:bg-red-800 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                        <i class="fa-solid fa-xmark mr-1"></i>
                                        <a href="{{ route('admin.users.index') }}" class="">
                                            Cancel
                                        </a>
                                    </button>
                                <button type="submit" class="btn text-white bg-primary-500 border-primary-600 hover:text-white hover:bg-primary-800 hover:border-primary-600 focus:text-white focus:bg-primary-600 focus:border-primary-600 focus:ring focus:ring-primary-100 active:text-white active:bg-primary-600 active:border-primary-600 active:ring active:ring-primary-100 dark:ring-primary-400/20">
                                    <i class="fa-regular fa-square-check mr-1"></i>
                                    {{ empty($user)? 'Save': 'Update' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
