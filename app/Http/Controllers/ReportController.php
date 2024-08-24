<?php

namespace App\Http\Controllers;

use App\Services\PurchaseService;
use App\Services\SalesService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private SalesService $salesService;
    private PurchaseService $purchaseService;
    public function __construct()
    {
        $this->salesService = new SalesService();
        $this->purchaseService = new purchaseService();
    }

    public function purchaseReport(): View|Factory|Application
    {
        try {
            $purchases = $this->purchaseService->getItemList();
            return view('admin.report.purchase-report', compact('purchases'));
        }catch(\Throwable $exception){
//            abort(500);
            dd($exception->getMessage());
        }
    }

    public function purchaseReportPDF(int $id)
    {
        try{
            $purchase = $this->purchaseService->getItem($id);
            $pdf = Pdf::loadView('admin.report.purchase-pdf',compact('purchase'))
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

    public function purchaseReportReturnList(): View|Factory|Application
    {
        try{
            $purchaseReturns = $this->purchaseService->getReturnItemList();
            return view('admin.report.purchase-return-view', compact('purchaseReturns'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());
        }
    }

    public function purchaseReportReturnPDF(int $id)
    {
        try{
            $purchaseReturn = $this->purchaseService->getPurchaseReturnItem($id);
            $pdf = Pdf::loadView('admin.report.purchaseReturn-pdf',compact('purchaseReturn'))
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

    public function salesReport(): View|Factory|Application
    {
        try {
            $sales = $this->salesService->getItemList();
            return view('admin.report.sale-report', compact('sales'));
        }catch(\Throwable $exception){
//            abort(500);
            dd($exception->getMessage());
        }
    }

    public function salesReportPDF(int $id)
    {
        try{
            $sale = $this->salesService->getItem($id);
            $pdf = Pdf::loadView('admin.report.sale-pdf',compact('sale'))
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

    public function salesReportReturnList(): View|Factory|Application
    {
        try{
            $saleReturns = $this->salesService->getReturnItemList();
            return view('admin.report.sale-return-view', compact('saleReturns'));
        }catch(\Throwable $exception){
            abort(500);
            dd($exception->getMessage());
        }
    }

    public function salesReportReturnPDF(int $id)
    {
        try{
            $saleReturn = $this->salesService->getSaleReturnItem($id);
            $pdf = Pdf::loadView('admin.report.saleReturn-pdf',compact('saleReturn'))
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
