<?php

namespace App\Http\Controllers;

use App\Services\SalesService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Sale\SalesRequest;
use App\Http\Requests\Sale\SaleReturnRequest;

class SalesController extends Controller
{
    private SalesService $salesService;

    public function __construct()
    {
        $this->salesService = new SalesService();
    }

    public function index(): View|Factory|Application
    {
        try {
            $sales = $this->salesService->getItemList();
            return view('admin.sale.index', compact('sales'));
        }catch(\Throwable $exception){
//            abort(500);
            dd($exception->getMessage());
        }
    }

    public function create(): View|Factory|Application
    {
        try {
            $customers = $this->salesService->getCustomers();
            $products = $this->salesService->getProducts();
            return view('admin.sale.create', compact('customers', 'products'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());

        }
    }
    public function store(SalesRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->salesService->storeItem($request->validated());
            DB::commit();
            return redirect()->route('admin.sale.index')->with('success', 'Product Sold successfully');
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable->getMessage());
            return redirect()->back()->with('error', 'Sale invalid data')->withInput($request->all());
        }
    }

    public function salePDF(int $id)
    {
        try{
            $sale = $this->salesService->getItem($id);
            $pdf = Pdf::loadView('admin.sale.sale-pdf',compact('sale'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'dpi' => 120,
                    'isPhpEnabled' => true
                ]);
            $uniqueFileName = 'sale_details_' . uniqid() . '.pdf';
            return $pdf->stream($uniqueFileName);
        }catch(\Throwable $exception){
            dd($exception->getMessage());
            return redirect()->back()->with('error', 'Invalid sale details.');
        }
    }





    public function saleReturnList(): View|Factory|Application
    {
        try{
            $saleReturns = $this->salesService->getReturnItemList();
            return view('admin.sale.return-view', compact('saleReturns'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());
        }
    }

    public function saleReturnCreate(int $id): View|Factory|Application
    {
        try{
            $sale = $this->salesService->getItem($id);
            return view('admin.sale.return', compact('sale'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());
        }
    }

    public function saleReturnStore(SaleReturnRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->salesService->storeReturnItem($request->validated());
            DB::commit();
            return redirect()->route('admin.sale.return.list')->with('success', 'Product Sale returned successfully');
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable->getMessage());
            return redirect()->back()->with('error', 'Sale return invalid data')->withInput($request->all());
        }
    }

    public function saleReturnPDF(int $id)
    {
        try{
            $saleReturn = $this->salesService->getSaleReturnItem($id);
            $pdf = Pdf::loadView('admin.sale.saleReturn-pdf',compact('saleReturn'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'dpi' => 120,
                    'isPhpEnabled' => true
                ]);
            $uniqueFileName = 'sale_return_' . uniqid() . '.pdf';
            return $pdf->stream($uniqueFileName);
        }catch(\Throwable $exception){
            dd($exception->getMessage());
            return redirect()->back()->with('error', 'Invalid sale return details.');
        }
    }
}
