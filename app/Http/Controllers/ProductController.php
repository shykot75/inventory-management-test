<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Services\ProductService;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private ProductService $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index(Request $request): View|Factory|Application
    {
        try {
            $categories = $this->productService->getCategories();
            $products = $this->productService->getItemList($request->all());
            return view('admin.product.index', compact('products', 'categories'));
        }catch(\Throwable $exception){
//            abort(500);
            dd($exception->getMessage());
        }
    }
    public function create(): View|Factory|Application
    {
        try {
            $categories = $this->productService->getCategories();
            return view('admin.product.createUpdate', compact('categories'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());

        }
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->productService->storeItem($request->validated());
            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable->getMessage());
            return redirect()->back()->with('error', 'Product invalid data')->withInput($request->all());
        }
    }

    public function edit(int $id): View|Factory|Application
    {
        try {
            $product = $this->productService->getItem($id);
            $categories = $this->productService->getCategories();
            return view('admin.product.createUpdate', compact('product', 'categories'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());
        }
    }

    public function update(ProductRequest $request, int $productId): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->productService->updateItem($request->validated(), $productId);
            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Product Updated Successfully');
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable->getMessage());
            return redirect()->back()->with('error', 'Product invalid data')->withInput($request->all());
        }
    }

    public function destroy(int $productId): RedirectResponse
    {
        try {
            $this->productService->deleteItem($productId);
            return redirect()->route('admin.product.index')->with('success', 'Product Deleted Successfully');
        }catch (\Throwable $throwable){
            return redirect()->route('admin.product.index')->with('erroe', 'Product invalid data');
        }
    }



}
