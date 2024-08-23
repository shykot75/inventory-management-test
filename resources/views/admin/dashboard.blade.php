@extends('admin.layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@section('breadcrumbs')
    <x-breadcrumb.items>
        <x-slot:title>
            Dashboard
        </x-slot:title>
        <x-breadcrumb.item route="{{ route('admin.dashboard') }}" postion="first"> Dashboard </x-breadcrumb.item>
{{--        <x-breadcrumb.item position="last" type="active">Event List</x-breadcrumb.item>--}}

    </x-breadcrumb.items>
@endsection

@section('content')
    <div class="main-body">

        <div class="card">
            <div class="card-header rounded-t-md">
                <div class="flex justify-between items-center gap-x-4">
                    <h6 class="text-lg card-title">
                        Admin Dashboard
                    </h6>
{{--                    <div class="card-header-options">--}}
{{--                        <button type="button"--}}
{{--                                class="text-white btn bg-secondary-500 border-secondary-600 hover:text-white hover:bg-secondary-800 hover:border-secondary-600 focus:text-white focus:bg-secondary-600 focus:border-secondary-600 focus:ring focus:ring-secondary-100 active:text-white active:bg-secondary-600 active:border-secondary-600 active:ring active:ring-secondary-100 dark:ring-secondary-400/20">--}}
{{--                            Custom--}}
{{--                        </button>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="card-body">
                <p class="text-slate-500 dark:text-zink-200 text-center text-2xl py-6">
                    Welcome to Inventory Management System
                </p>
            </div>
        </div>
    </div>
@endsection
