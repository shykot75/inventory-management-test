<?php

namespace App\Http\Controllers;

use App\Services\PurchaseService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Purchase\PurchaseRequest;
use App\Http\Requests\Purchase\PurchaseReturnRequest;

class PurchaseController extends Controller
{
    private PurchaseService $purchaseService;

    public function __construct()
    {
        $this->purchaseService = new PurchaseService();
    }

    public function index(): View|Factory|Application
    {
        try {
            $purchases = $this->purchaseService->getItemList();
            return view('admin.purchase.index', compact('purchases'));
        }catch(\Throwable $exception){
//            abort(500);
            dd($exception->getMessage());
        }
    }

    public function create(): View|Factory|Application
    {
        try {
            $suppliers = $this->purchaseService->getSuppliers();
            $products = $this->purchaseService->getProducts();
            return view('admin.purchase.create', compact('suppliers', 'products'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());

        }
    }
    public function store(PurchaseRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->purchaseService->storeItem($request->validated());
            DB::commit();
            return redirect()->route('admin.purchase.index')->with('success', 'Product Purchased successfully');
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable->getMessage());
            return redirect()->back()->with('error', 'Purchase invalid data')->withInput($request->all());
        }
    }

    public function purchasePDF(int $id)
    {
        try{
            $purchase = $this->purchaseService->getItem($id);
            $pdf = Pdf::loadView('admin.purchase.purchase-pdf',compact('purchase'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'dpi' => 120,
                    'isPhpEnabled' => true
                ]);
            $uniqueFileName = 'purchase_details_' . uniqid() . '.pdf';
            return $pdf->stream($uniqueFileName);
        }catch(\Throwable $exception){
            dd($exception->getMessage());
            return redirect()->back()->with('error', 'Invalid purchase details.');
        }
    }





    public function purchaseReturnList(): View|Factory|Application
    {
        try{
            $purchaseReturns = $this->purchaseService->getReturnItemList();
            return view('admin.purchase.return-view', compact('purchaseReturns'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());
        }
    }

    public function purchaseReturnCreate(int $id): View|Factory|Application
    {
        try{
            $purchase = $this->purchaseService->getItem($id);
            return view('admin.purchase.return', compact('purchase'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());
        }
    }

    public function purchaseReturnStore(PurchaseReturnRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->purchaseService->storeReturnItem($request->validated());
            DB::commit();
            return redirect()->route('admin.purchase.return.list')->with('success', 'Product Purchased successfully');
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable->getMessage());
            return redirect()->back()->with('error', 'Purchase return invalid data')->withInput($request->all());
        }
    }

    public function purchaseReturnPDF(int $id)
    {
        try{
            $purchaseReturn = $this->purchaseService->getPurchaseReturnItem($id);
            $pdf = Pdf::loadView('admin.purchase.purchaseReturn-pdf',compact('purchaseReturn'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'dpi' => 120,
                    'isPhpEnabled' => true
                ]);
            $uniqueFileName = 'purchase_return_' . uniqid() . '.pdf';
            return $pdf->stream($uniqueFileName);
        }catch(\Throwable $exception){
            dd($exception->getMessage());
            return redirect()->back()->with('error', 'Invalid purchase return details.');
        }
    }
}
